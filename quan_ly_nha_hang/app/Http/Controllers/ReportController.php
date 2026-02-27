<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::today()->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->toDateString());

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        // Tính độ dài kỳ hiện tại (số ngày)
        $durationDays = $start->diffInDays($end) + 1;

        // Tính kỳ trước: cùng số ngày, ngay trước kỳ hiện tại
        $prevEnd = $start->copy()->subDay();
        $prevStart = $prevEnd->copy()->subDays($durationDays - 1)->startOfDay();

        // Đặc biệt cho "Tháng này": so với cùng số ngày của tháng trước
        if ($request->has('this-month') || $start->isSameDay($start->copy()->startOfMonth())) {
            $prevStart = $start->copy()->subMonthNoOverflow()->startOfMonth();
            $prevEnd = $end->copy()->subMonthNoOverflow();
        }

        // 1. Thống kê orders kỳ hiện tại
        $currentOrderStats = DB::table('orders')
            ->whereBetween('created_at', [$start, $end])
            ->where('trang_thai', 'hoan_tat')
            ->selectRaw('
                SUM(tong_thanh_toan) as tong_doanh_thu,
                COUNT(id) as tong_don_hang,
                AVG(tong_thanh_toan) as gia_tri_tb_don
            ')
            ->first();

        // 2. Thống kê orders kỳ trước
        $prevOrderStats = DB::table('orders')
            ->whereBetween('created_at', [$prevStart, $prevEnd])
            ->where('trang_thai', 'hoan_tat')
            ->selectRaw('
                SUM(tong_thanh_toan) as tong_doanh_thu,
                COUNT(id) as tong_don_hang,
                AVG(tong_thanh_toan) as gia_tri_tb_don
            ')
            ->first();

        // 3. Tỷ lệ hủy kỳ hiện tại (books)
        $currentBookStats = DB::table('books')
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('
                COUNT(*) as tong_dat_ban,
                SUM(CASE WHEN status = "Đã hủy" THEN 1 ELSE 0 END) as so_don_huy
            ')
            ->first();

        // 4. Tỷ lệ hủy kỳ trước
        $prevBookStats = DB::table('books')
            ->whereBetween('created_at', [$prevStart, $prevEnd])
            ->selectRaw('
                COUNT(*) as tong_dat_ban,
                SUM(CASE WHEN status = "Đã hủy" THEN 1 ELSE 0 END) as so_don_huy
            ')
            ->first();

        // Tính tỷ lệ hủy hiện tại
        $tyLeHuyHienTai = $currentBookStats->tong_dat_ban > 0
            ? ($currentBookStats->so_don_huy / $currentBookStats->tong_dat_ban) * 100
            : 0;

        $tyLeHuyTruoc = $prevBookStats->tong_dat_ban > 0
            ? ($prevBookStats->so_don_huy / $prevBookStats->tong_dat_ban) * 100
            : 0;

        $tyLeThayDoiHuy = $tyLeHuyTruoc > 0
            ? (($tyLeHuyHienTai - $tyLeHuyTruoc) / $tyLeHuyTruoc) * 100
            : ($tyLeHuyHienTai > 0 ? 100 : 0);

        $tyLeHuyDon = number_format($tyLeHuyHienTai, 2) . '%';

        // === DOANH THU THEO KHU VỰC ===
        $revenueByAreaRaw = DB::table('orders')
            ->join('tables', 'orders.table_id', '=', 'tables.id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->where('orders.trang_thai', 'hoan_tat')
            ->selectRaw('TRIM(tables.vi_tri) as area, SUM(orders.tong_thanh_toan) as revenue')
            ->groupBy('area')
            ->get();

        \Log::info('RevenueByArea Raw: ', $revenueByAreaRaw->toArray());

        // Log tên thực tế
        foreach ($revenueByAreaRaw as $row) {
            \Log::info('Khu vực thực tế từ DB: ' . ($row->area ?? 'NULL'));
        }

        $areaRevenue = [
            'Tiêu chuẩn' => 0,
            'Gần cửa sổ' => 0,
            'Riêng tư' => 0,
            'Ngoài trời' => 0,
        ];
        $totalAreaRevenue = 0;

        // Hàm loại bỏ dấu tiếng Việt (giữ nguyên)
        function removeVietnameseAccents($str)
        {
            $str = str_replace(
                ['à', 'á', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'è', 'é', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'ì', 'í', 'ỉ', 'ĩ', 'ị', 'ò', 'ó', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ù', 'ú', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ỳ', 'ý', 'ỷ', 'ỹ', 'ỵ'],
                ['a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y'],
                $str
            );
            return strtolower(str_replace(' ', '', $str)); // lowercase + xóa khoảng trắng
        }

        foreach ($revenueByAreaRaw as $row) {
            $rawArea = trim($row->area ?? '');
            $normalized = removeVietnameseAccents($rawArea); // ví dụ: 'Gần cửa sổ' → 'gancuaso'

            $matched = false;

            // Map mới: key ngắn, linh hoạt, khớp với normalized
            $standardMap = [
                'tieu' => 'Tiêu chuẩn',     // bắt đầu bằng tieu...
                'gan' => 'Gần cửa sổ',     // bắt đầu bằng gan...
                'rieng' => 'Riêng tư',       // bắt đầu bằng rieng...
                'ngoai' => 'Ngoài trời',     // bắt đầu bằng ngoai...
            ];

            foreach ($standardMap as $key => $standard) {
                if (str_contains($normalized, $key)) {
                    $areaRevenue[$standard] += (float) $row->revenue;
                    $matched = true;
                    break;
                }
            }

            if (!$matched) {
                \Log::warning("Khu vực không khớp: '$rawArea' (normalized: $normalized) với revenue {$row->revenue}");
            }

            $totalAreaRevenue += (float) $row->revenue;
        }

        // Tính %
        $areaPercent = [];
        if ($totalAreaRevenue > 0) {
            $areas = ['Tiêu chuẩn', 'Gần cửa sổ', 'Riêng tư', 'Ngoài trời'];
            $percentages = [];
            $sumRounded = 0;

            // Tính % chính xác và làm tròn cho các phần đầu
            foreach ($areas as $area) {
                $rev = $areaRevenue[$area] ?? 0;
                $exactPercent = ($rev / $totalAreaRevenue) * 100;
                $rounded = round($exactPercent, 0);
                $percentages[$area] = $rounded;
                $sumRounded += $rounded;
            }

            // Phần cuối bù chênh lệch để tổng = 100
            $lastArea = end($areas); // hoặc chọn khu vực có doanh thu lớn nhất
            $percentages[$lastArea] += (100 - $sumRounded);

            $areaPercent = $percentages;
        } else {
            $areaPercent = array_fill_keys(['Tiêu chuẩn', 'Gần cửa sổ', 'Riêng tư', 'Ngoài trời'], 0);
        }

        \Log::info('Area Percent Final: ', $areaPercent);

        // Format chỉ số hiện tại
        $tongDoanhThu = number_format($currentOrderStats->tong_doanh_thu ?? 0, 0, ',', '.') . 'đ';
        $tongDonHang = number_format($currentOrderStats->tong_don_hang ?? 0);
        $giaTriTbDon = number_format($currentOrderStats->gia_tri_tb_don ?? 0, 0, ',', '.') . 'đ';

        // === DOANH THU THEO NGÀY CỦA THÁNG CỦA end_date (toàn bộ tháng) ===
        $end = Carbon::parse($endDate)->endOfDay();
        $monthStart = $end->copy()->startOfMonth();  // Ngày 1 của tháng end_date
        $monthEnd = $end->copy()->endOfMonth();    // Ngày cuối của tháng end_date

        $dailyRevenue = DB::table('orders')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->where('trang_thai', 'hoan_tat')
            ->selectRaw('DATE(created_at) as date, SUM(tong_thanh_toan) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('revenue', 'date')
            ->toArray();

        // Điền đầy đủ các ngày trong tháng (ngày không có doanh thu = 0)
        $daysInMonth = $end->daysInMonth;
        $dailyData = [];
        $dates = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateKey = $end->format('Y-m-') . str_pad($day, 2, '0', STR_PAD_LEFT);
            $dates[] = $day . '/' . $end->format('m');
            $dailyData[] = $dailyRevenue[$dateKey] ?? 0;
        }

        // Khai báo để compact và AJAX
        $dailyDates = $dates;
        $dailyRevenue = $dailyData;

        // === DOANH THU THEO DANH MỤC ===
        $revenueByCategoryRaw = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('food', 'order_items.food_id', '=', 'food.id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->where('orders.trang_thai', 'hoan_tat')
            ->selectRaw('TRIM(food.type) as category, SUM(order_items.so_luong * order_items.gia_tai_thoi_diem_dat) as revenue')
            ->groupBy('category')
            ->get();

        \Log::info('RevenueByCategory Raw: ', $revenueByCategoryRaw->toArray());

        $categoryRevenue = [
            'Món chính' => 0,
            'Đồ uống' => 0,
            'Khai vị' => 0,
            'Tráng miệng' => 0,
        ];
        $totalCategoryRevenue = 0;

        foreach ($revenueByCategoryRaw as $row) {
            $rawCategory = trim($row->category ?? 'Khác');
            $normalized = strtolower($rawCategory);

            $matched = false;

            $categoryMap = [
                'mon-chinh' => 'Món chính',
                'do-uong' => 'Đồ uống',
                'khai-vi' => 'Khai vị',
                'trang-mieng' => 'Tráng miệng',
            ];

            foreach ($categoryMap as $key => $standard) {
                if (str_contains($normalized, $key)) {
                    $categoryRevenue[$standard] += $row->revenue;
                    $matched = true;
                    break;
                }
            }

            if (!$matched) {
                $categoryRevenue['Khác'] += $row->revenue;
                \Log::warning("Danh mục không khớp: '$rawCategory' với revenue {$row->revenue}");
            }

            $totalCategoryRevenue += $row->revenue;
        }

        // Tính %
        $categoryPercent = [];
        if ($totalCategoryRevenue > 0) {
            $categories = ['Món chính', 'Đồ uống', 'Khai vị', 'Tráng miệng'];
            $percentages = [];
            $sumRounded = 0;

            foreach ($categories as $cat) {
                $rev = $categoryRevenue[$cat] ?? 0;
                $exactPercent = ($rev / $totalCategoryRevenue) * 100;
                $rounded = round($exactPercent, 0);
                $percentages[$cat] = $rounded;
                $sumRounded += $rounded;
            }

            // Bù cho phần cuối (hoặc phần lớn nhất)
            $lastCat = end($categories);
            $percentages[$lastCat] += (100 - $sumRounded);

            $categoryPercent = $percentages;
        } else {
            $categoryPercent = array_fill_keys(['Món chính', 'Đồ uống', 'Khai vị', 'Tráng miệng'], 0);
        }

        \Log::info('Category Percent Final: ', $categoryPercent);

        // === MÓN ĂN BÁN CHẠY NHẤT (top 3) ===
        $topFoods = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('food', 'order_items.food_id', '=', 'food.id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->where('orders.trang_thai', 'hoan_tat')
            ->select(
                'food.title as ten_mon',
                'food.type as danh_muc',
                DB::raw('SUM(order_items.so_luong) as tong_so_luong'),
                DB::raw('SUM(order_items.so_luong * order_items.gia_tai_thoi_diem_dat) as tong_doanh_thu'),
                'food.image as hinh_anh'  // nếu bảng food có cột image
            )
            ->groupBy('food.id', 'food.title', 'food.type', 'food.image')
            ->orderByDesc('tong_so_luong')
            ->orderByDesc('tong_doanh_thu')
            ->limit(3)
            ->get();

        // Format dữ liệu để dễ dùng trong Blade
        $topFoodsFormatted = $topFoods->map(function ($item) {
            // Map danh mục thô → tên đẹp
            $danhMucMap = [
                'mon-chinh' => 'Món chính',
                'do-uong' => 'Đồ uống',
                'khai-vi' => 'Khai vị',
                'trang-mieng' => 'Tráng miệng',
                // thêm nếu có danh mục khác
            ];

            $danh_muc = $danhMucMap[strtolower($item->danh_muc)] ?? ucfirst(str_replace('-', ' ', $item->danh_muc)); // fallback

            return [
                'ten_mon' => $item->ten_mon,
                'danh_muc' => $danh_muc,
                'so_luong' => number_format($item->tong_so_luong),
                'doanh_thu' => number_format($item->tong_doanh_thu, 0, ',', '.') . 'đ',
                'hinh_anh' => $item->hinh_anh ?? 'https://via.placeholder.com/40?text=' . urlencode(substr($item->ten_mon, 0, 1)),
            ];
        })->toArray();

        // Trả cho view và AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'tongDoanhThu' => $tongDoanhThu,
                'tongDonHang' => $tongDonHang,
                'giaTriTbDon' => $giaTriTbDon,
                'tyLeHuyDon' => $tyLeHuyDon,
                'dailyDates' => $dailyDates,
                'dailyRevenue' => $dailyRevenue,
                'areaPercent' => $areaPercent,
                'areaRevenue' => $areaRevenue,
                'categoryPercent' => $categoryPercent,
                'categoryRevenue' => $categoryRevenue,
                'topFoods' => $topFoodsFormatted,
            ]);
        }

        // Compact cho view lần đầu
        return view('admin.dashboard', compact(
            'tongDoanhThu',
            'tongDonHang',
            'giaTriTbDon',
            'tyLeHuyDon',
            'startDate',
            'endDate',
            'dailyDates',
            'dailyRevenue',
            'areaPercent',
            'areaRevenue',
            'categoryPercent',
            'categoryRevenue',
            'topFoodsFormatted'
        ));
    }

    public function aiInsight(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::today()->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->toDateString());

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        // Tính kỳ trước (30 ngày trước để so sánh tăng trưởng)
        $prevStart = $start->copy()->subDays(30)->startOfDay();
        $prevEnd = $end->copy()->subDays(30)->endOfDay();

        // Lấy top 3 món bán chạy HIỆN TẠI + thông tin từ bảng food
        $topItemsCurrent = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('food', 'order_items.food_id', '=', 'food.id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->where('orders.trang_thai', 'hoan_tat')
            ->select(
                'food.title as food_name',
                'food.price as current_price',         // Giá hiện tại của món
                'food.type as food_type',              // Loại món (món chính, khai vị, tráng miệng...)
                'food.detail as food_detail',          // Mô tả chi tiết món
                DB::raw('SUM(order_items.so_luong) as total_qty'),
                DB::raw('SUM(order_items.so_luong * order_items.gia_tai_thoi_diem_dat) as total_revenue')
            )
            ->groupBy('food.id', 'food.title', 'food.price', 'food.type', 'food.detail')
            ->orderByDesc('total_qty')
            ->limit(3)
            ->get();

        // Doanh thu kỳ trước của các món đó (chỉ cần revenue để tính tăng trưởng)
        $topItemsPrev = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('food', 'order_items.food_id', '=', 'food.id')
            ->whereBetween('orders.created_at', [$prevStart, $prevEnd])
            ->where('orders.trang_thai', 'hoan_tat')
            ->select(
                'food.title as food_name',
                DB::raw('SUM(order_items.so_luong * order_items.gia_tai_thoi_diem_dat) as prev_revenue')
            )
            ->groupBy('food.title')
            ->pluck('prev_revenue', 'food_name')
            ->toArray();

        // Tạo dữ liệu cho prompt
        $insights = [];
        foreach ($topItemsCurrent as $item) {
            $prevRevenue = $topItemsPrev[$item->food_name] ?? 0;
            $growth = $prevRevenue > 0 ? (($item->total_revenue - $prevRevenue) / $prevRevenue) * 100 : 100;
            $insights[] = [
                'name' => $item->food_name,
                'qty' => $item->total_qty,
                'revenue' => number_format($item->total_revenue, 0, ',', '.'),
                'growth' => round($growth, 1),
                'price' => number_format($item->current_price, 0, ',', '.'),   // Giá hiện tại
                'type' => $item->food_type,                                    // Loại món
                'detail' => $item->food_detail,                                // Mô tả chi tiết
            ];
        }

        // Tạo prompt cho Groq
        $prompt = "Bạn là chuyên gia tư vấn nhà hàng thông minh, nhiệt tình và thực tế. ";

        if (empty($insights)) {
            // Không có dữ liệu
            $prompt .= "Trong khoảng thời gian từ $startDate đến $endDate, hiện tại chưa có dữ liệu bán hàng nào (doanh thu = 0, không có đơn hàng). ";
            $prompt .= "Hãy đưa ra 1-2 gợi ý tích cực, thực tế để chủ nhà hàng kích hoạt doanh số trong giai đoạn này (ví dụ: chạy khuyến mãi, quảng bá món mới, cải thiện dịch vụ, kiểm tra menu, liên hệ khách quen...). ";
            $prompt .= "Trả lời ngắn gọn, nhiệt tình, bằng tiếng Việt, không giả định có dữ liệu bán hàng.";
        } else {
            // Có dữ liệu → thêm chi tiết từ bảng food
            $prompt .= "Dựa trên dữ liệu bán hàng sau đây trong khoảng thời gian từ $startDate đến $endDate, hãy đưa ra 1 insight ngắn gọn, hấp dẫn, hữu ích cho chủ nhà hàng (tối đa 2 câu):\n\n";
            foreach ($insights as $i => $item) {
                $prompt .= ($i + 1) . ". **{$item['name']}** (loại: {$item['type']}, giá hiện tại: {$item['price']}đ, mô tả: {$item['detail']}): bán {$item['qty']} phần, doanh thu {$item['revenue']}đ, tăng trưởng {$item['growth']}%\n";
            }
            $prompt .= "\nGợi ý hành động cụ thể (chuẩn bị nguyên liệu, khuyến mãi dựa trên giá, thay đổi menu theo loại món, tận dụng mô tả chi tiết để quảng bá...). ";
            $prompt .= "\nTrả lời bằng tiếng Việt, tự nhiên, nhiệt tình, không dài dòng. ";
            $prompt .= "Phải viết câu hoàn chỉnh, không bỏ lửng giữa chừng, luôn kết thúc bằng dấu chấm hoặc dấu chấm than. ";
            $prompt .= "Bạn có thể tự do dùng ** ** (markdown đậm) để nhấn mạnh từ/cụm từ quan trọng (ví dụ: **khuyến mãi đặc biệt**, **tăng doanh thu**, **món hot nhất**), giúp gợi ý nổi bật và thuyết phục hơn.";
        }

        $prompt .= "\nLuôn trả lời với giọng điệu vui vẻ, thân thiện như người bạn đồng hành của chủ nhà hàng.";

        // Gọi Groq API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.1-8b-instant',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Bạn là chuyên gia tư vấn nhà hàng thông minh và nhiệt tình.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 400,
                    'top_p' => 0.9,
                ]);

        $insight = $response->successful()
            ? $response->json()['choices'][0]['message']['content'] ?? 'Không có insight mới.'
            : 'Không thể kết nối đến AI lúc này. Vui lòng thử lại sau.';

        return response()->json(['insight' => trim($insight)]);
    }

    public function aiSuggestions($tableId)
    {
        try {
            $table = Table::find($tableId);
            if (!$table) {
                return response()->json(['suggestion' => 'Không tìm thấy bàn này.']);
            }

            $order = $table->orders()->where('trang_thai', 'dang_xu_ly')->latest()->first();

            $orderedFoodIds = $order ? $order->orderItems()->pluck('food_id')->toArray() : [];

            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $hour = $now->hour;
            $timeOfDay = $hour < 11 ? 'sáng' : ($hour < 17 ? 'trưa' : 'tối');

            // Thời tiết: dùng fallback nếu API lỗi
            $weather = 'thời tiết Hà Nội hiện tại khoảng 25°C, trời mát mẻ';
            $apiKey = env('OPENWEATHER_API_KEY');
            if ($apiKey) {
                try {
                    $weatherResponse = Http::timeout(5)->get("https://api.openweathermap.org/data/2.5/weather?q=Hanoi&appid={$apiKey}&units=metric&lang=vi");
                    if ($weatherResponse->successful()) {
                        $weatherData = $weatherResponse->json();
                        $temp = $weatherData['main']['temp'] ?? 25;
                        $desc = $weatherData['weather'][0]['description'] ?? 'mát mẻ';
                        $weather = "khoảng {$temp}°C, {$desc}";
                    }
                } catch (\Exception $e) {
                    \Log::warning('OpenWeather API error: ' . $e->getMessage());
                }
            }

            // Best seller hôm nay
            $bestSellers = DB::table('order_items')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->join('food', 'order_items.food_id', '=', 'food.id')
                ->whereDate('orders.created_at', $now->toDateString())
                ->where('orders.trang_thai', 'hoan_tat')
                ->select('food.title as name', DB::raw('SUM(order_items.so_luong) as qty'))
                ->groupBy('food.id', 'food.title')
                ->orderByDesc('qty')
                ->limit(3)
                ->get();

            $allFoods = Food::pluck('title')->toArray();
            $menuList = implode(', ', $allFoods);
            // Lấy lịch sử gợi ý trước đó của bàn (từ session)
            $previousSuggestions = session("ai_suggestions_table_{$tableId}", []); // mảng tên món đã gợi ý trước

            // Prompt cập nhật
            $prompt = "Bạn là chuyên gia tư vấn món ăn nhà hàng thông minh, nhiệt tình. ";
            $prompt .= "Hiện tại là $timeOfDay, thời tiết Hà Nội $weather. ";

            if (!empty($orderedFoodIds)) {
                $orderedNames = Food::whereIn('id', $orderedFoodIds)->pluck('title')->toArray();
                $prompt .= "Khách đã order các món: " . implode(', ', $orderedNames) . ". ";
                $prompt .= "Ưu tiên gợi ý 1-2 món combo phù hợp với các món đã order (ví dụ: beefsteak thì thêm rượu vang, salad thì thêm nước trái cây, không gợi ý lại món đã có). ";
            } else {
                $prompt .= "Bàn chưa order món nào. ";
            }

            if (!empty($previousSuggestions)) {
                $prompt .= "Không gợi ý lại các món đã gợi ý trước: " . implode(', ', $previousSuggestions) . ". ";
            }

            $prompt .= "Gợi ý thêm 1 món best seller hôm nay: ";
            foreach ($bestSellers as $bs) {
                $prompt .= "{$bs->name} (bán {$bs->qty} phần), ";
            }
            $prompt .= "\nTrả lời bằng tiếng Việt, cực ngắn gọn (3-4 dòng), vui vẻ, nhiệt tình, chỉ gợi ý 2-3 món phù hợp nhất. ";
            $prompt .= "Không lặp lại món đã order hoặc đã gợi ý trước. Tập trung vào combo phù hợp và món mới lạ.";
            $prompt .= "Dùng giọng điệu thân thiện như người bạn đồng hành.";
            $prompt .= "Bạn có thể tự do dùng ** ** (markdown đậm) để nhấn mạnh từ/cụm từ quan trọng (ví dụ: **combo**, **phù hợp**, **món hot nhất**,...), giúp gợi ý nổi bật và thuyết phục hơn.";
            $prompt .= "\nDanh sách món ăn có sẵn trong nhà hàng (chỉ được chọn từ đây, KHÔNG được tự sáng tạo món mới): $menuList. ";
            $prompt .= "Khi gợi ý combo hoặc món, bắt buộc phải chọn từ danh sách trên. ";
            $prompt .= "Nếu không có món phù hợp, chỉ gợi ý món best seller hoặc khuyến khích order cơ bản.";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                        'model' => 'llama-3.1-8b-instant',
                        'messages' => [
                            ['role' => 'user', 'content' => $prompt],
                        ],
                        'temperature' => 0.7,
                        'max_tokens' => 500,
                    ]);

            $suggestion = $response->successful()
                ? $response->json()['choices'][0]['message']['content'] ?? 'Chưa có gợi ý phù hợp.'
                : 'Không thể tải gợi ý lúc này.';

            // Sau khi có suggestion, lưu tên món gợi ý vào session (để lần sau tránh lặp)
            if ($response->successful() && isset($response->json()['choices'][0]['message']['content'])) {
                // Trích xuất tên món từ suggestion (đơn giản, tìm **text**)
                preg_match_all('/\*\*(.*?)\*\*/', $suggestion, $matches);
                $newSuggestions = $matches[1] ?? [];
                if (!empty($newSuggestions)) {
                    $previousSuggestions = array_merge($previousSuggestions, $newSuggestions);
                    session(["ai_suggestions_table_{$tableId}" => array_unique($previousSuggestions)]);
                }
            }

            return response()->json(['suggestion' => nl2br($suggestion)]);

        } catch (\Exception $e) {
            \Log::error('AI Suggestions error: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile());
            return response()->json(['suggestion' => 'Đang gặp sự cố kỹ thuật, gợi ý tạm thời không khả dụng.']);
        }
    }

    // AI 1: Gợi ý theo thời tiết (dành cho bàn chưa order)
    public function aiWeatherSuggestions($tableId)
    {
        \Log::info("aiWeatherSuggestions called for table: $tableId");

        $table = Table::find($tableId);
        if (!$table) {
            \Log::warning("Table $tableId not found");
            return response()->json(['suggestion' => 'Không tìm thấy bàn.']);
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $timeOfDay = $now->hour < 11 ? 'sáng' : ($now->hour < 16 ? 'trưa' : 'tối');
        // Thời tiết: dùng fallback nếu API lỗi
        $weather = 'thời tiết Hà Nội hiện tại khoảng 25°C, trời mát mẻ';
        $apiKey = env('OPENWEATHER_API_KEY');
        if ($apiKey) {
            try {
                $weatherResponse = Http::timeout(5)->get("https://api.openweathermap.org/data/2.5/weather?q=Hanoi&appid={$apiKey}&units=metric&lang=vi");
                if ($weatherResponse->successful()) {
                    $weatherData = $weatherResponse->json();
                    $temp = $weatherData['main']['temp'] ?? 25;
                    $desc = $weatherData['weather'][0]['description'] ?? 'mát mẻ';
                    $weather = "khoảng {$temp}°C, {$desc}";
                }
            } catch (\Exception $e) {
                \Log::warning('OpenWeather API error: ' . $e->getMessage());
            }
        }

        $bestSellers = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('food', 'order_items.food_id', '=', 'food.id')
            ->whereDate('orders.created_at', $now->toDateString())
            ->where('orders.trang_thai', 'hoan_tat')
            ->select('food.title as name', DB::raw('SUM(order_items.so_luong) as qty'))
            ->groupBy('food.id', 'food.title')
            ->orderByDesc('qty')
            ->limit(3)
            ->get();

        // Lấy tất cả tên món từ DB (để ép Groq chỉ chọn từ đây)
        $allFoods = Food::pluck('title')->toArray();
        $menuList = implode(', ', $allFoods);

        $prompt = "Bạn là chuyên gia tư vấn món ăn nhà hàng. ";
        $prompt .= "Hiện tại là $timeOfDay, thời tiết Hà Nội $weather. ";
        $prompt .= "Bàn chưa order món nào. Gợi ý 2-3 món phù hợp theo thời tiết và thời gian trong ngày. ";
        $prompt .= "Gợi ý thêm món best seller hôm nay (nếu có): ";
        foreach ($bestSellers as $bs) {
            $prompt .= "{$bs->name} (bán {$bs->qty} phần), ";
        }
        $prompt .= "\nDanh sách món ăn có sẵn trong nhà hàng (CHỈ ĐƯỢC CHỌN TỪ ĐÂY, TUYỆT ĐỐI KHÔNG ĐƯỢC TỰ SÁNG TẠO MÓN MỚI): $menuList. ";
        $prompt .= "Khi gợi ý bất kỳ món nào, bắt buộc phải chọn từ danh sách trên. ";
        $prompt .= "Nếu không có món phù hợp, chỉ gợi ý món best seller hoặc nói 'Hiện tại menu chưa có món lý tưởng cho thời tiết này, bạn thử các món best seller nhé!'.";
        $prompt .= "Bạn có thể tự do dùng ** ** (markdown đậm) để nhấn mạnh từ/cụm từ quan trọng, giúp gợi ý nổi bật và thuyết phục hơn.";
        $prompt .= "\nTrả lời ngắn gọn 3-4 dòng, vui vẻ, nhiệt tình, bằng tiếng Việt. Không dùng \\n\\n, chỉ 1 \\n khi cần xuống dòng. Dùng ** ** để đậm tên món.";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ])->timeout(10)->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.1-8b-instant',
                    'messages' => [['role' => 'user', 'content' => $prompt]],
                    'temperature' => 0.5, // giảm temperature để model ít "sáng tạo" hơn
                    'max_tokens' => 250,
                ]);

        if (!$response->successful()) {
            $errorBody = $response->body();
            \Log::error("Groq Weather API failed - Status: {$response->status()} - Body: $errorBody");
            return response()->json(['suggestion' => 'Lỗi kết nối Groq: ' . $response->status()]);
        }

        $content = $response->json()['choices'][0]['message']['content'] ?? 'Chưa có gợi ý phù hợp.';
        return response()->json(['suggestion' => nl2br($content)]);
    }

    // AI 2: Gợi ý combo theo món đã order
    public function aiComboSuggestions($tableId)
    {
        \Log::info("aiComboSuggestions called for table: $tableId");

        $table = Table::find($tableId);
        if (!$table) {
            \Log::warning("Table $tableId not found");
            return response()->json(['suggestion' => 'Không tìm thấy bàn.']);
        }

        // Lấy order mới nhất của bàn (không lọc trạng thái để test)
        $order = $table->orders()->latest('id')->first();

        if (!$order) {
            \Log::warning("No order found for table $tableId");
            return response()->json(['suggestion' => 'Chưa có đơn hàng nào cho bàn này.']);
        }

        \Log::info("Found order ID: " . $order->id . " - Status: " . $order->trang_thai);

        // Lấy tất cả order_items của order này
        $orderedFoodIds = $order->orderItems()->pluck('food_id')->toArray();

        if (empty($orderedFoodIds)) {
            \Log::warning("No order_items found for order " . $order->id);
            return response()->json(['suggestion' => 'Đơn hàng chưa có món nào.']);
        }

        $orderedNames = Food::whereIn('id', $orderedFoodIds)->pluck('title')->toArray();

        \Log::info("Ordered names: " . implode(', ', $orderedNames));

        // Nếu vẫn rỗng → fallback
        if (empty($orderedNames)) {
            return response()->json(['suggestion' => 'Chưa có món nào trong đơn hàng.']);
        }

        // Lấy danh sách tất cả món có sẵn trong menu để ép Groq chỉ chọn từ đây
        $allFoods = Food::pluck('title')->toArray();
        if (empty($allFoods)) {
            return response()->json(['suggestion' => 'Menu hiện tại chưa có món nào.']);
        }

        // Nếu menu quá dài (> 100 món), chỉ lấy top 50 phổ biến nhất để giảm token
        if (count($allFoods) > 50) {
            $popularFoods = Food::orderByDesc(DB::raw('(SELECT SUM(so_luong) FROM order_items WHERE food_id = food.id)'))
                ->limit(50)
                ->pluck('title')
                ->toArray();
            $menuList = implode(', ', $popularFoods);
        } else {
            $menuList = implode(', ', $allFoods);
        }

        // Prompt sửa chặt chẽ để ÉP Groq chỉ dùng món thật
        $prompt = "Bạn là chuyên gia tư vấn món ăn nhà hàng. ";
        $prompt .= "Tôi đã order các món: " . implode(', ', $orderedNames) . ". ";
        $prompt .= "Gợi ý 1-2 món combo phù hợp với các món đã order (ví dụ: nếu có Bò Wagyu thì gợi ý rượu vang hoặc salad). ";
        $prompt .= "Không gợi ý lại món đã order. Ưu tiên món bổ trợ hoặc tăng trải nghiệm. ";

        // Ràng buộc quan trọng nhất
        $prompt .= "\nDANH SÁCH MÓN ĂN CÓ SẴN TRONG NHÀ HÀNG (TUYỆT ĐỐI CHỈ ĐƯỢC CHỌN TỪ ĐÂY, KHÔNG ĐƯỢC TỰ SÁNG TẠO, BIỆT, HAY THÊM MÓN MỚI DÙ CHỈ 1 TỪ): $menuList. ";
        $prompt .= "Mọi tên món trong gợi ý combo PHẢI xuất hiện chính xác trong danh sách trên. ";
        $prompt .= "Nếu không có món phù hợp để tạo combo, trả lời: 'Hiện tại menu chưa có món bổ trợ lý tưởng cho các món đã order, bạn thử thêm món best seller nhé!'.";
        $prompt .= "\nTrả lời ngắn gọn 3-4 dòng, vui vẻ, nhiệt tình, bằng tiếng Việt. Dùng ** ** để đậm tên món.";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ])->timeout(10)->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.1-8b-instant',
                    'messages' => [['role' => 'user', 'content' => $prompt]],
                    'temperature' => 0.6,  // Giảm temperature để model ít "sáng tạo" hơn
                    'max_tokens' => 250,
                ]);

        if (!$response->successful()) {
            $errorBody = $response->body();
            \Log::error("Groq failed - Status: {$response->status()} - Body: $errorBody");
            return response()->json(['suggestion' => 'Lỗi kết nối Groq: ' . $response->status()]);
        }

        $content = $response->json()['choices'][0]['message']['content'] ?? 'Chưa có gợi ý phù hợp.';
        return response()->json(['suggestion' => nl2br($content)]);
    }
}
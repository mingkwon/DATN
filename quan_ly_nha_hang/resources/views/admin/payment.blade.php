<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Thanh toán hóa đơn - Bếp Nhà Mộc</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;900&amp;family=Noto+Sans:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#19e65e",
                        "primary-dark": "#14b84b",
                        "background-light": "#f6f8f6",
                        "background-dark": "#112116",
                        "surface-dark": "#18281e",
                        "border-dark": "#2a3d31",
                    },
                    fontFamily: {
                        "display": ["Work Sans", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "2xl": "2rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #2a3d31;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #3c5344;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-hidden">
    <div class="flex h-screen w-full">
        <div
            class="w-[280px] h-full flex-col justify-between bg-surface-dark border-r border-border-dark hidden lg:flex flex-shrink-0 z-30">
            <!-- Sidebar giữ nguyên như cũ -->
            <div class="flex flex-col gap-4 p-4">
                <div class="flex items-center gap-3 px-2 py-2">
                    <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 bg-primary/20 flex items-center justify-center text-primary"
                        data-alt="Restaurant logo placeholder">
                        <span class="material-symbols-outlined text-2xl">restaurant_menu</span>
                    </div>
                    <div>
                        <h1 class="text-white text-base font-bold leading-normal">DeliciousAI</h1>
                        <p class="text-gray-400 text-xs font-normal">Restaurant Manager</p>
                    </div>
                </div>
                <div class="h-px bg-border-dark my-1"></div>
                <div class="flex flex-col gap-1">
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('home') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">dashboard</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Tổng quan</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 border border-primary/20"
                        href="#">
                        <span class="material-symbols-outlined text-primary fill-1">table_restaurant</span>
                        <p class="text-primary text-sm font-bold">Bàn phục vụ</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('bookings') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">receipt_long</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Danh sách đặt bàn</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('add_food') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">restaurant</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Quản lý thực đơn</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('setting') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">settings</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Cài đặt</p>
                    </a>
                </div>
            </div>
            <div class="p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-surface-dark border border-border-white hover:bg-red-500/10 hover:border-red-500/50 text-white-400 hover:text-red-500 transition-all group">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-sm font-bold">Đăng xuất</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="flex-1 flex flex-col h-full overflow-hidden bg-background-dark">
            <div
                class="flex-shrink-0 p-6 border-b border-border-dark bg-surface-dark/50 backdrop-blur-md z-10 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('table_order', $order->ban_an->id) }}"
                        class="text-gray-400 hover:text-white transition-colors focus:outline-none">
                        <span class="material-symbols-outlined text-3xl">arrow_back</span>
                    </a>
                    <div>
                        <h1 class="text-white text-2xl font-black leading-tight tracking-tight">Thanh toán hóa đơn</h1>
                        <p class="text-gray-400 text-sm font-normal">Hoàn tất quy trình phục vụ & Trả bàn</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 bg-yellow-500/10 border border-yellow-500/20 px-4 py-2 rounded-xl">
                    <div class="size-2 rounded-full bg-yellow-500 animate-pulse"></div>
                    <span class="text-yellow-500 font-bold text-sm uppercase">Bàn {{ $order->ban_an->ten_ban }} - Đang
                        dùng</span>
                </div>
            </div>
            <div class="flex-1 flex overflow-hidden">
                <div class="flex-1 flex flex-col overflow-hidden border-r border-border-dark">
                    <div class="p-6 grid grid-cols-2 gap-4 border-b border-border-dark bg-surface-dark/30">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-gray-500">table_restaurant</span>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Tên bàn</p>
                                <p class="text-white font-bold">Bàn A02</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-gray-500">schedule</span>
                                <div>
                                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Giờ vào</p>
                                    <p class="text-white font-bold">
                                        {{ $timeIn }}
                                        <span class="text-gray-400 text-sm">({{ $duration }} dùng bữa)</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-y-auto p-6">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-gray-500 text-xs uppercase tracking-widest border-b border-border-dark">
                                    <th class="pb-4 font-bold">Món ăn</th>
                                    <th class="pb-4 font-bold text-center">SL</th>
                                    <th class="pb-4 font-bold text-right">Đơn giá</th>
                                    <th class="pb-4 font-bold text-right">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @php
                                    // Nhóm các item theo food_id để hiển thị distinct
                                    $groupedItems = $order->orderItems->groupBy('food_id');
                                @endphp

                                @forelse($groupedItems as $foodId => $group)
                                    @php
                                        $firstItem = $group->first();
                                        $totalQuantity = $group->sum('so_luong');
                                        $price = $firstItem->gia_tai_thoi_diem_dat;
                                        $subTotalItem = $totalQuantity * $price;
                                    @endphp

                                    <tr class="border-b border-border-dark/50">
                                        <td class="py-4">
                                            <p class="text-white font-bold">
                                                {{ $firstItem->food->title ?? 'Món không xác định' }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $firstItem->ghi_chu_mon ?? '' }}</p>
                                        </td>
                                        <td class="py-4 text-center text-gray-300">{{ $totalQuantity }}</td>
                                        <td class="py-4 text-right text-gray-300">
                                            {{ number_format($price, 0, ',', '.') }}đ
                                        </td>
                                        <td class="py-4 text-right text-white font-bold">
                                            {{ number_format($subTotalItem, 0, ',', '.') }}đ
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-500 italic">
                                            Chưa có món nào trong đơn hàng này
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 bg-surface-dark border-t border-border-dark space-y-4">
                        <!-- <div class="flex flex-col gap-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Mã giảm giá /
                                Voucher</label>
                            <div class="flex gap-2">
                                <div class="relative flex-1">
                                    <span
                                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xl">confirmation_number</span>
                                    <input
                                        class="w-full bg-background-dark border-border-dark rounded-xl text-white text-sm py-2.5 pl-10 pr-4 focus:ring-primary focus:border-primary transition-all placeholder:text-gray-600"
                                        placeholder="Nhập mã ưu đãi..." type="text" value="GIAM10" />
                                </div>
                                <button
                                    class="px-6 py-2.5 bg-primary/10 border border-primary/30 text-primary hover:bg-primary/20 rounded-xl font-bold text-sm transition-all">
                                    Áp dụng
                                </button>
                            </div>
                        </div> -->
                        <div class="space-y-3 pt-2">
                            <div class="flex justify-between items-center text-gray-400 text-sm">
                                <span>Tạm tính ({{ $order->orderItems->count() }} món)</span>
                                <span class="font-medium text-white">{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-400 text-sm">
                                <span>Thuế VAT (8%)</span>
                                <span class="font-medium text-white">{{ number_format($vat, 0, ',', '.') }}đ</span>
                            </div>
                            <!-- <div class="flex justify-between items-center text-red-400 text-sm">
                                <div class="flex items-center gap-2">
                                    <span>Giảm giá (Voucher GIAM10)</span>
                                    <span class="material-symbols-outlined text-xs">cancel</span>
                                </div>
                                <span class="font-medium">-133,300đ</span>
                            </div> -->
                            <div class="h-px bg-border-dark my-2"></div>
                            <div class="flex justify-between items-center">
                                <span class="text-white font-bold text-lg">Tổng cộng</span>
                                <span
                                    class="text-primary text-3xl font-black tracking-tight">{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-[450px] bg-surface-dark p-6 overflow-y-auto">
                    <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">payments</span>
                        Phương thức thanh toán
                    </h3>
                    <div class="grid grid-cols-2 gap-3 mb-8">
                        <!-- Tiền mặt -->
                        <button id="btn-tien-mat"
                            class="flex flex-col items-center gap-3 p-4 rounded-2xl border-2 border-primary bg-primary/5 text-primary font-bold active:scale-95 transition-all payment-method active">
                            <span class="material-symbols-outlined text-3xl">payments</span>
                            <span class="text-sm">Tiền mặt</span>
                        </button>

                        <!-- Chuyển khoản -->
                        <button id="btn-chuyen-khoan"
                            class="flex flex-col items-center gap-3 p-4 rounded-2xl border-2 border-border-dark hover:border-white/20 text-gray-400 hover:text-white transition-all payment-method">
                            <span class="material-symbols-outlined text-3xl">account_balance_wallet</span>
                            <span class="text-sm">Chuyển khoản</span>
                        </button>
                    </div>
                    <!-- Phần Tiền mặt -->
                    <div id="tien-mat" class="payment-content">
                        <!-- Nội dung tiền mặt giữ nguyên -->
                        <div class="space-y-6 mb-8">
                            <div>
                                <label class="block text-gray-400 text-sm font-medium mb-2">Tiền khách đưa</label>
                                <div class="relative">
                                    <input id="tien-khach-dua"
                                        class="w-full bg-background-dark border-border-dark rounded-xl text-white text-2xl font-black py-4 pl-4 pr-12 focus:ring-primary focus:border-primary transition-all placeholder:text-gray-500 placeholder:text-base placeholder:font-normal"
                                        type="text" inputmode="numeric" pattern="[0-9]*"
                                        placeholder="Nhập số tiền khách đưa..."
                                        oninput="this.value = this.value.replace(/\D/g, ''); formatTienThua();" />
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">VNĐ</span>
                                </div>
                            </div>
                            <div class="p-4 rounded-xl bg-background-dark/50 border border-border-dark">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-400 text-sm font-medium">Tiền thừa trả khách</span>
                                    <span id="tien-thua" class="text-white text-xl font-bold">0đ</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 relative">
                            <form id="payment-form" action="{{ route('payment.process', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="phuong_thuc" value="tien_mat">
                                <button type="submit" id="btn-thanh-toan"
                                    class="w-full py-5 rounded-xl bg-primary hover:bg-primary-dark text-surface-dark font-black text-lg flex items-center justify-center gap-2 transition-all cursor-pointer disabled:cursor-not-allowed disabled:opacity-70 group"
                                    disabled>
                                    <span class="material-symbols-outlined text-2xl">check_circle</span>
                                    THANH TOÁN & TRẢ BÀN
                                </button>
                            </form>

                            <!-- Tooltip khi hover nút disabled (tùy chọn, đẹp hơn) -->
                            <div id="tooltip-thanh-toan"
                                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden px-4 py-2 bg-gray-800 text-white text-sm rounded-lg shadow-lg whitespace-nowrap">
                                Chưa đủ tiền hoặc chưa nhập số tiền khách đưa
                            </div>
                        </div>
                    </div>

                    <!-- Phần Chuyển khoản -->
                    <div id="chuyen-khoan" class="payment-content hidden">
                        <div
                            class="flex-1 flex flex-col items-center justify-center p-6 bg-background-dark border border-border-dark rounded-3xl mb-8">
                            <div class="relative size-80 bg-white p-4 rounded-2xl mb-4">
                                <!-- Ảnh QR động: amount = $total, addInfo = Thanh toán chuyển khoản bàn {ten_ban} -->
                                <img alt="QR Code Thanh Toán" class="w-full h-full object-contain"
                                    src="https://img.vietqr.io/image/BIDV-2142923563-compact2.png?amount={{ number_format($total, 0, '', '') }}&addInfo=Thanh%20to%C3%A1n%20chuy%E1%BB%83n%20kho%E1%BA%A3n%20b%C3%A0n%20{{ urlencode($order->ban_an->ten_ban) }}" />
                            </div>
                            <div class="flex items-center gap-2 text-momo font-bold animate-pulse">
                                <span class="material-symbols-outlined text-lg">hourglass_empty</span>
                                <span class="text-sm">Đang chờ thanh toán...</span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-5 mt-auto">
                            <form action="{{ route('payment.process', $order->id) }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="phuong_thuc" value="chuyen_khoan">
                                <button type="submit"
                                    class="w-full py-4 rounded-xl bg-primary hover:bg-primary-dark text-surface-dark font-bold flex items-center justify-center gap-2 transition-all shadow-lg shadow-primary/20">
                                    <span class="material-symbols-outlined">check_circle</span>
                                    Xác nhận đã nhận
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden fixed inset-0 z-[100] bg-black/80 backdrop-blur-sm items-center justify-center p-4"
        id="booking-modal">
        <div class="w-full max-w-md bg-surface-dark border border-border-dark rounded-3xl shadow-2xl overflow-hidden">
            <div class="p-8 text-center">
                <div
                    class="inline-flex items-center justify-center size-20 rounded-full bg-blue-500/10 text-blue-500 mb-6">
                    <span class="material-symbols-outlined text-5xl">event_upcoming</span>
                </div>
                <h2 class="text-2xl font-black text-white mb-2 leading-tight">Xác nhận xử lý bàn</h2>
                <p class="text-gray-400 font-medium mb-8">Bàn này đã được đặt, đang chờ khách.</p>
                <div class="flex flex-col gap-3">
                    <a class="w-full bg-primary hover:bg-primary-dark text-surface-dark font-bold py-4 rounded-xl flex items-center justify-center gap-2 transition-all shadow-lg shadow-primary/20"
                        href="#">
                        <span class="material-symbols-outlined">play_circle</span>
                        Mở bàn ngay
                    </a>
                    <a class="w-full bg-surface-dark border border-border-dark hover:bg-red-500/10 hover:border-red-500/50 text-gray-300 hover:text-red-500 font-bold py-4 rounded-xl flex items-center justify-center gap-2 transition-all"
                        href="#">
                        <span class="material-symbols-outlined">cancel</span>
                        Hủy đặt bàn
                    </a>
                </div>
            </div>
            <div class="bg-background-dark/50 p-4 flex justify-center border-t border-border-dark">
                <a class="text-gray-500 hover:text-white text-sm font-medium transition-colors" href="#">Đóng cửa sổ</a>
            </div>
        </div>
    </div>
    <script>
        // Toggle phương thức thanh toán
        document.querySelectorAll('.payment-method').forEach(btn => {
            btn.addEventListener('click', function () {
                // Xóa active từ tất cả nút
                document.querySelectorAll('.payment-method').forEach(b => {
                    b.classList.remove('active', 'border-primary', 'bg-primary/5', 'text-primary');
                    b.classList.add('border-border-dark', 'text-gray-400', 'hover:border-white/20', 'hover:text-white');
                });

                // Thêm active cho nút được chọn
                this.classList.add('active', 'border-primary', 'bg-primary/5', 'text-primary');
                this.classList.remove('border-border-dark', 'text-gray-400', 'hover:border-white/20', 'hover:text-white');

                // Ẩn tất cả content
                document.querySelectorAll('.payment-content').forEach(content => {
                    content.classList.add('hidden');
                });

                // Hiển thị content tương ứng
                const method = this.id === 'btn-tien-mat' ? 'tien-mat' : 'chuyen-khoan';
                document.getElementById(method).classList.remove('hidden');
            });
        });

        document.getElementById('tien-khach-dua')?.addEventListener('input', function (e) {
            let value = this.value.replace(/\D/g, ''); // Chỉ giữ số
            if (value) {
                this.value = parseInt(value).toLocaleString('vi-VN');
            } else {
                this.value = '';
            }
        });

        // Tính tiền thừa
        const grandTotal = parseInt("{{ $total }}") || 0;
        const btnThanhToan = document.getElementById('btn-thanh-toan');
        const inputTienKhach = document.getElementById('tien-khach-dua');
        const tienThuaEl = document.getElementById('tien-thua');

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function checkThanhToan() {
            if (!inputTienKhach || !btnThanhToan) return;

            let tienKhachDua = parseInt(inputTienKhach.value) || 0;

            // Kiểm tra điều kiện: phải nhập > 0 và >= tổng tiền
            if (tienKhachDua >= grandTotal && tienKhachDua > 0) {
                btnThanhToan.disabled = false;
                btnThanhToan.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                btnThanhToan.disabled = true;
                btnThanhToan.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        function formatTienThua() {
            if (!inputTienKhach || !tienThuaEl) return;

            let tienKhachDuaStr = inputTienKhach.value.trim();
            let tienKhachDua = parseInt(tienKhachDuaStr) || 0;
            let tienThua = tienKhachDua - grandTotal;

            // Nếu rỗng hoặc 0 → luôn 0đ
            if (!tienKhachDuaStr || tienKhachDua === 0) {
                tienThuaEl.textContent = '0đ';
                tienThuaEl.classList.remove('text-red-400');
                tienThuaEl.classList.add('text-white');
            } else {
                let formatted = formatNumber(Math.abs(tienThua)) + 'đ';
                if (tienThua > 0) {
                    tienThuaEl.textContent = formatted;
                    tienThuaEl.classList.remove('text-red-400');
                    tienThuaEl.classList.add('text-white');
                } else if (tienThua < 0) {
                    tienThuaEl.textContent = '-' + formatted;
                    tienThuaEl.classList.remove('text-white');
                    tienThuaEl.classList.add('text-red-400');
                } else {
                    tienThuaEl.textContent = '0đ';
                    tienThuaEl.classList.remove('text-red-400');
                    tienThuaEl.classList.add('text-white');
                }
            }

            // Kiểm tra nút thanh toán sau mỗi lần nhập
            checkThanhToan();
        }

        // Gọi ban đầu và khi nhập
        document.addEventListener('DOMContentLoaded', () => {
            formatTienThua();
            checkThanhToan();
        });

        // Thêm tooltip khi hover nút disabled
        const tooltip = document.getElementById('tooltip-thanh-toan');

        if (btnThanhToan && tooltip) {
            btnThanhToan.addEventListener('mouseenter', () => {
                if (btnThanhToan.disabled) {
                    tooltip.classList.remove('hidden');
                }
            });

            btnThanhToan.addEventListener('mouseleave', () => {
                tooltip.classList.add('hidden');
            });
        }
    </script>

</body>

</html>
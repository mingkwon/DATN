<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Bếp Nhà Mộc - Table Order Management</title>

    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;900&family=Noto+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
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

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-hidden h-screen flex">

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
                    @if(Auth::user()->usertype === 'admin')
                        <!-- Chỉ admin thấy Tổng quan -->
                        <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                            href="{{ url('home') }}">
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-white">dashboard</span>
                            <p class="text-gray-300 group-hover:text-white text-sm font-medium">Tổng quan</p>
                        </a>
                    @endif

                    <!-- Luôn hiển thị cho cả admin và staff -->
                    <!-- Active khi đang ở trang table_order hoặc tables -->
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl {{ (request()->is('tables') || request()->is('table_order/*')) ? 'bg-primary/10 border border-primary/20' : 'hover:bg-white/5' }} transition-colors group"
                        href="{{ url('tables') }}">
                        <span
                            class="material-symbols-outlined {{ (request()->is('tables') || request()->is('table_order/*')) ? 'text-primary fill-1' : 'text-gray-400 group-hover:text-white' }}">table_restaurant</span>
                        <p
                            class="{{ (request()->is('tables') || request()->is('table_order/*')) ? 'text-primary font-bold' : 'text-gray-300 group-hover:text-white' }} text-sm">
                            Bàn phục vụ</p>
                    </a>

                    <!-- Danh sách đặt bàn -->
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->is('bookings') ? 'bg-primary/10 border border-primary/20' : 'hover:bg-white/5' }} transition-colors group"
                        href="{{ url('bookings') }}">
                        <span
                            class="material-symbols-outlined {{ request()->is('bookings') ? 'text-primary fill-1' : 'text-gray-400 group-hover:text-white' }}">receipt_long</span>
                        <p
                            class="{{ request()->is('bookings') ? 'text-primary font-bold' : 'text-gray-300 group-hover:text-white' }} text-sm">
                            Danh sách đặt bàn</p>
                    </a>

                    @if(Auth::user()->usertype === 'admin')
                        <!-- Chỉ admin thấy Quản lý thực đơn -->
                        <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                            href="{{ url('add_food') }}">
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-white">restaurant</span>
                            <p class="text-gray-300 group-hover:text-white text-sm font-medium">Quản lý thực đơn</p>
                        </a>

                        <!-- Chỉ admin thấy Cài đặt -->
                        <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                            href="#">
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-white">settings</span>
                            <p class="text-gray-300 group-hover:text-white text-sm font-medium">Cài đặt</p>
                        </a>
                    @endif
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

        <main class="flex-1 flex flex-col h-full overflow-hidden">
            <header
                class="relative flex-shrink-0 p-6 pb-2 border-b border-border-dark bg-surface-dark/50 backdrop-blur-md z-10 flex flex-col gap-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button
                            class="lg:hidden size-10 rounded-xl bg-surface-dark border border-border-dark flex items-center justify-center text-gray-400">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <div class="flex items-center gap-3">
                            <button onclick="window.location.href = '{{ url('tables') }}'"
                                class="text-gray-400 hover:text-white transition-colors focus:outline-none">
                                <span class="material-symbols-outlined text-3xl">arrow_back</span>
                            </button>
                            <div>
                                <h2 class="text-white text-2xl md:text-3xl font-black leading-tight tracking-tight">Bàn
                                    {{ $table->ten_ban }}
                                </h2>
                            </div>
                        </div>
                        @if(session()->has('message'))
                            <div id="session-alert"
                                class="fixed left-1/2 top-4 -translate-x-1/2 z-[1000]
                                                                                                flex items-center gap-3 px-6 py-3 rounded-xl
                                                                                                bg-[#D8ECDA] border border-primary/30
                                                                                                text-[#275626] text-sm font-medium
                                                                                                shadow-2xl animate-fade-in-up">

                                <span class="material-symbols-outlined text-xl text-[#275626] flex-shrink-0">
                                    check_circle
                                </span>

                                <span class="leading-tight">
                                    {{ session('message') }}
                                </span>

                                <button type="button" aria-label="Đóng" onclick="closeSessionAlert()"
                                    class="ml-2 flex items-center justify-center
                                                                                                w-7 h-7 rounded-full
                                                                                                text-[#275626]
                                                                                                bg-[#9FB8A0]/20 hover:bg-[#9FB8A0]/40
                                                                                                transition-all duration-200">
                                    <span class="material-symbols-outlined text-lg">close</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="relative group">
                            <button
                                class="size-11 rounded-xl bg-surface-dark border border-border-dark flex items-center justify-center text-gray-400 hover:text-white hover:border-gray-500 transition-all">
                                <span class="material-symbols-outlined">notifications</span>
                                <span
                                    class="absolute top-2.5 right-3 size-2 bg-red-500 rounded-full border-2 border-surface-dark"></span>
                            </button>
                        </div>
                        <div class="relative w-64">
                            <input
                                class="w-full pl-10 pr-4 py-3 bg-surface-dark border border-border-dark rounded-xl text-sm text-white placeholder-gray-500 focus:border-primary/50 focus:ring-0 outline-none"
                                placeholder="Tìm món ăn..." type="text" id="search-food" />
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-2">
                    <button data-type="all"
                        class="food-tab active flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-surface-dark font-bold text-sm shadow-[0_0_15px_rgba(25,230,94,0.2)] whitespace-nowrap transition-all">
                        Tất cả
                    </button>
                    <button data-type="khai_vi"
                        class="food-tab flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        Khai vị
                    </button>
                    <button data-type="mon_chinh"
                        class="food-tab flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        Món chính
                    </button>
                    <button data-type="trang_mieng"
                        class="food-tab flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        Tráng miệng
                    </button>
                    <button data-type="do_uong"
                        class="food-tab flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        Đồ uống
                    </button>
                </div>
            </header>

            <div class="flex-1 flex overflow-hidden">
                <!-- Bên trái: Danh sách món ăn từ DB -->
                <div class="flex-1 overflow-y-auto p-6 bg-background-dark">
                    <!-- Box 1: AI theo thời tiết (chỉ hiển thị khi chưa order) -->
                    <div id="ai-weather-suggestions"
                        class="mb-6 p-5 bg-surface-dark rounded-xl border border-primary/50 shadow-lg shadow-primary/10 hidden">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-primary text-xl">auto_awesome</span>
                            <h4 class="font-bold text-lg text-white">Gợi ý món ăn</h4>
                        </div>
                        <div id="ai-weather-content" class="text-sm text-gray-300 leading-relaxed min-h-[80px]">
                            Đang suy nghĩ...
                        </div>
                    </div>

                    <!-- Box 2: AI combo theo món đã order (chỉ hiển thị khi đã order) -->
                    <div id="ai-combo-suggestions"
                        class="mb-6 p-5 bg-surface-dark rounded-xl border border-primary/50 shadow-lg shadow-primary/10 hidden">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-primary text-xl">auto_awesome</span>
                            <h4 class="font-bold text-lg text-white">Gợi ý món ăn</h4>
                        </div>
                        <div id="ai-combo-content" class="text-sm text-gray-300 leading-relaxed min-h-[80px]">
                            Đang suy nghĩ...
                        </div>
                    </div>
                    <div id="food-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($foods as $food)
                            <div class="group bg-surface-dark rounded-2xl p-3 hover:shadow-xl hover:shadow-primary/10 transition-all border border-border-dark hover:border-primary cursor-pointer relative overflow-hidden food-item"
                                data-type="{{ str_replace('-', '_', $food->type) }}">
                                <div class="relative h-32 mb-3 overflow-hidden rounded-xl">
                                    <img alt="{{ $food->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        src="{{ asset('food_img/' . $food->image) }}" />
                                    <div
                                        class="absolute top-2 right-2 bg-black/60 backdrop-blur-md px-2 py-1 rounded-lg text-white text-xs font-bold">
                                        {{ number_format($food->price, 0, ',', '.') }}đ
                                    </div>
                                </div>
                                <h3 class="font-bold text-white mb-1">{{ $food->title }}</h3>
                                <p class="text-xs text-gray-400 line-clamp-2 mb-3">{{ $food->detail }}</p>
                                <button
                                    class="w-full py-2 bg-primary/10 text-primary font-medium rounded-lg group-hover:bg-primary group-hover:text-surface-dark transition-colors flex items-center justify-center gap-1 add-to-order"
                                    data-food-id="{{ $food->id }}" data-price="{{ $food->price }}"
                                    data-title="{{ $food->title }}">
                                    <span class="material-symbols-outlined text-sm">add</span> Thêm
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Bên phải: DANH SÁCH MÓN ĐÃ CHỌN (order summary) -->
                <div class="w-1/3 bg-surface-dark flex flex-col shadow-2xl relative z-10 border-l border-border-dark">
                    <div class="p-5 border-b border-border-dark flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-lg text-white">Danh sách món</h3>
                            @if($order)
                                <p class="text-xs text-gray-400">Order #{{ $order->id }} • <span
                                        id="total-item-count">{{ $orderedItems->count() }}</span> items</p>
                            @else
                                <p class="text-xs text-gray-400">Order ## • <span
                                        id="total-item-count">{{ $orderedItems->count() }}</span>
                                    items</p>
                            @endif
                        </div>
                        <!-- <button
                            class="text-primary hover:text-primary-dark text-sm font-semibold flex items-center gap-1">
                            <span class="material-symbols-outlined text-base">swap_horiz</span> Chuyển bàn
                        </button> -->
                    </div>

                    <div id="order-list" class="flex-1 overflow-y-auto p-4 space-y-3">
                        <!-- Món đã gửi bếp từ DB (đã nhóm, cộng dồn số lượng) -->
                        @foreach($orderedItems as $orderedItem)
                            <div class="flex items-start gap-3 p-3 bg-background-dark rounded-xl border border-border-dark">
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-semibold text-sm text-white line-clamp-1">
                                            {{ $orderedItem->food->title ?? 'Món không xác định' }}
                                        </h4>
                                        <span class="font-bold text-sm text-white">
                                            {{ number_format($orderedItem->gia_tai_thoi_diem_dat * $orderedItem->so_luong, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-xs text-gray-400">
                                            {{ $orderedItem->so_luong }} ×
                                            {{ number_format($orderedItem->gia_tai_thoi_diem_dat, 0, ',', '.') }}đ
                                        </p>
                                        <!-- Không có nút - +, chỉ hiển thị số lượng -->
                                    </div>
                                    <div class="mt-2 text-xs text-emerald-500 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[10px]">check_circle</span> Đã gửi bếp
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Món chưa gửi bếp (từ giỏ JS) - có viền xanh -->
                        <!-- JS sẽ render vào đây -->
                    </div>

                    <!-- Phần tổng tiền và nút thanh toán (thay thế toàn bộ div chứa nút Thanh Toán cũ) -->
                    <div class="bg-surface-dark border-t border-border-dark p-5">
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm text-gray-400">
                                <span>Tạm tính (<span id="total-item-count-bottom">{{ $distinctItemCount }}</span>
                                    món)</span>
                                <span id="total-subtotal">{{ number_format($dbSubtotal, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-400">
                                <span>VAT (8%)</span>
                                <span id="total-vat">{{ number_format(round($dbSubtotal * 0.08), 0, ',', '.') }}đ</span>
                            </div>
                            <div class="border-t border-dashed border-border-dark my-2"></div>
                            <div class="flex justify-between items-end">
                                <span class="font-bold text-white">Tổng cộng</span>
                                <span class="font-bold text-xl text-primary" id="grand-total">
                                    {{ number_format($dbSubtotal + round($dbSubtotal * 0.08), 0, ',', '.') }}đ
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-3 mb-3">
                            <button id="send-to-kitchen-btn"
                                class="flex items-center justify-center gap-2 py-3 rounded-xl bg-surface-dark border border-border-dark text-white hover:bg-white/5 transition-colors font-medium text-sm">
                                <span class="material-symbols-outlined text-sm">soup_kitchen</span>
                                Gửi bếp (<span id="kitchen-count">0</span>)
                            </button>
                        </div>

                        <!-- Nút Thanh Toán - Chỉ hiển thị khi đã có order (đã gửi bếp ít nhất 1 món) -->
                        @if($order)
                            <a href="{{ route('payment', $order->id) }}"
                                class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-primary hover:bg-primary-dark text-surface-dark font-bold text-lg shadow-[0_0_20px_rgba(25,230,94,0.3)] transition-all active:scale-95">
                                <span class="material-symbols-outlined">payments</span>
                                Thanh Toán
                            </a>
                        @else
                            <!-- Nếu chưa có order (chưa gửi bếp), nút bị disable hoặc ẩn -->
                            <button disabled
                                class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-gray-700 text-gray-400 font-bold text-lg cursor-not-allowed opacity-60">
                                <span class="material-symbols-outlined">payments</span>
                                Thanh Toán (chưa có đơn)
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Tìm kiếm món ăn
        document.getElementById('search-food')?.addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.food-item').forEach(item => {
                const title = item.querySelector('h3').textContent.toLowerCase();
                item.style.display = title.includes(searchTerm) ? 'block' : 'none';
            });
        });

        // Filter tab món ăn
        document.querySelectorAll('.food-tab').forEach(btn => {
            btn.addEventListener('click', () => {
                // Xóa active từ tất cả tab
                document.querySelectorAll('.food-tab').forEach(b => {
                    b.classList.remove('active', 'bg-primary', 'text-surface-dark', 'font-bold', 'shadow-[0_0_15px_rgba(25,230,94,0.2)]');
                    b.classList.add('bg-surface-dark', 'border', 'border-border-dark', 'text-gray-400', 'hover:text-white', 'hover:bg-white/5', 'font-medium');
                });

                // Active tab được click
                btn.classList.add('active', 'bg-primary', 'text-surface-dark', 'font-bold', 'shadow-[0_0_15px_rgba(25,230,94,0.2)]');
                btn.classList.remove('bg-surface-dark', 'border', 'border-border-dark', 'text-gray-400', 'hover:text-white', 'hover:bg-white/5', 'font-medium');

                // Lấy loại món từ data-type của tab
                const selectedType = btn.dataset.type;

                // Lọc món ăn
                document.querySelectorAll('.food-item').forEach(item => {
                    const itemType = item.dataset.type;

                    if (selectedType === 'all' || itemType === selectedType) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Active mặc định tab "Tất cả" khi load trang
        document.querySelector('.food-tab[data-type="all"]').click();

        // Thêm món vào giỏ hàng (order summary)
        let orderItems = [];
        let subtotal = 0;

        document.querySelectorAll('.add-to-order').forEach(btn => {
            btn.addEventListener('click', () => {
                const foodId = btn.dataset.foodId;
                const title = btn.dataset.title;
                const price = parseInt(btn.dataset.price);

                // Kiểm tra món đã có chưa
                const existing = orderItems.find(item => item.id === foodId);
                if (existing) {
                    existing.quantity += 1;
                } else {
                    orderItems.push({ id: foodId, title, price, quantity: 1 });
                }

                updateOrderSummary();
            });
        });

        function updateOrderSummary() {
            const list = document.getElementById('order-list');

            // Xóa phần render cũ của JS (nếu có)
            document.querySelectorAll('.js-order-item').forEach(el => el.remove());

            subtotal = 0;
            orderItems.forEach((item, index) => {
                subtotal += item.price * item.quantity;

                const totalPrice = item.price * item.quantity;

                const itemHtml = `
        <div id="js-item-${index}" class="js-order-item flex items-start gap-3 p-3 bg-primary/5 rounded-xl border border-primary/50 transition-colors">
            <div class="flex-1">
                <div class="flex justify-between items-start mb-1">
                    <h4 class="font-semibold text-sm text-white line-clamp-1">${item.title}</h4>
                    <span class="font-bold text-sm text-white">${totalPrice.toLocaleString()}đ</span>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400">${item.quantity} x ${item.price.toLocaleString()}đ</p>
                    <div class="flex items-center gap-2 bg-background-dark rounded-lg p-1 border border-border-dark">
                        <button class="w-5 h-5 flex items-center justify-center rounded bg-surface-dark hover:bg-red-900/50 text-gray-300 hover:text-red-400 transition-colors decrease-qty" data-id="${item.id}">
                            <span class="material-symbols-outlined text-xs">remove</span>
                        </button>
                        <span class="text-xs font-bold w-4 text-center text-white">${item.quantity}</span>
                        <button class="w-5 h-5 flex items-center justify-center rounded bg-surface-dark hover:bg-primary/20 text-gray-300 hover:text-primary transition-colors increase-qty" data-id="${item.id}">
                            <span class="material-symbols-outlined text-xs">add</span>
                        </button>
                    </div>
                </div>
                <div class="mt-2 text-xs text-gray-400 italic">Chưa gửi bếp</div>
            </div>
        </div>
    `;
                list.insertAdjacentHTML('beforeend', itemHtml);

                // Tự động cuộn xuống món vừa thêm
                if (index === orderItems.length - 1) {
                    const newItem = document.getElementById(`js-item-${index}`);
                    if (newItem) {
                        newItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });

            // Số món chưa gửi bếp (chỉ giỏ JS)
            document.getElementById('kitchen-count').textContent = orderItems.length;

            // Tính tổng realtime: DB + giỏ JS
            const dbSubtotal = {{ $dbSubtotal ?? 0 }};
            const jsSubtotal = subtotal;
            const totalSubtotal = dbSubtotal + jsSubtotal;

            // Số món tổng (DB + JS)
            const totalItems = {{ $orderedItems->count() ?? 0 }} + orderItems.length;

            // Cập nhật hiển thị
            document.getElementById('total-item-count').textContent = totalItems;
            document.getElementById('total-item-count-bottom').textContent = totalItems;
            document.getElementById('total-subtotal').textContent = totalSubtotal.toLocaleString() + 'đ';

            const vat = Math.round(totalSubtotal * 0.08);
            document.getElementById('total-vat').textContent = vat.toLocaleString() + 'đ';

            document.getElementById('grand-total').textContent = (totalSubtotal + vat).toLocaleString() + 'đ';
        }

        // Hiển thị thống báo
        function closeSessionAlert() {
            const alert = document.getElementById('session-alert');
            if (!alert) return;

            alert.classList.add('opacity-0', 'scale-95');
            setTimeout(() => alert.remove(), 200);
        }
        setTimeout(() => {
            closeSessionAlert();
        }, 3000);

        // Load AI theo thời tiết (cho bàn chưa order)
        function loadWeatherSuggestions() {
            const tableId = {{ $table->id }};
            fetch(`/ai-weather-suggestions/${tableId}`)
                .then(response => response.json())
                .then(data => {
                    let text = data.suggestion || 'Chưa có gợi ý theo thời tiết.';
                    text = text.replace(/\*\*(.*?)\*\*/g, '<strong style="color: #19e65e; font-weight: bold;">$1</strong>');
                    const contentEl = document.getElementById('ai-weather-content');
                    if (contentEl) contentEl.innerHTML = text;
                })
                .catch(err => {
                    const contentEl = document.getElementById('ai-weather-content');
                    if (contentEl) contentEl.innerHTML = 'Không tải được gợi ý...';
                    console.error('Weather AI error:', err);
                });
        }

        // Load AI combo 
        function loadComboSuggestions() {
            const tableId = {{ $table->id }};
            fetch(`/ai-combo-suggestions/${tableId}`)
                .then(response => response.json())
                .then(data => {
                    let text = data.suggestion || 'Chưa có gợi ý combo.';
                    text = text.replace(/\*\*(.*?)\*\*/g, '<strong style="color: #19e65e; font-weight: bold;">$1</strong>');
                    const contentEl = document.getElementById('ai-combo-content');
                    if (contentEl) contentEl.innerHTML = text;
                })
                .catch(err => {
                    const contentEl = document.getElementById('ai-combo-content');
                    if (contentEl) contentEl.innerHTML = 'Không tải được gợi ý...';
                    console.error('Combo AI error:', err);
                });
        }

        // Kiểm tra và hiển thị box phù hợp khi load trang
        document.addEventListener('DOMContentLoaded', () => {
            const dbItemCount = {{ $orderedItems->count() ?? 0 }}; // số món đã gửi bếp từ DB

            if (dbItemCount === 0) {
                // Chưa gửi bếp món nào → chỉ hiển thị AI thời tiết
                const weatherBox = document.getElementById('ai-weather-suggestions');
                if (weatherBox) weatherBox.classList.remove('hidden');
                loadWeatherSuggestions();
            } else {
                // Đã gửi bếp ít nhất 1 món → hiển thị AI combo
                const comboBox = document.getElementById('ai-combo-suggestions');
                if (comboBox) comboBox.classList.remove('hidden');
                loadComboSuggestions();
            }
        });

        // Tăng/giảm số lượng (delegate event)
        document.addEventListener('click', e => {
            if (e.target.closest('.increase-qty')) {
                const id = e.target.closest('.increase-qty').dataset.id;
                const item = orderItems.find(i => i.id === id);
                if (item) item.quantity++;
                updateOrderSummary();
            }
            if (e.target.closest('.decrease-qty')) {
                const id = e.target.closest('.decrease-qty').dataset.id;
                const item = orderItems.find(i => i.id === id);
                if (item && item.quantity > 1) {
                    item.quantity--;
                } else if (item) {
                    orderItems = orderItems.filter(i => i.id !== id);
                }
                updateOrderSummary();
            }
        });

        document.getElementById('send-to-kitchen-btn')?.addEventListener('click', function () {
            if (orderItems.length === 0) {
                return; // Không làm gì nếu giỏ trống (không cần alert)
            }

            const tableId = {{ $table->id }}; // ID bàn hiện tại

            // Thu thập dữ liệu giỏ hàng
            const itemsToSend = orderItems.map(item => ({
                id: item.id,
                quantity: item.quantity,
                price: item.price,
                note: '' // Không cần ghi chú riêng cho món
            }));

            fetch('/orders/store/' + tableId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    items: itemsToSend,
                    note: '' // Không cần ghi chú chung
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Server error: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Reload trang để cập nhật trạng thái bàn mới ("Đang dùng") và reset giao diện
                        location.reload();
                    } else {
                        // Không alert, chỉ console lỗi (hoặc bạn có thể thêm alert nếu muốn)
                        console.error('Lỗi gửi đơn:', data.message || 'Không gửi được đơn');
                    }
                })
                .catch(err => {
                    console.error('Lỗi kết nối hoặc server trả về HTML:', err);
                });

            if (data.success) {
                location.reload(); // Reload để JS kiểm tra lại số món và load box đúng
            }
        });
    </script>

</body>

</html>
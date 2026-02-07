<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Bàn phục vụ - Chế độ xem lưới tối giản</title>
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
    <div id="add-booking-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 animate-fade-in">
        <form action="{{ url('add_table') }}" method="POST">
            @csrf
            <div
                class="w-full max-w-2xl bg-surface-dark border border-border-dark rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                <div class="px-6 py-5 border-b border-border-dark flex items-center justify-between bg-white/5">
                    <h3 class="text-xl font-bold text-white">Thêm bàn mới</h3>
                    <button type="button" onclick="closeAddModal()"
                        class="text-gray-400 hover:text-white transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="p-6 overflow-y-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tên
                                bàn</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">person</span>
                                <input name="ten_ban" id="customer-name" type="text" required minlength="2" class="w-full bg-background-dark border border-border-dark text-white text-sm rounded-xl py-3 pl-11 pr-4
              focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all
              placeholder:text-gray-600" placeholder="Nhập tên bàn" />

                            </div>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                                Loại bàn
                            </label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    table_restaurant
                                </span>

                                <select name="loai_ban" required class="w-full bg-background-dark border border-border-dark text-white text-sm rounded-xl
                   py-3 pl-11 pr-10
                   focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary
                   transition-all appearance-none cursor-pointer">

                                    <option value="" disabled selected class="text-gray-600">
                                        Chọn loại bàn
                                    </option>
                                    <option value="thuong">Bàn thường</option>
                                    <option value="vip">Bàn VIP</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">
                                Vị trí bàn
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                <!-- TIÊU CHUẨN -->
                                <label class="cursor-pointer relative group">
                                    <input checked class="peer sr-only" name="vi_tri" type="radio" value="Tiêu chuẩn" />
                                    <div class="p-4 rounded-xl bg-background-dark border border-border-dark
                       peer-checked:border-primary peer-checked:bg-primary/5
                       hover:border-gray-500 transition-all h-full">
                                        <div class="mb-2 w-10 h-10 rounded-full bg-border-dark
                           peer-checked:bg-primary peer-checked:text-background-dark
                           flex items-center justify-center text-gray-300">
                                            <span class="material-symbols-outlined">deck</span>
                                        </div>
                                        <p class="text-white font-bold text-sm">Tiêu chuẩn</p>
                                        <p class="text-xs text-gray-400 mt-1">Khu vực chung</p>
                                    </div>
                                    <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-primary">
                                        <span class="material-symbols-outlined text-lg">check_circle</span>
                                    </div>
                                </label>

                                <!-- GẦN CỬA SỔ -->
                                <label class="cursor-pointer relative group">
                                    <input class="peer sr-only" name="vi_tri" type="radio" value="Gần cửa sổ" />
                                    <div class="p-4 rounded-xl bg-background-dark border border-border-dark
                       peer-checked:border-primary peer-checked:bg-primary/5
                       hover:border-gray-500 transition-all h-full">
                                        <div class="mb-2 w-10 h-10 rounded-full bg-border-dark
                           peer-checked:bg-primary peer-checked:text-background-dark
                           flex items-center justify-center text-gray-300">
                                            <span class="material-symbols-outlined">window</span>
                                        </div>
                                        <p class="text-white font-bold text-sm">Gần cửa sổ</p>
                                        <p class="text-xs text-gray-400 mt-1">Ngắm cảnh</p>
                                    </div>
                                    <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-primary">
                                        <span class="material-symbols-outlined text-lg">check_circle</span>
                                    </div>
                                </label>

                                <!-- RIÊNG TƯ -->
                                <label class="cursor-pointer relative group">
                                    <input class="peer sr-only" name="vi_tri" type="radio" value="Riêng tư" />
                                    <div class="p-4 rounded-xl bg-background-dark border border-border-dark
                       peer-checked:border-primary peer-checked:bg-primary/5
                       hover:border-gray-500 transition-all h-full">
                                        <div class="mb-2 w-10 h-10 rounded-full bg-border-dark
                           peer-checked:bg-primary peer-checked:text-background-dark
                           flex items-center justify-center text-gray-300">
                                            <span class="material-symbols-outlined">privacy_tip</span>
                                        </div>
                                        <p class="text-white font-bold text-sm">Riêng tư</p>
                                        <p class="text-xs text-gray-400 mt-1">Yên tĩnh</p>
                                    </div>
                                    <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-primary">
                                        <span class="material-symbols-outlined text-lg">check_circle</span>
                                    </div>
                                </label>

                                <!-- NGOÀI TRỜI -->
                                <label class="cursor-pointer relative group">
                                    <input class="peer sr-only" name="vi_tri" type="radio" value="Ngoài trời" />
                                    <div class="p-4 rounded-xl bg-background-dark border border-border-dark
                       peer-checked:border-primary peer-checked:bg-primary/5
                       hover:border-gray-500 transition-all h-full">
                                        <div class="mb-2 w-10 h-10 rounded-full bg-border-dark
                           peer-checked:bg-primary peer-checked:text-background-dark
                           flex items-center justify-center text-gray-300">
                                            <span class="material-symbols-outlined">yard</span>
                                        </div>
                                        <p class="text-white font-bold text-sm">Ngoài trời</p>
                                        <p class="text-xs text-gray-400 mt-1">Thoáng mát</p>
                                    </div>
                                    <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-primary">
                                        <span class="material-symbols-outlined text-lg">check_circle</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-5 border-t border-border-dark bg-white/5 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeAddModal()"
                        class="px-6 py-2.5 rounded-xl border border-border-dark text-gray-300 font-bold text-sm hover:bg-white/5 hover:text-white transition-all">
                        Hủy
                    </button>
                    <button type="submit" id="confirm-button"
                        class="px-6 py-2.5 rounded-xl bg-primary text-background-dark font-bold text-sm hover:bg-primary-dark shadow-[0_0_20px_rgba(25,230,94,0.3)] hover:shadow-[0_0_25px_rgba(25,230,94,0.4)] transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">add</span>
                        Thêm mới
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="flex h-screen w-full">
        <div
            class="w-[280px] h-full flex-col justify-between bg-surface-dark border-r border-border-dark hidden lg:flex flex-shrink-0 z-30">
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
                        href="{{ url('add_food') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">restaurant</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Quản lý thực đơn</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('bookings') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">receipt_long</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Danh sách đặt bàn</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="#">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">inventory_2</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Kho hàng</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="#">
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
        <div class="flex-1 flex flex-col h-full overflow-hidden relative bg-background-light dark:bg-background-dark">
            <div
                class="flex-shrink-0 p-6 pb-2 border-b border-border-dark bg-surface-dark/50 backdrop-blur-md z-10 flex flex-col gap-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button
                            class="lg:hidden size-10 rounded-xl bg-surface-dark border border-border-dark flex items-center justify-center text-gray-400">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <div>
                            <h1 class="text-white text-2xl md:text-3xl font-black leading-tight tracking-tight">Bàn phục
                                vụ</h1>
                            <p class="text-gray-400 text-sm font-normal mt-1">Quản lý trạng thái bàn ăn trực tiếp</p>
                        </div>
                    </div>

                    <!-- Phần bên phải: tất cả nằm sát nhau -->
                    <div class="flex items-center gap-4 md:gap-6">
                        <!-- Legend (ẩn trên mobile, hiện từ md trở lên) -->
                        <div
                            class="hidden md:flex items-center gap-4 bg-surface-dark border border-border-dark rounded-xl px-4 py-2">
                            <div class="flex items-center gap-2">
                                <span
                                    class="size-3 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.3)]"></span>
                                <span class="text-xs text-gray-300 font-medium">Trống</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="size-3 rounded-full bg-yellow-500 shadow-[0_0_10px_rgba(234,179,8,0.3)]"></span>
                                <span class="text-xs text-gray-300 font-medium">Đang dùng</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="size-3 rounded-full bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.3)]"></span>
                                <span class="text-xs text-gray-300 font-medium">Đã đặt</span>
                            </div>
                        </div>

                        <!-- Icon thông báo -->
                        <div class="relative group">
                            <button
                                class="size-11 rounded-xl bg-surface-dark border border-border-dark flex items-center justify-center text-gray-400 hover:text-white hover:border-gray-500 transition-all">
                                <span class="material-symbols-outlined">notifications</span>
                                <span
                                    class="absolute top-2.5 right-3 size-2 bg-red-500 rounded-full border-2 border-surface-dark"></span>
                            </button>
                        </div>

                        <!-- Nút Thêm bàn mới -->
                        <button onclick="openAddModal()"
                            class="flex items-center gap-2 bg-primary hover:bg-primary-dark active:scale-95 transition-all text-background-dark px-5 py-3 rounded-xl font-bold text-sm shadow-[0_0_20px_rgba(25,230,94,0.3)] cursor-pointer no-underline"
                            href="#">
                            <span class="material-symbols-outlined text-xl">add_circle</span>
                            <span>Thêm bàn mới</span>
                        </button>
                    </div>
                </div>
                <div id="table-tabs" class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-2">
                    <button data-type="Tiêu chuẩn"
                        class="tab-btn active flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-surface-dark font-bold text-sm shadow-[0_0_15px_rgba(25,230,94,0.2)] whitespace-nowrap transition-all">
                        <span class="material-symbols-outlined text-lg">deck</span>
                        Khu Tiêu chuẩn
                    </button>
                    <button data-type="Riêng tư"
                        class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        <span class="material-symbols-outlined text-lg">meeting_room</span>
                        Khu Riêng tư
                    </button>
                    <button data-type="Gần cửa sổ"
                        class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        <span class="material-symbols-outlined text-lg">window</span>
                        Gần cửa sổ
                    </button>
                    <button data-type="Ngoài trời"
                        class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        <span class="material-symbols-outlined text-lg">deck</span>
                        Ngoài trời
                    </button>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto p-6 bg-background-dark">
                <div id="table-grid"
                    class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-6">
                    @foreach($tables as $table)
                        <div class="group relative bg-surface-dark border border-border-dark rounded-2xl p-5 flex flex-col items-center justify-center gap-4 cursor-pointer transition-all hover:shadow-lg hover:shadow-primary/10 hover:-translate-y-1 table-item"
                            data-type="{{ $table->vi_tri }}"
                            data-time-use="{{ $table->trang_thai == 'Đang dùng' ? '00:45' : '' }}"
                            data-time-booked="{{ $table->latestBooking?->time ?? '' }}">

                            <!-- 1. Chấm xanh góc trên phải cho bàn Trống -->
                            @if($table->trang_thai == 'Trống')
                                <div
                                    class="absolute top-3 right-3 size-3 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]">
                                </div>
                            @endif

                            <!-- 2. Thời gian góc trên phải (cho Đang dùng và Đã đặt) -->
                            <div class="absolute top-3 right-3 flex items-center gap-1 text-[10px] font-bold px-2 py-1 rounded bg-opacity-20
                                            {{ $table->trang_thai == 'Đang dùng' ? 'bg-yellow-500/20 text-yellow-500' : '' }}
                                            {{ $table->trang_thai == 'Đã đặt' ? 'bg-blue-500/20 text-blue-500' : '' }}">
                                <!-- JS sẽ fill nội dung thời gian dựa trên data attribute -->
                            </div>

                            <!-- 3. Icon và nền theo trạng thái -->
                            <div class="size-20 rounded-full flex items-center justify-center transition-transform group-hover:scale-110 duration-300
                                            {{ $table->trang_thai == 'Trống' ? 'bg-primary/10 text-primary' : '' }}
                                            {{ $table->trang_thai == 'Đang dùng' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                                            {{ $table->trang_thai == 'Đã đặt' ? 'bg-blue-500/10 text-blue-500' : '' }}">
                                <span class="material-symbols-outlined text-4xl">
                                    {{ $table->trang_thai == 'Trống' ? 'table_restaurant' : '' }}
                                    {{ $table->trang_thai == 'Đang dùng' ? 'restaurant' : '' }}
                                    {{ $table->trang_thai == 'Đã đặt' ? 'event_seat' : '' }}
                                </span>
                            </div>

                            <div class="text-center">
                                <h3 class="text-white text-xl font-bold">{{ $table->ten_ban }}</h3>
                                <p class="text-sm font-bold uppercase tracking-wide mt-1
                                                {{ $table->trang_thai == 'Trống' ? 'text-primary' : '' }}
                                                {{ $table->trang_thai == 'Đang dùng' ? 'text-yellow-500' : '' }}
                                                {{ $table->trang_thai == 'Đã đặt' ? 'text-blue-500' : '' }}">
                                    {{ $table->trang_thai }}
                                </p>
                            </div>

                            <!-- Link order bàn -->
                            <a href="{{ url('table_order/' . $table->id) }}" class="absolute inset-0"></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        function openDeleteModal(id) {
            const modal = document.getElementById('delete-modal');
            const deleteBtn = document.getElementById('confirm-delete-btn');

            deleteBtn.href = `/delete_booking/${id}`;
            modal.classList.remove('hidden');
        }
        function openAddModal() {
            document.getElementById('add-booking-modal').classList.remove('hidden');
            document.getElementById('add-booking-modal').classList.add('flex');
        }

        function closeAddModal() {
            document.getElementById('add-booking-modal').classList.add('hidden');
            document.getElementById('add-booking-modal').classList.remove('flex');
        }
        document.querySelector('#add-booking-modal form')
            .addEventListener('submit', function (e) {
                const name = document.getElementById('customer-name').value.trim();
                if (!name) {
                    e.preventDefault();
                }
            });

        // Filter bàn theo tab
        const ACTIVE_CLASSES = [
            'active',
            'bg-primary',
            'text-surface-dark',
            'font-bold',
            'shadow-[0_0_15px_rgba(25,230,94,0.2)]'
        ];

        const INACTIVE_CLASSES = [
            'bg-surface-dark',
            'border',
            'border-border-dark',
            'text-gray-400',
            'font-medium',
            'hover:text-white',
            'hover:bg-white/5'
        ];

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {

                // Reset tất cả tab
                document.querySelectorAll('.tab-btn').forEach(b => {
                    b.classList.remove(...ACTIVE_CLASSES);
                    b.classList.add(...INACTIVE_CLASSES);
                });

                // Active tab được click
                btn.classList.add(...ACTIVE_CLASSES);
                btn.classList.remove(...INACTIVE_CLASSES);

                // Filter table
                const type = btn.dataset.type;
                document.querySelectorAll('.table-item').forEach(item => {
                    item.style.display =
                        item.dataset.type === type ? 'flex' : 'none';
                });
            });
        });

        // Active mặc định
        document.querySelector('.tab-btn[data-type="Tiêu chuẩn"]').click();

        // Hiển thị thời gian cho bàn đang dùng và đã đặt
        document.querySelectorAll('.table-item').forEach(item => {
            const status = item.querySelector('p.text-sm.font-bold.uppercase').textContent.trim();
            const timeDiv = item.querySelector('.absolute.top-3.right-3');

            // Giả sử bạn truyền data-time-use và data-time-booked từ Blade
            const timeUse = item.dataset.timeUse;     // ví dụ: "00:45"
            const timeBooked = item.dataset.timeBooked; // ví dụ: "19:30"

            if (status === 'Đang dùng' && timeUse) {
                timeDiv.innerHTML = `
                    <span class="material-symbols-outlined text-[12px]">schedule</span>
                    <span>${timeUse}</span>
                `;
            }
            else if (status === 'Đã đặt' && timeBooked) {
                timeDiv.innerHTML = `
                    <span class="material-symbols-outlined text-[12px]">alarm</span>
                    <span>${timeBooked}</span>
                `;
            }
            else if (status === 'Trống') {
                timeDiv.innerHTML = ''; // Xóa nếu có
            }
        });
    </script>

</body>

</html>
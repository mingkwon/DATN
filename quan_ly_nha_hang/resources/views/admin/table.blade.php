<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <!-- Modal quản lý xóa bàn (chỉ admin) -->
    <div class="hidden fixed inset-0 z-[100] bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 overflow-auto"
        id="delete-tables-modal">
        <div
            class="w-full max-w-5xl bg-surface-dark border border-border-dark rounded-3xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200 relative">
            <!-- Header -->
            <div class="p-6 border-b border-border-dark flex items-center justify-between bg-white/5">
                <div class="flex items-center gap-3">
                    <div class="size-10 rounded-full bg-red-500/10 text-red-500 flex items-center justify-center">
                        <span class="material-symbols-outlined">delete_sweep</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Quản lý xóa bàn</h2>
                        <p class="text-xs text-gray-400">Chỉ xóa được bàn đang Trống. Không thể khôi phục!</p>
                    </div>
                </div>
                <button onclick="closeDeleteTablesModal()"
                    class="size-10 rounded-xl bg-background-dark flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <!-- Nội dung danh sách bàn -->
            <div class="p-6 max-h-[65vh] overflow-y-auto">
                <div class="space-y-10">
                    @php
                        $groupedTables = $tables->groupBy('vi_tri');
                    @endphp

                    @foreach(['Tiêu chuẩn', 'Gần cửa sổ', 'Riêng tư', 'Ngoài trời'] as $vi_tri)
                        @if($groupedTables->has($vi_tri))
                            <div>
                                <h3
                                    class="text-primary text-xs font-black uppercase tracking-widest mb-5 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">
                                        {{ $vi_tri === 'Tiêu chuẩn' ? 'deck' : ($vi_tri === 'Gần cửa sổ' ? 'window' : ($vi_tri === 'Riêng tư' ? 'meeting_room' : 'yard')) }}
                                    </span>
                                    Khu {{ $vi_tri }}
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                    @foreach($groupedTables[$vi_tri] as $table)
                                        <div
                                            class="group relative flex items-center justify-between p-5 rounded-2xl bg-background-dark border border-border-dark hover:border-red-500/50 transition-all min-h-[100px]">
                                            <div class="flex items-center gap-4">
                                                <span
                                                    class="material-symbols-outlined text-3xl
                                                                                                {{ $table->trang_thai === 'Trống' ? 'text-primary' : ($table->trang_thai === 'Đang dùng' ? 'text-yellow-500' : 'text-blue-500') }}">
                                                    {{ $table->trang_thai === 'Trống' ? 'table_restaurant' : ($table->trang_thai === 'Đang dùng' ? 'restaurant' : 'event_seat') }}
                                                </span>
                                                <div>
                                                    <p class="text-white font-bold text-lg">Bàn {{ $table->ten_ban }}</p>
                                                    <p class="text-gray-500 text-sm mt-1">{{ $table->trang_thai }}</p>
                                                </div>
                                            </div>

                                            <!-- Nút xóa chỉ cho bàn Trống -->
                                            @if($table->trang_thai === 'Trống')
                                                <button onclick="confirmDeleteTable({{ $table->id }}, '{{ addslashes($table->ten_ban) }}')"
            class="size-10 rounded-xl flex items-center justify-center text-gray-500 hover:bg-red-500 hover:text-white transition-all opacity-0 group-hover:opacity-100">
        <span class="material-symbols-outlined text-xl">delete</span>
    </button>
                                            @else
                                                <button disabled
                                                    class="size-11 rounded-xl flex items-center justify-center text-gray-600 cursor-not-allowed opacity-50">
                                                    <span class="material-symbols-outlined text-2xl">delete</span>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @if($tables->isEmpty())
                        <div class="text-center text-gray-400 py-12 text-lg">
                            Chưa có bàn nào để xóa.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-background-dark/50 p-6 flex justify-end border-t border-border-dark">
                <button onclick="closeDeleteTablesModal()"
                    class="px-8 py-3 rounded-xl bg-surface-dark border border-border-dark text-gray-300 hover:text-white font-bold text-sm transition-all">
                    Đóng
                </button>
            </div>
        </div>
    </div>

    <!-- Modal xác nhận xóa bàn -->
    <div id="confirm-delete-table-modal"
        class="fixed inset-0 z-[110] hidden flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
        <div
            class="bg-surface-dark border border-border-dark rounded-3xl shadow-2xl p-10 max-w-lg w-full text-center animate-in fade-in zoom-in duration-200">
            <div class="size-16 rounded-full bg-red-500/10 text-red-500 flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-4xl">warning</span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">Xác nhận xóa bàn</h3>
            <p class="text-gray-300 mb-3">Bạn có chắc chắn muốn xóa</p>
            <p id="delete-table-name" class="text-xl font-bold text-red-500 mb-6"></p>
            <p class="text-gray-400 mb-10">Hành động này không thể hoàn tác!</p>

            <div class="flex justify-center gap-6">
                <button id="cancel-delete-table"
                    class="px-8 py-3 bg-surface-dark border border-border-dark text-gray-300 font-bold rounded-xl hover:bg-white/5 transition-all">
                    Không xóa
                </button>

                <!-- Dùng <a> với GET thay vì form -->
                <a id="confirm-delete-table-link" href="#"
                    class="px-8 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-all shadow-[0_0_20px_rgba(239,68,68,0.4)]">
                    Có, xóa bàn
                </a>
            </div>
        </div>
    </div>

    <!-- Modal popup khi click bàn "Đã đặt" -->
    <div id="booked-table-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4">
        <div class="bg-surface-dark border border-border-dark rounded-2xl shadow-2xl p-8 max-w-md w-full text-center">
            <h3 class="text-2xl font-bold text-white mb-4">Bàn này đã được đặt</h3>
            <p class="text-gray-300 mb-8">Bàn này đã được đặt, đang chờ khách đến.</p>

            <div class="flex justify-center gap-4">
                <!-- Nút Mở bàn ngay -->
                <button id="open-table-btn"
                    class="px-6 py-3 bg-primary text-background-dark font-bold rounded-xl hover:bg-primary-dark transition-all shadow-[0_0_15px_rgba(25,230,94,0.3)]">
                    Mở bàn ngay
                </button>

                <!-- Nút Hủy bàn đặt -->
                <button id="cancel-booking-btn"
                    class="px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-all">
                    Hủy bàn đặt
                </button>
            </div>

            <button id="close-booked-modal" class="mt-6 text-gray-400 hover:text-white transition-colors">
                Đóng
            </button>
        </div>
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
                            href="{{ url('setting') }}">
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

                        <!-- Nút Thêm bàn mới chỉ dành cho admin -->
                        @if(Auth::user()->usertype === 'admin')
                            <button onclick="openAddModal()"
                                class="flex items-center gap-2 bg-primary hover:bg-primary-dark active:scale-95 transition-all text-background-dark px-5 py-3 rounded-xl font-bold text-sm shadow-[0_0_20px_rgba(25,230,94,0.3)] cursor-pointer no-underline"
                                href="#">
                                <span class="material-symbols-outlined text-xl">add_circle</span>
                                <span>Thêm bàn mới</span>
                            </button>
                        @endif

                        <!-- Nút Xóa bàn - chỉ admin -->
                        @if(Auth::user()->usertype === 'admin')
                            <button onclick="openDeleteTablesModal()"
                                class="flex items-center gap-2 bg-red-600/80 hover:bg-red-700 active:scale-95 transition-all text-white px-5 py-3 rounded-xl font-bold text-sm shadow-[0_0_20px_rgba(239,68,68,0.3)] cursor-pointer no-underline">
                                <span class="material-symbols-outlined text-xl">delete_forever</span>
                                <span>Xóa bàn</span>
                            </button>
                        @endif
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
                    @foreach($tables->whereNull('deleted_at') as $table)
                        @php
                            $activeBooking = $tableExtras[$table->id] ?? null;
                        @endphp

                        <div class="group relative bg-surface-dark border border-border-dark rounded-2xl p-6 flex flex-col items-center justify-center gap-6 cursor-pointer transition-all hover:shadow-lg hover:shadow-primary/10 hover:-translate-y-1 table-item min-h-[220px]"
                            data-type="{{ $table->vi_tri }}" data-table-id="{{ $table->id }}"
                            data-booking-id="{{ $activeBooking?->id ?? '' }}">

                            <!-- Chấm xanh góc trên phải cho bàn Trống -->
                            @if($table->trang_thai == 'Trống')
                                <div
                                    class="absolute top-3 right-3 size-3 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]">
                                </div>
                            @endif

                            <!-- Thời gian góc trên phải (cho Đang dùng) -->
                            @if($table->trang_thai == 'Đang dùng' && $table->currentOrder)
                                <div class="absolute top-3 right-3 flex items-center gap-1 text-xs font-bold px-2 py-1 rounded bg-yellow-500/20 text-yellow-400 shadow-md usage-time"
                                    data-opened-at="{{ $table->currentOrder->created_at->toISOString() }}">
                                    <span class="material-symbols-outlined text-sm">schedule</span>
                                    <span class="time-display">00:00</span>
                                </div>
                            @endif

                            <!-- Thời gian góc trên phải (cho Đã đặt) -->
                            @if($table->trang_thai == 'Đã đặt' && $activeBooking?->time)
                                <div
                                    class="absolute top-3 right-3 flex items-center gap-1 text-[10px] font-bold px-2 py-1 rounded bg-blue-500/20 text-blue-500 shadow-md">
                                    <span class="material-symbols-outlined text-[12px]">alarm</span>
                                    <span>{{ $activeBooking->time }}</span>
                                </div>
                            @endif

                            <!-- Tên khách hàng góc trên bên trái (chỉ cho bàn Đã đặt) -->
                            @if($table->trang_thai == 'Đã đặt' && $activeBooking?->name)
                                <div
                                    class="absolute top-3 left-3 flex items-center gap-1 text-[10px] font-bold px-2 py-1 rounded bg-blue-500/20 text-blue-500 shadow-md max-w-[120px] truncate">
                                    <span class="material-symbols-outlined text-[12px]">person</span>
                                    <span class="truncate">{{ $activeBooking->name }}</span>
                                </div>
                            @endif

                            <!-- Icon và nền theo trạng thái -->
                            <div
                                class="size-24 rounded-full flex items-center justify-center transition-transform group-hover:scale-110 duration-300 mt-8
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
                                <h3 class="text-white text-xl font-bold">Bàn {{ $table->ten_ban }}</h3>
                                <p
                                    class="text-sm font-bold uppercase tracking-wide mt-1
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

        function closeSessionAlert() {
            const alert = document.getElementById('session-alert');
            if (!alert) return;

            alert.classList.add('opacity-0', 'scale-95');
            setTimeout(() => alert.remove(), 200);
        }
        setTimeout(() => {
            closeSessionAlert();
        }, 3000);

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

        // Mở modal khi click bàn "Đã đặt"
        document.querySelectorAll('.table-item').forEach(item => {
            item.addEventListener('click', (e) => {
                const status = item.querySelector('p.text-sm.font-bold.uppercase').textContent.trim();
                if (status === 'Đã đặt') {
                    e.preventDefault();

                    const orderLink = item.querySelector('a.absolute.inset-0');
                    const tableId = orderLink ? orderLink.getAttribute('href').split('/').pop() : null;

                    if (!tableId) {
                        alert('Không tìm thấy ID bàn!');
                        return;
                    }

                    const bookingId = item.dataset.bookingId;

                    if (!bookingId) {
                        alert('Không tìm thấy đặt bàn liên kết!');
                        return;
                    }

                    document.getElementById('booked-table-modal').classList.remove('hidden');
                    document.getElementById('booked-table-modal').classList.add('flex');

                    // Nút Mở bàn ngay → chuyển đến table_order
                    document.getElementById('open-table-btn').onclick = () => {
                        window.location.href = `/table_order/${tableId}`;
                    };

                    // Nút Hủy bàn đặt → hủy booking
                    document.getElementById('cancel-booking-btn').onclick = () => {
                        if (confirm('Bạn chắc chắn muốn hủy đặt bàn này?')) {
                            fetch(`/reject_book/${bookingId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),  // ← Sửa thành lấy từ meta tag
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({})  // ← Thêm body rỗng nếu cần (Laravel POST thường yêu cầu)
                            })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Lỗi server: ' + response.status);
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        alert('Đã hủy đặt bàn thành công!');
                                        location.reload(); // Reload để cập nhật UI (bàn về Trống)
                                    } else {
                                        alert('Lỗi: ' + (data.message || 'Không thể hủy'));
                                    }
                                })
                                .catch(err => {
                                    console.error(err);
                                    alert('Lỗi kết nối hoặc server: ' + err.message);
                                });
                        }
                    };
                }
            });
        });

        // Đóng modal
        document.getElementById('close-booked-modal')?.addEventListener('click', () => {
            document.getElementById('booked-table-modal').classList.add('hidden');
            document.getElementById('booked-table-modal').classList.remove('flex');
        });

        // Tính thời gian sử dụng cho tất cả bàn "Đang dùng" (chỉ HH:MM)
        document.querySelectorAll('.usage-time').forEach(container => {
            const openedAtStr = container.getAttribute('data-opened-at');
            const timeDisplay = container.querySelector('.time-display');

            if (!openedAtStr || !timeDisplay) return;

            const startTime = new Date(openedAtStr);

            function updateTime() {
                const now = new Date();
                const diffMs = now - startTime;

                const hours = Math.floor(diffMs / (1000 * 60 * 60));
                const minutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));

                timeDisplay.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
            }

            updateTime();
            setInterval(updateTime, 1000); // Cập nhật mỗi phút (vì chỉ cần phút, không cần giây)
        });

        // Tự hủy booking sau 15 phút nếu chưa mở bàn
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.table-item[data-time-booked]').forEach(item => {
                const timeBooked = item.dataset.timeBooked;
                if (!timeBooked) return;

                const bookingTime = new Date(`${new Date().toDateString()} ${timeBooked}`);
                const expireTime = new Date(bookingTime);
                expireTime.setMinutes(expireTime.getMinutes() + 15);

                function checkExpire() {
                    const now = new Date();
                    if (now > expireTime) {
                        const bookingId = item.dataset.bookingId;
                        if (bookingId) {
                            fetch(`/bookings/${bookingId}/cancel`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        item.querySelector('p.text-sm.font-bold.uppercase').textContent = 'Trống';
                                        item.classList.remove('bg-blue-500/10', 'text-blue-500');
                                        item.classList.add('bg-emerald-500/10', 'text-primary');
                                        item.querySelector('.absolute.top-3.right-3').innerHTML = '<span class="size-3 rounded-full bg-emerald-500 animate-pulse"></span>';
                                    }
                                });
                        }
                    }
                }

                checkExpire();
                setInterval(checkExpire, 1000);
            });
        });

        // Mở modal danh sách bàn để xóa
        function openDeleteTablesModal() {
            document.getElementById('delete-tables-modal').classList.remove('hidden');
        }

        // Đóng modal danh sách bàn
        function closeDeleteTablesModal() {
            document.getElementById('delete-tables-modal').classList.add('hidden');
        }

        // Mở modal xác nhận xóa bàn cụ thể
        function confirmDeleteTable(tableId, tableName) {
            document.getElementById('delete-table-name').textContent = `Bàn ${tableName}?`;

            // Cập nhật link GET
            const link = document.getElementById('confirm-delete-table-link');
            link.href = `/delete_table/${tableId}`;

            // Mở modal
            document.getElementById('confirm-delete-table-modal').classList.remove('hidden');
        }

        // Đóng modal xác nhận
        document.getElementById('cancel-delete-table')?.addEventListener('click', () => {
            document.getElementById('confirm-delete-table-modal').classList.add('hidden');
        });

        // Optional: Đóng modal danh sách khi click bên ngoài
        document.getElementById('delete-tables-modal')?.addEventListener('click', function (e) {
            if (e.target === this) closeDeleteTablesModal();
        });
    </script>


</body>

</html>
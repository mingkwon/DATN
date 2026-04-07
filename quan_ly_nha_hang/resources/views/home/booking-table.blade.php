<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đặt bàn trực tuyến - Laravel Restaurant AI</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Tailwind Config -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#19e65e",
                        "primary-dark": "#14b84b",
                        "background-light": "#f6f8f6",
                        "background-dark": "#111813",
                        "surface-dark": "#1c2620",
                        "surface-border": "#29382e",
                    },
                    fontFamily: {
                        display: ["Work Sans", "sans-serif"],
                        body: ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        lg: "1rem",
                        xl: "1.5rem",
                        "2xl": "2rem",
                        full: "9999px"
                    },
                },
            },
        }
    </script>

    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #111813;
        }

        ::-webkit-scrollbar-thumb {
            background: #29382e;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #3e5244;
        }

        .glass-effect {
            background: rgba(28, 38, 32, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-x-hidden min-h-screen flex flex-col">

    <!-- Header -->
    <header
        class="sticky top-0 z-50 flex items-center justify-between border-b border-solid border-b-[#e0e0e0] dark:border-b-[#29382e] bg-white/95 dark:bg-[#111813]/95 backdrop-blur-md px-10 py-3">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-4 text-[#111813] dark:text-white cursor-pointer">
                <div class="size-8 text-primary">
                    <span class="material-symbols-outlined !text-[32px]">restaurant_menu</span>
                </div>
                <h2 class="text-[#111813] dark:text-white text-xl font-black leading-tight tracking-[-0.015em]">
                    DeliciousAI</h2>
            </div>
            <nav class="hidden lg:flex items-center gap-9">
                <a class="text-[#111813] dark:text-[#9db8a6] text-sm font-bold hover:text-primary transition-colors"
                    href="{{ url('home') }}">Trang chủ</a>
                <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium hover:text-primary transition-colors"
                    href="{{ url('menu') }}">Thực đơn</a>
                <a class="text-[#637588] dark:text-white text-sm font-medium hover:text-primary transition-colors"
                    href="#">Đặt bàn</a>
                <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                    href="{{ url('intro') }}">Giới thiệu</a>
            </nav>
        </div>
        <div class="flex flex-1 justify-end gap-6 items-center">
            <!-- Phần đăng nhập/đăng ký/đăng xuất -->
            @guest
                <!-- Chưa đăng nhập: hiển thị Truy cập quản lý -->
                <a href="{{ route('login') }}"
                    class="flex items-center justify-center rounded-xl h-10 px-6 bg-primary text-[#112116] text-sm font-bold hover:bg-[#15c550] transition-all shadow-sm hover:shadow-md hover:scale-105">
                    <span class="material-symbols-outlined mr-2">admin_panel_settings</span>
                    Truy cập quản lý
                </a>
            @else
                <!-- Đã đăng nhập: hiển thị Đăng xuất (fit kích thước) -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center rounded-xl h-10 px-6 bg-surface-600/10 border border-white-500/30 text-white-400 hover:border-red-500/50 hover:bg-red-600/20 hover:text-red-300 hover:scale-105 transition-all text-sm font-bold shadow-sm hover:shadow-md">
                        <span class="material-symbols-outlined mr-2 text-base">logout</span>
                        Đăng xuất
                    </button>
                </form>
            @endguest
        </div>
    </header>

    <main class="flex-grow flex flex-col items-center w-full py-8 px-4 md:px-8 max-w-[1400px] mx-auto">
        <!-- Page Heading -->
        <div class="w-full mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="flex flex-col gap-2">
                <h1 class="text-white text-4xl md:text-5xl font-black leading-tight tracking-tight">Đặt bàn trực tuyến
                </h1>
                <p class="text-[#9db8a6] text-lg font-normal flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-sm">auto_awesome</span>
                    Trải nghiệm ẩm thực tuyệt vời
                </p>
            </div>

            <div>
                @if(session()->has('message'))
                    <div id="session-alert" class="fixed left-1/2 top-4 -translate-x-1/2 z-[1000]
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

                        <button type="button" aria-label="Đóng" onclick="closeSessionAlert()" class="ml-2 flex items-center justify-center
                                                    w-7 h-7 rounded-full
                                                    text-[#275626]
                                                    bg-[#9FB8A0]/20 hover:bg-[#9FB8A0]/40
                                                    transition-all duration-200">
                            <span class="material-symbols-outlined text-lg">close</span>
                        </button>
                    </div>
                @endif
            </div>
            <div
                class="hidden md:flex items-center gap-2 px-4 py-2 bg-surface-dark rounded-full border border-surface-border text-sm text-gray-400">
                <span class="material-symbols-outlined text-primary">check_circle</span>
                <span>Đặt bàn miễn phí</span>
                <span class="w-1 h-1 rounded-full bg-gray-600 mx-2"></span>
                <span class="material-symbols-outlined text-primary">bolt</span>
                <span>Xác nhận ngay lập tức</span>
            </div>
        </div>
        <script>
            function closeSessionAlert() {
                const alert = document.getElementById('session-alert');
                if (!alert) return;

                alert.classList.add('opacity-0', 'scale-95');
                setTimeout(() => alert.remove(), 200);
            }
            setTimeout(() => {
                closeSessionAlert();
            }, 3000);
        </script>


        <form action="{{ url('book_table') }}" method="POST" class="w-full">
            @csrf

            <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left Column: Form -->
                <div class="lg:col-span-8 flex flex-col gap-8">
                    <!-- 1. Thông tin khách hàng -->
                    <div class="bg-surface-dark border border-surface-border rounded-2xl p-6 md:p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-background-dark font-bold">1</span>
                            <h3 class="text-white text-xl font-bold">Thông tin khách hàng</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-white text-sm font-bold mb-3 uppercase tracking-wide text-[#9db8a6]">
                                    Họ và tên <span class="text-red-500 text-xs">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-gray-500">person</span>
                                    </div>
                                    <input name="name" id="customer-name" type="text" required
                                        class="w-full bg-[#161e18] border border-surface-border rounded-xl py-3.5 pl-12 pr-4 text-white focus:border-primary focus:ring-1 focus:ring-primary placeholder-gray-500 transition-colors outline-none invalid:border-red-500 invalid:ring-red-500/50"
                                        placeholder="Nhập họ tên của bạn" />
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-white text-sm font-bold mb-3 uppercase tracking-wide text-[#9db8a6]">
                                    Số điện thoại <span class="text-red-500 text-xs">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-gray-500">phone_iphone</span>
                                    </div>
                                    <input name="phone" id="phone-number" type="tel" required pattern="[0-9]{9,11}"
                                        minlength="9" maxlength="11"
                                        class="w-full bg-[#161e18] border border-surface-border rounded-xl py-3.5 pl-12 pr-4 text-white focus:border-primary focus:ring-1 focus:ring-primary placeholder-gray-500 transition-colors outline-none invalid:border-red-500 invalid:ring-red-500/50"
                                        placeholder="Nhập số điện thoại" title="Số điện thoại từ 9-11 số" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Ngày & Giờ -->
                    <div class="bg-surface-dark border border-surface-border rounded-2xl p-6 md:p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-background-dark font-bold">
                                2
                            </span>
                            <h3 class="text-white text-xl font-bold">Chọn ngày & giờ</h3>
                        </div>

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                            <!-- ===== NGÀY ===== -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider mb-2 text-[#9db8a6]">
                                    Chọn ngày đặt bàn
                                </label>

                                <input id="booking-date" type="date" name="date" required
                                    min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" class="w-full h-14 px-5 rounded-xl bg-[#161e18]
                       border border-surface-border text-white text-sm font-medium
                       focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary
                       transition-all [color-scheme:dark]" />

                                <p class="mt-3 text-xs text-gray-400 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">info</span>
                                    Chỉ có thể đặt bàn từ hôm nay trở đi.
                                </p>
                            </div>

                            <!-- ===== GIỜ ===== -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider mb-2 text-[#9db8a6]">
                                    Thời gian
                                </label>

                                <input id="booking-time" type="time" name="time" required min="08:00" max="22:00" class="w-full h-14 px-5 rounded-xl bg-[#161e18]
           border border-surface-border text-white text-sm font-medium
           focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary
           transition-all [color-scheme:dark]" />


                                <p class="mt-3 text-xs text-gray-400 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">info</span>
                                    Thời gian giữ bàn tối đa 15 phút.
                                </p>
                            </div>

                        </div>
                    </div>



                    <!-- 3. Chi tiết đặt bàn -->
                    <div class="bg-surface-dark border border-surface-border rounded-2xl p-6 md:p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-background-dark font-bold">3</span>
                            <h3 class="text-white text-xl font-bold">Chi tiết đặt bàn</h3>
                        </div>
                        <div class="space-y-8">
                            <!-- Số lượng khách -->
                            <div>
                                <label
                                    class="block text-white text-sm font-bold mb-3 uppercase tracking-wide text-[#9db8a6]">Số
                                    lượng khách</label>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex items-center bg-[#161e18] rounded-xl border border-surface-border p-1">
                                        <button type="button" id="decrease-guests"
                                            class="w-12 h-12 flex items-center justify-center rounded-lg hover:bg-surface-border text-white transition-colors">
                                            <span class="material-symbols-outlined">remove</span>
                                        </button>
                                        <input type="text" id="guest-count-display"
                                            class="w-20 bg-transparent text-center text-white text-xl font-bold border-none focus:ring-0"
                                            value="2" readonly />
                                        <button type="button" id="increase-guests"
                                            class="w-12 h-12 flex items-center justify-center rounded-lg hover:bg-surface-border text-white transition-colors">
                                            <span class="material-symbols-outlined">add</span>
                                        </button>
                                    </div>
                                    <p class="text-gray-400 text-sm">Người lớn</p>
                                </div>
                                <input type="hidden" name="guest" id="guest-count-hidden" value="2" />
                            </div>

                            <!-- Vị trí mong muốn -->
                            <div>
                                <label
                                    class="block text-white text-sm font-bold mb-3 uppercase tracking-wide text-[#9db8a6]">Vị
                                    trí mong muốn</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                    <label class="cursor-pointer group relative">
                                        <input checked class="peer sr-only" name="table" type="radio"
                                            value="Tiêu chuẩn" />
                                        <div
                                            class="p-4 rounded-xl bg-[#161e18] border border-surface-border peer-checked:border-primary peer-checked:bg-primary/5 hover:border-gray-500 transition-all h-full">
                                            <div
                                                class="mb-2 w-10 h-10 rounded-full bg-surface-border peer-checked:bg-primary peer-checked:text-background-dark flex items-center justify-center text-gray-300">
                                                <span class="material-symbols-outlined">deck</span>
                                            </div>
                                            <p class="text-white font-bold text-sm">Tiêu chuẩn</p>
                                            <p class="text-xs text-gray-400 mt-1">Khu vực chung</p>
                                        </div>
                                        <div
                                            class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-primary">
                                            <span class="material-symbols-outlined text-lg">check_circle</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer group relative">
                                        <input class="peer sr-only" name="table" type="radio" value="Gần cửa sổ" />
                                        <div
                                            class="p-4 rounded-xl bg-[#161e18] border border-surface-border peer-checked:border-primary peer-checked:bg-primary/5 hover:border-gray-500 transition-all h-full">
                                            <div
                                                class="mb-2 w-10 h-10 rounded-full bg-surface-border peer-checked:bg-primary peer-checked:text-background-dark flex items-center justify-center text-gray-300">
                                                <span class="material-symbols-outlined">window</span>
                                            </div>
                                            <p class="text-white font-bold text-sm">Gần cửa sổ</p>
                                            <p class="text-xs text-gray-400 mt-1">Ngắm cảnh phố</p>
                                        </div>
                                        <div
                                            class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-primary">
                                            <span class="material-symbols-outlined text-lg">check_circle</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer group relative">
                                        <input class="peer sr-only" name="table" type="radio" value="Riêng tư" />
                                        <div
                                            class="p-4 rounded-xl bg-[#161e18] border border-surface-border peer-checked:border-primary peer-checked:bg-primary/5 hover:border-gray-500 transition-all h-full">
                                            <div
                                                class="mb-2 w-10 h-10 rounded-full bg-surface-border peer-checked:bg-primary peer-checked:text-background-dark flex items-center justify-center text-gray-300">
                                                <span class="material-symbols-outlined">privacy_tip</span>
                                            </div>
                                            <p class="text-white font-bold text-sm">Riêng tư</p>
                                            <p class="text-xs text-gray-400 mt-1">Yên tĩnh, kín đáo</p>
                                        </div>
                                        <div
                                            class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-primary">
                                            <span class="material-symbols-outlined text-lg">check_circle</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer group relative">
                                        <input class="peer sr-only" name="table" type="radio" value="Ngoài trời" />
                                        <div
                                            class="p-4 rounded-xl bg-[#161e18] border border-surface-border peer-checked:border-primary peer-checked:bg-primary/5 hover:border-gray-500 transition-all h-full">
                                            <div
                                                class="mb-2 w-10 h-10 rounded-full bg-surface-border peer-checked:bg-primary peer-checked:text-background-dark flex items-center justify-center text-gray-300">
                                                <span class="material-symbols-outlined">yard</span>
                                            </div>
                                            <p class="text-white font-bold text-sm">Ngoài trời</p>
                                            <p class="text-xs text-gray-400 mt-1">Thoáng mát</p>
                                        </div>
                                        <div
                                            class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-primary">
                                            <span class="material-symbols-outlined text-lg">check_circle</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Ghi chú -->
                            <div>
                                <label
                                    class="block text-white text-sm font-bold mb-3 uppercase tracking-wide text-[#9db8a6]">Ghi
                                    chú khác</label>
                                <textarea name="note"
                                    class="w-full bg-[#161e18] border border-surface-border rounded-xl p-4 text-white focus:border-primary focus:ring-1 focus:ring-primary placeholder-gray-500 resize-none h-24"
                                    placeholder="Ví dụ: Dị ứng đậu phộng, cần ghế trẻ em..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Summary -->
                <div class="lg:col-span-4 flex flex-col gap-6 sticky top-28">
                    <div class="bg-surface-dark border border-surface-border rounded-2xl p-6 shadow-xl">
                        <h3 class="text-white text-lg font-bold border-b border-surface-border pb-4 mb-4">Thông tin đặt
                            bàn</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 p-1.5 rounded-full bg-surface-border text-gray-300">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Họ tên</p>
                                    <p id="summary-name" class="text-white font-medium">--</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 p-1.5 rounded-full bg-surface-border text-gray-300">
                                    <span class="material-symbols-outlined text-sm">phone_iphone</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Số điện thoại</p>
                                    <p id="summary-phone" class="text-white font-medium">--</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 p-1.5 rounded-full bg-surface-border text-gray-300">
                                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Ngày</p>
                                    <p id="summary-date" class="text-white font-medium">--</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 p-1.5 rounded-full bg-surface-border text-gray-300">
                                    <span class="material-symbols-outlined text-sm">schedule</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Thời gian</p>
                                    <p id="summary-time" class="text-white font-medium">--</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 p-1.5 rounded-full bg-surface-border text-gray-300">
                                    <span class="material-symbols-outlined text-sm">group</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Khách</p>
                                    <p id="summary-guests" class="text-white font-medium">--</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 p-1.5 rounded-full bg-surface-border text-gray-300">
                                    <span class="material-symbols-outlined text-sm">table_restaurant</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Loại bàn</p>
                                    <p id="summary-table-type" class="text-white font-medium">--</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 p-1.5 rounded-full bg-surface-border text-gray-300">
                                    <span class="material-symbols-outlined text-sm">edit_note</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="shrink-0 text-xs text-gray-400">Ghi chú</p>
                                    <p id="summary-notes" class="min-w-0 text-white font-medium
               break-words whitespace-pre-wrap leading-relaxed">--</p>
                                </div>
                            </div>
                        </div>

                        <div class="my-6 border-t border-surface-border border-dashed"></div>

                        <button type="submit" id="confirm-button" disabled
                            class="w-full h-12 rounded-xl bg-primary hover:bg-primary-dark text-background-dark text-base font-bold shadow-lg shadow-primary/25 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span>Xác nhận đặt bàn</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>

                        <p class="text-center text-xs text-gray-500 mt-4">
                            Bằng cách xác nhận, bạn đồng ý với <a class="underline hover:text-gray-300" href="#">Điều
                                khoản dịch vụ</a> của chúng tôi.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <footer class="mt-12 py-8 bg-[#0d120e] border-t border-surface-border w-full">
        <div class="px-6 md:px-8 max-w-[1400px] mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm">© 2023 Laravel Restaurant AI. All rights reserved.</p>
            <div class="flex gap-6">
                <a class="text-gray-500 hover:text-white transition-colors text-sm" href="#">Chính sách bảo mật</a>
                <a class="text-gray-500 hover:text-white transition-colors text-sm" href="#">Hỗ trợ</a>
            </div>
        </div>
    </footer>

    <!-- JavaScript đầy đủ -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ===== INPUTS ===== */
            const nameInput = document.getElementById('customer-name');
            const phoneInput = document.getElementById('phone-number');
            const dateInput = document.getElementById('booking-date');
            const timeInput = document.getElementById('booking-time');

            const guestDisplay = document.getElementById('guest-count-display');
            const guestHidden = document.getElementById('guest-count-hidden');
            const increaseBtn = document.getElementById('increase-guests');
            const decreaseBtn = document.getElementById('decrease-guests');
            const confirmButton = document.getElementById('confirm-button');
            const notesTextarea = document.querySelector('textarea[name="note"]');

            /* ===== SUMMARY ===== */
            const summaryName = document.getElementById('summary-name');
            const summaryPhone = document.getElementById('summary-phone');
            const summaryDate = document.getElementById('summary-date');
            const summaryTime = document.getElementById('summary-time');
            const summaryGuests = document.getElementById('summary-guests');
            const summaryTableType = document.getElementById('summary-table-type');
            const summaryNotes = document.getElementById('summary-notes');

            let guests = parseInt(guestHidden.value) || 2;

            /* ===== HELPERS ===== */
            function formatVietnameseDate(dateStr) {
                if (!dateStr) return '--';
                const [y, m, d] = dateStr.split('-');
                return `${d}/${m}/${y}`;
            }

            function isValidPhone(phone) {
                const cleaned = phone.replace(/\D/g, '');
                return cleaned.length >= 9 && cleaned.length <= 11;
            }

            /* ===== UPDATE SUMMARY ===== */
            function updateSummary() {
                summaryName.textContent = nameInput.value.trim() || '--';
                summaryPhone.textContent = phoneInput.value.trim() || '--';
                summaryDate.textContent = formatVietnameseDate(dateInput.value);
                summaryTime.textContent = timeInput.value || '--';
                summaryGuests.textContent = guestHidden.value
                    ? `${guestHidden.value} Người lớn`
                    : '--';

                const selectedTable = document.querySelector('input[name="table"]:checked');
                summaryTableType.textContent = selectedTable ? selectedTable.value : '--';

                const notes = notesTextarea.value.trim();
                summaryNotes.textContent = notes || '--';

                checkFormComplete();
            }

            /* ===== FORM VALIDATION ===== */
            function isValidBookingDateTime(dateStr, timeStr) {
                if (!dateStr || !timeStr) return false;

                const now = new Date();

                const [y, m, d] = dateStr.split('-').map(Number);
                const [hh, mm] = timeStr.split(':').map(Number);

                const bookingDateTime = new Date(y, m - 1, d, hh, mm, 0);

                return bookingDateTime.getTime() > now.getTime();
            }

            function checkFormComplete() {
                const hasName = nameInput.value.trim().length >= 2;
                const hasPhone = isValidPhone(phoneInput.value);
                const hasGuests = parseInt(guestHidden.value || 0) >= 1;

                const isValidDateTime = isValidBookingDateTime(
                    dateInput.value,
                    timeInput.value
                );

                confirmButton.disabled = !(
                    hasName &&
                    hasPhone &&
                    hasGuests &&
                    isValidDateTime
                );
            }

            /* ===== EVENTS ===== */
            nameInput.addEventListener('input', updateSummary);
            phoneInput.addEventListener('input', updateSummary);
            dateInput.addEventListener('change', updateSummary);
            timeInput.addEventListener('change', updateSummary);
            notesTextarea.addEventListener('input', updateSummary);

            document.querySelectorAll('input[name="table"]').forEach(radio => {
                radio.addEventListener('change', updateSummary);
            });

            increaseBtn.addEventListener('click', () => {
                if (guests < 20) guests++;
                guestDisplay.value = guests;
                guestHidden.value = guests;
                updateSummary();
            });

            decreaseBtn.addEventListener('click', () => {
                if (guests > 1) guests--;
                guestDisplay.value = guests;
                guestHidden.value = guests;
                updateSummary();
            });

            /* ===== INIT ===== */
            updateSummary();
        });
    </script>

</body>

</html>
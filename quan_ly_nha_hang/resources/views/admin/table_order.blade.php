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

        <main class="flex-1 flex flex-col h-full overflow-hidden">
            <header
                class="flex-shrink-0 p-6 pb-2 border-b border-border-dark bg-surface-dark/50 backdrop-blur-md z-10 flex flex-col gap-6">
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
                                    A02
                                </h2>
                                <p class="text-gray-400 text-sm font-normal mt-1">Nhân viên phục vụ: Nguyễn Văn A • Bắt
                                    đầu:
                                    10:30 AM</p>
                            </div>
                            <span
                                class="px-4 py-1.5 rounded-full bg-yellow-500/10 text-yellow-500 text-xs font-bold uppercase tracking-wide flex items-center gap-2 border border-yellow-500/20">
                                <span class="size-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                Đang dùng
                            </span>
                        </div>
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
                                placeholder="Tìm món ăn..." type="text" />
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-2">
                    <button
                        class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-surface-dark font-bold text-sm shadow-[0_0_15px_rgba(25,230,94,0.2)] whitespace-nowrap transition-all">
                        Tất cả
                    </button>
                    <button
                        class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        Khai vị
                    </button>
                    <button
                        class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        Món chính
                    </button>
                    <button
                        class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        Tráng miệng
                    </button>
                    <button
                        class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:bg-white/5 font-medium text-sm whitespace-nowrap transition-all">
                        Đồ uống
                    </button>
                </div>
            </header>

            <div class="flex-1 flex overflow-hidden">
                <!-- Bên trái: Danh sách món ăn (grid) -->
                <div class="flex-1 overflow-y-auto p-6 bg-background-dark">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- 6 món gốc của bạn -->
                        <div
                            class="group bg-surface-dark rounded-2xl p-3 hover:shadow-xl hover:shadow-primary/10 transition-all border border-border-dark hover:border-primary cursor-pointer relative overflow-hidden">
                            <div class="relative h-32 mb-3 overflow-hidden rounded-xl">
                                <img alt="Salad"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuB5Q6VX1NpKD1zhwcLD5F4QuHC-jSAWePM0Kl5CPZ4wixSDjq7KVe4zRnKrNyvx0utaRzrENqBWr8EHB9A_HmgInil5wBAX6AwvfKYf8_QTgs0LfHPiTofaryzPkUsgooBsjTDSy3Xi8wUmTlHlXmb2H2Lk09kusB3tbKvOmBUMOsMOwejqk4Lco2_bagDPAjgvSEd08rW4oLTLOP61NWeP3MnRqazGU5kx7bGaMcbyGfxRx-zHD3WK_TFjUuIYYycP3AP1jnGqMaSL" />
                                <div
                                    class="absolute top-2 right-2 bg-black/60 backdrop-blur-md px-2 py-1 rounded-lg text-white text-xs font-bold">
                                    85.000đ</div>
                            </div>
                            <h3 class="font-bold text-white mb-1">Salad Cá Ngừ</h3>
                            <p class="text-xs text-gray-400 line-clamp-2 mb-3">Cá ngừ tươi, xà lách, sốt chanh leo đặc
                                biệt.
                            </p>
                            <button
                                class="w-full py-2 bg-primary/10 text-primary font-medium rounded-lg group-hover:bg-primary group-hover:text-surface-dark transition-colors flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">add</span> Thêm
                            </button>
                        </div>

                        <!-- Copy 5 món còn lại tương tự từ file gốc của bạn (mình rút gọn để code ngắn, bạn paste đầy đủ nhé) -->
                        <!-- ... Sườn Nướng BBQ, Bò Bít Tết, Mì Ý Carbonara, Salad Rau Vườn, Burger Bò Phô Mai ... -->

                    </div>
                </div>

                <!-- Bên phải: DANH SÁCH MÓN (order summary) - KHÔI PHỤC ĐẦY ĐỦ NHƯ BẢN GỐC -->
                <div class="w-1/3 bg-surface-dark flex flex-col shadow-2xl relative z-10 border-l border-border-dark">
                    <div class="p-5 border-b border-border-dark flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-lg text-white">Danh sách món</h3>
                            <p class="text-xs text-gray-400">Order #88392 • 3 items</p>
                        </div>
                        <button
                            class="text-primary hover:text-primary-dark text-sm font-semibold flex items-center gap-1">
                            <span class="material-symbols-outlined text-base">swap_horiz</span> Chuyển bàn
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-4 space-y-3">
                        <div
                            class="flex items-start gap-3 p-3 bg-background-dark rounded-xl border border-border-dark hover:border-primary/30 transition-colors group">
                            <div class="w-14 h-14 rounded-lg bg-gray-700 overflow-hidden flex-shrink-0">
                                <img alt="Ribs" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBt-PUr6s_Dd2LA3hyJSuBuBob-24JgXZdOsP8QdzKKlnCIlTYYOxyoa3Fab5DqPYSggHJwuuUHgq12_SYyEzdsmMU9SIUvZYKVQ5kPz2Io-f6Uc0iHo-lOCgTJyUg85asdx7XFsuBo1DZOEj3Aw8SHlTUI-8LKLau7lRPUHZTzFy48fTKjroYvbblY9T2ZucZNRQ0tdFQgA9taNpuaLGmMvzocTlAXWm4IreptterX-YHJJ8I4-89NTnusIogLjYNYXKffz1As7TCm" />
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="font-semibold text-sm text-white line-clamp-1">Sườn Nướng BBQ</h4>
                                    <span class="font-bold text-sm text-white">500.000đ</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-xs text-gray-400">2 x 250.000đ</p>
                                    <div
                                        class="flex items-center gap-2 bg-background-dark rounded-lg p-1 border border-border-dark">
                                        <button
                                            class="w-5 h-5 flex items-center justify-center rounded bg-surface-dark hover:bg-red-900/50 text-gray-300 hover:text-red-400 transition-colors">
                                            <span class="material-symbols-outlined text-xs">remove</span>
                                        </button>
                                        <span class="text-xs font-bold w-4 text-center text-white">2</span>
                                        <button
                                            class="w-5 h-5 flex items-center justify-center rounded bg-surface-dark hover:bg-primary/20 text-gray-300 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-xs">add</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2 text-xs text-emerald-500 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[10px]">check_circle</span> Đã hoàn
                                    thành
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-3 p-3 bg-background-dark rounded-xl border border-border-dark hover:border-primary/30 transition-colors">
                            <div class="w-14 h-14 rounded-lg bg-gray-700 overflow-hidden flex-shrink-0">
                                <img alt="Salad" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuC8pIDVA2uF2pM8ddCGCJ0X9WUzI_lqng-H1Z9r-dfx1dHwgH5Syx2zA8EHH43pNHA1OKmvV_uSH-6EfgBkjl6fppDAehoECs8ZXoXJ8VrFSvDkDQxOio1m2fcYslT0y6cxWTuDcACWs9JHLohsCqd1KlYU6VUEJZddlMp_iLn0m9Egbgt8JULFh918xhk1A5lGhN5pM5KfdYMrT4nIQmcvxln9Tp44mkmy4EUaxzg9HclTq2U0GRCv1Xgxxo1dtYqVcJ1mndTUKuLC" />
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="font-semibold text-sm text-white line-clamp-1">Salad Cá Ngừ</h4>
                                    <span class="font-bold text-sm text-white">85.000đ</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-xs text-gray-400">1 x 85.000đ</p>
                                    <div
                                        class="flex items-center gap-2 bg-background-dark rounded-lg p-1 border border-border-dark">
                                        <button
                                            class="w-5 h-5 flex items-center justify-center rounded bg-surface-dark hover:bg-red-900/50 text-gray-300 hover:text-red-400 transition-colors">
                                            <span class="material-symbols-outlined text-xs">remove</span>
                                        </button>
                                        <span class="text-xs font-bold w-4 text-center text-white">1</span>
                                        <button
                                            class="w-5 h-5 flex items-center justify-center rounded bg-surface-dark hover:bg-primary/20 text-gray-300 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-xs">add</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2 text-xs text-emerald-500 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[10px]">check_circle</span> Đã hoàn
                                    thành
                                </div>
                            </div>
                        </div>

                        <div class="p-3 bg-primary/5 rounded-xl border border-primary/20 transition-colors">
                            <div class="flex items-start gap-3">
                                <div class="w-14 h-14 rounded-lg bg-gray-700 overflow-hidden flex-shrink-0 relative">
                                    <img alt="Pasta" class="w-full h-full object-cover opacity-80"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDGpVcLNiUGs_gItkPMy1J_koRNElFtRIqAgEDbUH0-kUF2ST5vVMbSWdwAoDpVF9yt6gml7HPbeQBU_KAC4X-e5sF1gBfp25SeiJR6hDm252EjOhLeqyOt_gs_W7-j_pSPfb-estzJp_w0TgHCvJxPmjO6KZum_M5n87bXWk-2g0D7jLP0sJYaUyFeCWY34tUwBCFdcCxgLW0FJfTZVzSCeRR3t9n3619LhwM9VkLFGlL-ziHCXYHvMpboy2zwjybsVqwNC_2LGW5m" />
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                                        <span class="text-xs font-bold text-white bg-primary px-1 rounded">MỚI</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-semibold text-sm text-white line-clamp-1">Mì Ý Carbonara</h4>
                                        <span class="font-bold text-sm text-white">120.000đ</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-xs text-gray-400 italic">Chưa gửi bếp</p>
                                        <div
                                            class="flex items-center gap-2 bg-background-dark rounded-lg p-1 border border-border-dark">
                                            <button
                                                class="w-5 h-5 flex items-center justify-center rounded bg-surface-dark hover:bg-red-900/50 text-gray-300 hover:text-red-400 transition-colors">
                                                <span class="material-symbols-outlined text-xs">remove</span>
                                            </button>
                                            <span class="text-xs font-bold w-4 text-center text-white">1</span>
                                            <button
                                                class="w-5 h-5 flex items-center justify-center rounded bg-surface-dark hover:bg-primary/20 text-gray-300 hover:text-primary transition-colors">
                                                <span class="material-symbols-outlined text-xs">add</span>
                                            </button>
                                        </div>
                                    </div>
                                    <input
                                        class="mt-2 w-full bg-surface-dark border border-border-dark rounded text-xs px-2 py-1 focus:border-primary focus:ring-0 outline-none text-white placeholder-gray-500"
                                        placeholder="Ghi chú (ít cay...)" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-surface-dark border-t border-border-dark p-5">
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm text-gray-400">
                                <span>Tạm tính (4 món)</span>
                                <span>705.000đ</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-400">
                                <span>VAT (8%)</span>
                                <span>56.400đ</span>
                            </div>
                            <div class="border-t border-dashed border-border-dark my-2"></div>
                            <div class="flex justify-between items-end">
                                <span class="font-bold text-white">Tổng cộng</span>
                                <span class="font-bold text-xl text-primary">761.400đ</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mb-3">
                            <button
                                class="flex items-center justify-center gap-2 py-3 rounded-xl border border-primary text-primary hover:bg-primary/10 transition-colors font-medium text-sm">
                                <span class="material-symbols-outlined text-sm">add_circle_outline</span>
                                Thêm món
                            </button>
                            <button
                                class="flex items-center justify-center gap-2 py-3 rounded-xl bg-surface-dark border border-border-dark text-white hover:bg-white/5 transition-colors font-medium text-sm">
                                <span class="material-symbols-outlined text-sm">soup_kitchen</span>
                                Gửi bếp (1)
                            </button>
                        </div>
                        <button
                            class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-primary hover:bg-primary-dark text-surface-dark font-bold text-lg shadow-[0_0_20px_rgba(25,230,94,0.3)] transition-all active:scale-95">
                            <span class="material-symbols-outlined">payments</span>
                            Thanh Toán
                        </button>
                    </div>
                </div>
            </div>
        </main>

</body>

</html>
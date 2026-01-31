<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Restaurant AI - Tổng quan</title>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&amp;display=swap"
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
                        "background-light": "#f6f8f6",
                        "background-dark": "#112116",
                        "card-dark": "#1A2C22",
                        "card-light": "#ffffff",
                        "surface-dark": "#18281e",
                        "border-dark": "#2a3d31",
                    },
                    fontFamily: {
                        "display": ["Work Sans", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" },
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
            background: #112116;
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
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 border border-primary/20"
                        href="#">
                        <span class="material-symbols-outlined text-primary fill-1">dashboard</span>
                        <p class="text-primary text-sm font-bold">Tổng quan</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('tables') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">table_restaurant</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Bàn phục vụ</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('add_food') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">restaurant</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Quản lý thực đơn</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('bookings') }}">
                        <span
                            class="material-symbols-outlined text-gray-400 group-hover:text-white">receipt_long</span>
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
                class="md:hidden h-16 flex items-center justify-between px-4 bg-white dark:bg-card-dark border-b border-slate-200 dark:border-[#29382e] shrink-0">
                <div class="flex items-center gap-3">
                    <button class="text-slate-500 dark:text-white">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h1 class="font-bold text-lg text-slate-900 dark:text-white">RestAI</h1>
                </div>
                <div class="size-8 rounded-full bg-cover bg-center"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAar_PlcrcjDc87aZBjvhDDFe82DFnoQM_GrdlxUR__iYfQkwG7NsDeUvyJT2A5lME_5k4rwcsPalW30QQ2xDzcAZUhyRk4PH8wNZIH6QsCVpEWbuoXdziEAen7UYgJFPk81PSjKBv0pMr7Xt6Ppe64nIm4Uahek231O-kWRyNbi6XJxJeKb0tqmk7TyTPYqpqiQ2y4jyoE-LtmtBOfcWDQhBykEO-awODkL3OcH1JY7SEuXnXTC4IKILRLs8N7lFflA09JzEJNI2k");'>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto p-4 md:p-8">
                <div class="max-w-7xl mx-auto space-y-6">
                    <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-6">
                        <div>
                            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Tổng quan</h1>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <button
                                class="mr-2 flex size-10 items-center justify-center rounded-xl bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] text-slate-500 dark:text-white hover:text-primary hover:border-primary transition-colors relative">
                                <span class="material-symbols-outlined text-[20px]">notifications</span>
                                <span class="absolute top-2 right-2 size-2 bg-red-500 rounded-full"></span>
                            </button>
                            <div
                                class="flex bg-white dark:bg-card-dark p-1 rounded-xl border border-slate-200 dark:border-[#29382e]">
                                <button
                                    class="px-4 py-1.5 rounded-lg bg-primary text-background-dark font-bold text-sm shadow-sm">Ngày</button>
                                <button
                                    class="px-4 py-1.5 rounded-lg text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-sm font-medium transition-colors">Tháng</button>
                                <button
                                    class="px-4 py-1.5 rounded-lg text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-sm font-medium transition-colors">Năm</button>
                            </div>
                            <button
                                class="flex h-10 items-center justify-center gap-x-2 rounded-xl bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] hover:border-slate-300 dark:hover:border-slate-500 px-4 transition-all">
                                <span
                                    class="material-symbols-outlined text-[20px] text-slate-500 dark:text-[#9db8a6]">calendar_month</span>
                                <span class="text-slate-900 dark:text-white text-sm font-bold">Tháng 10, 2023</span>
                                <span
                                    class="material-symbols-outlined text-[20px] text-slate-500 dark:text-[#9db8a6]">arrow_drop_down</span>
                            </button>
                            <button
                                class="flex h-10 items-center justify-center gap-x-2 rounded-xl bg-primary text-background-dark px-4 font-bold text-sm shadow-lg shadow-primary/20 hover:brightness-110 transition-all">
                                <span class="material-symbols-outlined text-[20px]">download</span>
                                <span class="whitespace-nowrap">Xuất báo cáo</span>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div
                            class="flex flex-col justify-between gap-4 rounded-xl p-6 bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-1">
                                    <p
                                        class="text-slate-500 dark:text-[#9db8a6] text-sm font-medium uppercase tracking-wider">
                                        Tổng doanh thu</p>
                                    <p class="text-slate-900 dark:text-white text-2xl font-bold">125.000.000đ</p>
                                </div>
                                <div class="p-2 rounded-lg bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined">payments</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="flex items-center text-primary bg-primary/10 px-2 py-0.5 rounded text-xs font-bold">
                                    <span class="material-symbols-outlined text-[14px] mr-1">trending_up</span>
                                    +12%
                                </span>
                                <span class="text-slate-400 dark:text-slate-500 text-xs">so với tháng trước</span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-between gap-4 rounded-xl p-6 bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-1">
                                    <p
                                        class="text-slate-500 dark:text-[#9db8a6] text-sm font-medium uppercase tracking-wider">
                                        Tổng đơn hàng</p>
                                    <p class="text-slate-900 dark:text-white text-2xl font-bold">1,250</p>
                                </div>
                                <div class="p-2 rounded-lg bg-blue-500/10 text-blue-500">
                                    <span class="material-symbols-outlined">receipt_long</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="flex items-center text-primary bg-primary/10 px-2 py-0.5 rounded text-xs font-bold">
                                    <span class="material-symbols-outlined text-[14px] mr-1">trending_up</span>
                                    +5%
                                </span>
                                <span class="text-slate-400 dark:text-slate-500 text-xs">so với tháng trước</span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-between gap-4 rounded-xl p-6 bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-1">
                                    <p
                                        class="text-slate-500 dark:text-[#9db8a6] text-sm font-medium uppercase tracking-wider">
                                        Lợi nhuận gộp</p>
                                    <p class="text-slate-900 dark:text-white text-2xl font-bold">45.000.000đ</p>
                                </div>
                                <div class="p-2 rounded-lg bg-purple-500/10 text-purple-500">
                                    <span class="material-symbols-outlined">account_balance_wallet</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="flex items-center text-primary bg-primary/10 px-2 py-0.5 rounded text-xs font-bold">
                                    <span class="material-symbols-outlined text-[14px] mr-1">trending_up</span>
                                    +8%
                                </span>
                                <span class="text-slate-400 dark:text-slate-500 text-xs">so với tháng trước</span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-between gap-4 rounded-xl p-6 bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-1">
                                    <p
                                        class="text-slate-500 dark:text-[#9db8a6] text-sm font-medium uppercase tracking-wider">
                                        Giá trị TB đơn</p>
                                    <p class="text-slate-900 dark:text-white text-2xl font-bold">100.000đ</p>
                                </div>
                                <div class="p-2 rounded-lg bg-orange-500/10 text-orange-500">
                                    <span class="material-symbols-outlined">monitoring</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="flex items-center text-[#fa5538] bg-[#fa5538]/10 px-2 py-0.5 rounded text-xs font-bold">
                                    <span class="material-symbols-outlined text-[14px] mr-1">trending_down</span>
                                    -2%
                                </span>
                                <span class="text-slate-400 dark:text-slate-500 text-xs">so với tháng trước</span>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="flex flex-col rounded-xl bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] p-6 shadow-sm">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h3 class="text-slate-900 dark:text-white text-lg font-bold">Biểu đồ doanh thu</h3>
                                    <p class="text-slate-500 dark:text-[#9db8a6] text-sm">Doanh thu bán hàng theo thời
                                        gian
                                        thực</p>
                                </div>
                                <div class="flex gap-2">
                                    <span
                                        class="px-3 py-1 rounded bg-slate-100 dark:bg-[#29382e] text-xs font-bold text-slate-500 dark:text-[#9db8a6]">Doanh
                                        thu</span>
                                    <span
                                        class="px-3 py-1 rounded bg-transparent text-xs font-medium text-slate-400 dark:text-[#9db8a6]/50">Lợi
                                        nhuận</span>
                                </div>
                            </div>
                            <div class="relative w-full h-[350px] flex flex-col justify-end">
                                <div
                                    class="absolute inset-0 flex flex-col justify-between text-xs text-slate-400 dark:text-[#9db8a6]/50 pointer-events-none pb-8">
                                    <span>150tr</span>
                                    <span>100tr</span>
                                    <span>50tr</span>
                                    <span>0đ</span>
                                </div>
                                <svg class="w-full h-full pt-2 pb-8 pl-8 overflow-visible" preserveAspectRatio="none"
                                    viewBox="0 0 1000 300">
                                    <defs>
                                        <linearGradient id="gradient-primary" x1="0" x2="0" y1="0" y2="1">
                                            <stop offset="0%" stop-color="#19e65e" stop-opacity="0.2"></stop>
                                            <stop offset="100%" stop-color="#19e65e" stop-opacity="0"></stop>
                                        </linearGradient>
                                    </defs>
                                    <path
                                        d="M0,250 C100,240 200,180 300,150 C400,120 500,180 600,140 C700,100 800,40 900,60 C950,70 1000,20 1000,20 V300 H0 Z"
                                        fill="url(#gradient-primary)"></path>
                                    <path
                                        d="M0,250 C100,240 200,180 300,150 C400,120 500,180 600,140 C700,100 800,40 900,60 C950,70 1000,20 1000,20"
                                        fill="none" stroke="#19e65e" stroke-linecap="round" stroke-width="3"></path>
                                    <circle cx="300" cy="150" fill="#112116" r="4" stroke="#19e65e" stroke-width="2">
                                    </circle>
                                    <circle cx="600" cy="140" fill="#112116" r="4" stroke="#19e65e" stroke-width="2">
                                    </circle>
                                    <circle cx="900" cy="60" fill="#19e65e" r="6"></circle>
                                    <foreignObject height="50" width="120" x="840" y="0">
                                        <div class="bg-slate-800 text-white text-xs p-2 rounded shadow-lg text-center">
                                            <div class="font-bold">28/10</div>
                                            <div class="text-primary">125.0tr</div>
                                        </div>
                                    </foreignObject>
                                </svg>
                                <div
                                    class="flex justify-between pl-8 text-xs font-medium text-slate-400 dark:text-[#9db8a6]">
                                    <span>01/10</span>
                                    <span>05/10</span>
                                    <span>10/10</span>
                                    <span>15/10</span>
                                    <span>20/10</span>
                                    <span>25/10</span>
                                    <span>30/10</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-full rounded-xl bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm overflow-hidden mb-10">
                        <div
                            class="px-6 py-4 border-b border-slate-200 dark:border-[#29382e] flex justify-between items-center">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Món ăn bán chạy nhất</h3>
                            <a class="text-sm font-medium text-primary hover:underline" href="#">Xem tất cả</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-slate-50 dark:bg-[#1f3328] text-slate-500 dark:text-[#9db8a6]">
                                    <tr>
                                        <th class="px-6 py-3 font-medium">Món ăn</th>
                                        <th class="px-6 py-3 font-medium">Danh mục</th>
                                        <th class="px-6 py-3 font-medium text-right">Đã bán</th>
                                        <th class="px-6 py-3 font-medium text-right">Doanh thu</th>
                                        <th class="px-6 py-3 font-medium text-right">Xu hướng</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-[#29382e]">
                                    <tr class="hover:bg-slate-50 dark:hover:bg-[#29382e]/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-lg bg-cover bg-center"
                                                    data-alt="Beef steak dish presentation"
                                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDhlRMHbMr58AWawhcwtedYvLaBN5-LcYO7zDpTxrp0PUs0JnnhyCzdiFDlZ_fqgdpsTyc_ibA8rEMFf8ge9vH106E6M15JDR5xUDDeqzJtw00zmvCIY9GwvEsZ8TirbssVYE5N5BDBxUN_NL2c-MzLj-IESPpqRu-0ujzuJG0FaAEw_FSpF3fN_hQgb_9QqfR2hR-ny3vVKC9sJbEFHtw16oOL6LPNJCuoJ4v3LRbWDkD6daIjxK7jJJ1OTjQBNQ158eS5V2d4qgI');">
                                                </div>
                                                <span class="font-bold text-slate-900 dark:text-white">Bò bít tết sốt
                                                    tiêu
                                                    đen</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 dark:text-slate-300">Món chính</td>
                                        <td class="px-6 py-4 text-right font-medium text-slate-900 dark:text-white">342
                                        </td>
                                        <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white">
                                            85.500.000đ</td>
                                        <td class="px-6 py-4 text-right">
                                            <div
                                                class="flex items-center justify-end gap-1 text-primary text-xs font-bold">
                                                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                                                12%
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-[#29382e]/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-lg bg-cover bg-center"
                                                    data-alt="Salmon dish presentation"
                                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCHFlpre30HPjHdXOezULQFIObBnDaTk4gDqh62MeOhgf-vqMhrufDdWSoRTYoaomobUUUsl65VUQmbdPWVajIZ9adyxfdqGHVARf98dzQcYN3Sn0gPEwu_vUz6LEoKSjgTodQz4EXFOKQRhdyv-GXspSaaYH9RrtyH08ZHt-W1BxkSlw8x0HMhWrR83RjqR86oTA7wtesdHIl7UxlO5rMwTq3EjVTfDvYPXFQuQog5ByG1bWh1vajBxLHkV28BXhLd9uhavzHTPeM');">
                                                </div>
                                                <span class="font-bold text-slate-900 dark:text-white">Cá hồi áp
                                                    chảo</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 dark:text-slate-300">Hải sản</td>
                                        <td class="px-6 py-4 text-right font-medium text-slate-900 dark:text-white">215
                                        </td>
                                        <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white">
                                            53.750.000đ</td>
                                        <td class="px-6 py-4 text-right">
                                            <div
                                                class="flex items-center justify-end gap-1 text-primary text-xs font-bold">
                                                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                                                8%
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-[#29382e]/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-lg bg-cover bg-center"
                                                    data-alt="Caesar salad presentation"
                                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDd-C4N9H8BF_voDq5p2HFxGnlBvoKtqn7mieab1Cl4NMgPE8TPm2YGuVL8kfVe1wDH1SwsDTpJ4XNC3Ji__spe18zxJBwzvCpcWUtCpsxIsv2nCIYC9hFhFmm6yP0MGIKqLn0qYmbbCmAm7ajbJxX5Qb1OhJrP6I7N9yRkyzPlYqs21pN3yWpZKJFj5whY4MDUVYoKjSTaoKliD_IV0Qu1JwHYqv71gyVdf8WFp2gvNdbn3BdgSFaKLhTLSsPNtcMbLyIzJ23buFk');">
                                                </div>
                                                <span class="font-bold text-slate-900 dark:text-white">Salad
                                                    Caesar</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 dark:text-slate-300">Khai vị</td>
                                        <td class="px-6 py-4 text-right font-medium text-slate-900 dark:text-white">189
                                        </td>
                                        <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white">
                                            22.680.000đ</td>
                                        <td class="px-6 py-4 text-right">
                                            <div
                                                class="flex items-center justify-end gap-1 text-[#fa5538] text-xs font-bold">
                                                <span class="material-symbols-outlined text-[16px]">trending_down</span>
                                                2%
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-[#29382e]/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-lg bg-cover bg-center"
                                                    data-alt="Red wine glass"
                                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBMcrl8NozP3FLIiRUSmwLuSZpo9dqxjGjEsHfknWY7tE2ulKDnLV7afFwAceg-aZz5XT99LTCTKw_2cac0hOB32USLMTWGaR-eWm1M8ffpPps4Yss-JYTB1wRcx1jaId83zgiuDMt4Rrf2WhTLmGOReEytvRzw84IeUp8XqjJSCUXswDhDiVmvcBF6YWtIf2UaxLKDWnkl1NAwmBtkBpja289XQq8b1uu63I9d15EC3lUFaN5CVgNRPRuwRcnAvW7hKpyHbmTe_Ow');">
                                                </div>
                                                <span class="font-bold text-slate-900 dark:text-white">Rượu vang đỏ
                                                    House</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 dark:text-slate-300">Đồ uống</td>
                                        <td class="px-6 py-4 text-right font-medium text-slate-900 dark:text-white">150
                                        </td>
                                        <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white">
                                            18.000.000đ</td>
                                        <td class="px-6 py-4 text-right">
                                            <div
                                                class="flex items-center justify-end gap-1 text-primary text-xs font-bold">
                                                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                                                5%
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
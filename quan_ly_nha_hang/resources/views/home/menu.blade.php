<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Thực đơn nhà hàng</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700;900&amp;display=swap"
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
                        "surface-dark": "#1c261f",
                        "surface-light": "#ffffff",
                        "text-muted": "#9db8a6",
                    },
                    fontFamily: {
                        "display": ["Work Sans", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-x-hidden antialiased selection:bg-primary selection:text-black">
    <div class="flex flex-col min-h-screen">
        <header
            class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e0e0e0] dark:border-b-[#29382e] bg-white/95 dark:bg-[#111813]/95 backdrop-blur-md px-10 py-3">
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-4 text-[#111813] dark:text-white cursor-pointer">
                    <div class="size-8 text-primary">
                        <span class="material-symbols-outlined !text-[32px]">restaurant_menu</span>
                    </div>
                    <h2 class="text-[#111813] dark:text-white text-xl font-black leading-tight tracking-[-0.015em]">
                        DeliciousAI</h2>
                </div>
                <nav class="hidden lg:flex items-center gap-9">
                    <a class="text-[#111813] dark:text-[#9db8a6] text-sm font-bold leading-normal hover:text-primary transition-colors"
                        href="{{ url('home') }}">Trang chủ</a>
                    <a class="text-[#637588] dark:text-white text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="#">Thực đơn</a>
                    <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="{{ url('booking-table') }}">Đặt bàn</a>
                    <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="{{ url('intro') }}">Giới thiệu</a>
                </nav>
            </div>
            <div class="flex flex-1 justify-end gap-6 items-center">
                <div class="flex gap-3">
                    <button
                        class="flex items-center justify-center overflow-hidden rounded-xl h-10 w-10 bg-[#f0f2f4] dark:bg-[#29382e] hover:bg-primary/20 hover:text-primary transition-colors text-[#111813] dark:text-white">
                        <span class="material-symbols-outlined">shopping_bag</span>
                    </button>
                    <button
                        class="flex items-center justify-center overflow-hidden rounded-xl h-10 w-10 bg-[#f0f2f4] dark:bg-[#29382e] hover:bg-primary/20 hover:text-primary transition-colors text-[#111813] dark:text-white">
                        <span class="material-symbols-outlined">account_circle</span>
                    </button>
                </div>
            </div>
        </header>
        <main class="flex-1 w-full max-w-[1600px] mx-auto p-4 lg:p-6 flex flex-col gap-8">
            <div class="w-full flex flex-col gap-8">
                <div class="flex flex-col gap-6">
                    <div class="flex flex-wrap justify-between items-end gap-4">
                        <div class="flex flex-col gap-2">
                            <h1 class="text-white text-3xl lg:text-4xl font-black leading-tight tracking-[-0.033em]">
                                Thực đơn nhà hàng</h1>
                            <div class="flex items-center gap-2 text-text-muted">
                                <span class="material-symbols-outlined text-primary text-sm">restaurant_menu</span>
                                <p class="text-base font-normal">Danh sách món ăn &amp; Đồ uống</p>
                            </div>
                        </div>
                        <div class="w-full sm:max-w-xs">
                            <label
                                class="flex w-full items-center rounded-xl bg-surface-dark border border-[#29382e] focus-within:border-primary/50 transition-colors h-12 px-4 gap-3">
                                <span class="material-symbols-outlined text-text-muted">search</span>
                                <input
                                    class="w-full bg-transparent border-none text-white placeholder:text-text-muted focus:ring-0 p-0 text-base"
                                    placeholder="Tìm món ăn..." />
                            </label>
                        </div>
                    </div>
                </div>
                <!-- <section class="flex flex-col gap-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary filled">auto_awesome</span>
                        <h3 class="text-white text-lg font-bold">Gợi ý từ AI Chef</h3>
                    </div>
                    <div
                        class="flex overflow-x-auto pb-4 gap-4 snap-x [-ms-scrollbar-style:none] [scrollbar-width:none] [&amp;::-webkit-scrollbar]:hidden">
                        <div
                            class="snap-start min-w-[280px] md:min-w-[320px] bg-surface-dark rounded-xl p-3 border border-[#29382e] hover:border-primary/30 transition-all group flex flex-col gap-3">
                            <div class="relative w-full aspect-video rounded-lg overflow-hidden">
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                    data-alt="Plate of premium Wagyu beef steak perfectly seared"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBDKVGfhjAU-vDOsfHqiU_DDjeSukE3D_o17Unr676QBj4ZX5HqAqaqfWg5KUfOSrNBF6bWDsbyBYCFHFm-YPfPHeRd9cgnOcu9QT_xataeG3JUuPvyI-SSzfn21HpZmlTOSWpITZl0No-BGB3MSjvMppomOIMjU_DDXj8GL3l0dCJDXTHnpoB_wI5C3WPxc2tDa6cSqjkaYkGKnLTbJjbQRAcjVFapBpiLZDYZSgu9cnwRLW3sbPBV4eQZZhXi6DNpDZHaK-Oyvg8");'>
                                </div>
                                <div
                                    class="absolute top-2 left-2 bg-primary/90 text-black text-xs font-bold px-2 py-1 rounded">
                                    Top Choice</div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <h4 class="text-white font-bold text-lg">Combo Bò Wagyu</h4>
                                <p class="text-text-muted text-sm line-clamp-2">Thịt bò A5 mềm tan, kèm khoai tây nghiền
                                    và sốt nấm truffle.</p>
                            </div>
                            <div class="flex items-center justify-between mt-auto pt-2">
                                <span class="text-primary font-bold text-lg">1.250.000₫</span>
                            </div>
                        </div>
                        <div
                            class="snap-start min-w-[280px] md:min-w-[320px] bg-surface-dark rounded-xl p-3 border border-[#29382e] hover:border-primary/30 transition-all group flex flex-col gap-3">
                            <div class="relative w-full aspect-video rounded-lg overflow-hidden">
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                    data-alt="Fresh assorted sashimi platter on ice"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAyc-RuWYbUefokogaCUzSCmm9vXTdaZRLYYkUc9XnekUnwXCOLHA3j1GTvrYSgpO3_Cl6Lx_t8Bh9KesoVWvFIsr2rYDKbRLaDcocMFcjhKJKDIvmmG8un3d13NOLEp53gckF6mmWsuRcZpEwlYqHL17j5lrZUxtG2tNfL4Q2U9l_z2G7xHLKQJqDewUqI5pLdd56QC678-WqP6uoTvazCWo_zAk_B4J62bV_cwFbUaH0NyaF0vAX8gekWUjwoS0P_QPKClE48NLY");'>
                                </div>
                                <div
                                    class="absolute top-2 left-2 bg-purple-500/90 text-white text-xs font-bold px-2 py-1 rounded">
                                    Best Seller</div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <h4 class="text-white font-bold text-lg">Sashimi Tổng Hợp</h4>
                                <p class="text-text-muted text-sm line-clamp-2">Cá hồi, cá ngừ, bạch tuộc tươi sống nhập
                                    khẩu trong ngày.</p>
                            </div>
                            <div class="flex items-center justify-between mt-auto pt-2">
                                <span class="text-primary font-bold text-lg">890.000₫</span>
                            </div>
                        </div>
                        <div
                            class="snap-start min-w-[280px] md:min-w-[320px] bg-surface-dark rounded-xl p-3 border border-[#29382e] hover:border-primary/30 transition-all group flex flex-col gap-3">
                            <div class="relative w-full aspect-video rounded-lg overflow-hidden">
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                    data-alt="Glass of red wine next to a steak dish"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBBmoye2d3bnovQNx5Qcc4SWJJmUMGVx-KrjlROLsqa0E2C_0fWvQsbZ5XIaK9utK445dAFQdJ6atp4HywUecHXtTyYNRgibciXLpG3nKlATRILBeNgrVf6JYyL7GQybQQPU2EAd5dQiqtuCqn-KeggqJ-TXjvCreKLf6FQWo7iZoiVcmhl7J_sWAYZT1z5slzd9u9dniEVBr2R1bDJp0fadZW9I6-8xFoUpwJOdvj0CMUZqhiXIkp_jFW1t8z5TRzj4QgD3VNwZHw");'>
                                </div>
                                <div
                                    class="absolute top-2 left-2 bg-blue-500/90 text-white text-xs font-bold px-2 py-1 rounded">
                                    Perfect Match</div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <h4 class="text-white font-bold text-lg">Rượu Vang Cabernet</h4>
                                <p class="text-text-muted text-sm line-clamp-2">Gợi ý dùng kèm món bò. Hương vị đậm đà,
                                    chát nhẹ.</p>
                            </div>
                            <div class="flex items-center justify-between mt-auto pt-2">
                                <span class="text-primary font-bold text-lg">1.500.000₫</span>
                            </div>
                        </div>
                    </div>
                </section> -->
                <div
                    class="flex gap-3 overflow-x-auto pb-2 [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    <button data-filter="all"
                        class="category-btn shrink-0 h-10 px-5 rounded-full bg-primary text-black font-semibold text-sm transition-transform active:scale-95">
                        Tất cả
                    </button>
                    <button data-filter="khai-vi"
                        class="category-btn shrink-0 h-10 px-5 rounded-full bg-surface-dark text-white border border-[#29382e] hover:border-primary/50 font-medium text-sm transition-all active:scale-95">
                        Khai vị
                    </button>
                    <button data-filter="mon-chinh"
                        class="category-btn shrink-0 h-10 px-5 rounded-full bg-surface-dark text-white border border-[#29382e] hover:border-primary/50 font-medium text-sm transition-all active:scale-95">
                        Món chính
                    </button>
                    <button data-filter="trang-mieng"
                        class="category-btn shrink-0 h-10 px-5 rounded-full bg-surface-dark text-white border border-[#29382e] hover:border-primary/50 font-medium text-sm transition-all active:scale-95">
                        Tráng miệng
                    </button>
                    <button data-filter="do-uong"
                        class="category-btn shrink-0 h-10 px-5 rounded-full bg-surface-dark text-white border border-[#29382e] hover:border-primary/50 font-medium text-sm transition-all active:scale-95">
                        Đồ uống
                    </button>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($data as $data)
                        <div class="group bg-surface-dark rounded-xl overflow-hidden border border-[#29382e] hover:shadow-lg hover:shadow-primary/5 hover:border-primary/30 transition-all"
                            data-type="{{ $data->type ?? '' }}">
                            <div class="h-48 overflow-hidden relative">
                                <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                    data-alt="Crispy spring rolls Vietnamese style" style=''>
                                    <img src="{{ $data->image ? asset('food_img/' . $data->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                                        alt="{{ $data->title ?? 'Món ăn' }}"
                                        class="w-full h-full object-cover object-center" />
                                </div>
                            </div>
                            <div class="p-4 flex flex-col gap-3">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-white font-bold text-lg leading-snug">{{ $data->title }}</h4>
                                </div>
                                <p class="text-text-muted text-sm line-clamp-2 h-10">{{ $data->detail }}</p>
                                <div class="mt-2">
                                    <span class="text-white font-bold text-xl">{{ $data->price }}₫</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Định dạng giá tiền với dấu chấm (1.250.000₫)
            document.querySelectorAll('span').forEach(span => {
                if (span.textContent.trim().endsWith('₫')) {
                    const text = span.textContent.trim();
                    const number = parseInt(text.replace(/[^0-9]/g, ''));
                    if (!isNaN(number)) {
                        span.textContent = number.toLocaleString('vi-VN') + '₫';
                    }
                }
            });

            // Lọc danh mục
            const categoryButtons = document.querySelectorAll('.category-btn');
            const foodCards = document.querySelectorAll('.grid > div[data-type]');

            categoryButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const filter = this.getAttribute('data-filter');

                    // Cập nhật active cho button
                    categoryButtons.forEach(b => {
                        b.classList.remove('bg-primary', 'text-black');
                        b.classList.add('bg-surface-dark', 'text-white', 'border', 'border-[#29382e]');
                    });
                    this.classList.add('bg-primary', 'text-black');
                    this.classList.remove('bg-surface-dark', 'text-white', 'border', 'border-[#29382e]');

                    // Lọc card
                    foodCards.forEach(card => {
                        const type = card.getAttribute('data-type') || '';
                        if (filter === 'all' || type === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            // Mặc định: "Tất cả" active
            const allBtn = document.querySelector('.category-btn[data-filter="all"]');
            if (allBtn) allBtn.click();
        });
    </script>
</body>

</html>
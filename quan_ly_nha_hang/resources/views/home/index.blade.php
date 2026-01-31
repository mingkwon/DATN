<!DOCTYPE html>

<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>DeliciousAI - Trang chủ khách hàng</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#19e65e",
                        "background-light": "#f6f8f6",
                        "background-dark": "#112116",
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
    class="bg-background-light dark:bg-background-dark text-[#111813] dark:text-white font-display overflow-x-hidden antialiased">
    <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
        <!-- Header -->
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
                    <a class="text-[#111813] dark:text-white text-sm font-bold leading-normal hover:text-primary transition-colors"
                        href="#">Trang chủ</a>
                    <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="{{ url('menu') }}">Thực đơn</a>
                    <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="{{ url('booking-table') }}">Đặt bàn</a>
                    <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="#">Ưu đãi</a>
                    <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="#">Giới thiệu</a>
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
        <main class="flex-1 flex flex-col">
            <!-- Hero Section -->
            <section class="@container w-full">
                <div class="flex min-h-[560px] flex-col gap-6 bg-cover bg-center bg-no-repeat items-center justify-center p-8 relative overflow-hidden"
                    data-alt="Dark moody restaurant interior with focus on a beautifully plated steak dish"
                    style='background-image: linear-gradient(rgba(17, 33, 22, 0.7) 0%, rgba(17, 33, 22, 0.8) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuC8Om1bcg9th7CQp4W99KhTygbAoMZ3CqN4o_IolsHUFxeipXBpX5VZgc2bWRCJkfM0r8P51UXcIzR8OK0s96oIQIIaBpB-Wu-Ydg_uTfGcumFHGRlBjy57BNIA2Twro8rQ_LNx0Siw5Jp8GqAUSqbCCgLHYMqpPIzUKQdCI83FUlDn_xsabdHmygsVQVuGok6SlaAiGmDWBwSes-nghGZesaw4OFbW9H5Tp_2G5AD8vbz9MyybVze0teSpN78j3VplgvlVgtf7G7g");'>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-90">
                    </div>
                    <div class="flex flex-col gap-4 text-center relative z-10 max-w-[800px]">
                        <div
                            class="inline-flex items-center justify-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary w-fit mx-auto mb-2 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-[18px]">auto_awesome</span>
                            <span class="text-xs font-bold tracking-wider uppercase">AI Power Dining</span>
                        </div>
                        <h1
                            class="text-white text-5xl md:text-6xl lg:text-7xl font-black leading-[1.1] tracking-[-0.033em]">
                            Hương vị tuyệt hảo,<br /><span class="text-primary">được AI thấu hiểu.</span>
                        </h1>
                        <h2
                            class="text-gray-300 text-lg md:text-xl font-normal leading-relaxed max-w-[600px] mx-auto mt-2">
                            Hệ thống gợi ý thông minh giúp bạn tìm thấy món ăn yêu thích ngay lập tức. Trải nghiệm ẩm
                            thực cá nhân hóa chưa từng có.
                        </h2>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
                            <!-- Nút Đặt bàn ngay -->
                            <a href="{{ url('booking-table') }}"
                                class="flex items-center justify-center rounded-xl h-14 px-8 bg-primary text-[#112116] text-base font-bold leading-normal hover:bg-[#15c550] transition-transform hover:scale-105 shadow-lg shadow-primary/25 inline-block">
                                <span class="truncate">Đặt bàn ngay</span>
                            </a>
                            <!-- Nút Xem thực đơn -->
                            <a href="{{ url('menu') }}"
                                class="flex items-center justify-center rounded-xl h-14 px-8 bg-white/10 backdrop-blur-md border border-white/20 text-white text-base font-bold leading-normal hover:bg-white/20 transition-colors inline-block">
                                <span class="truncate">Xem thực đơn</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- AI Recommendations Section -->
            <section class="py-16 px-4 md:px-10 lg:px-20 bg-background-light dark:bg-background-dark">
                <div class="max-w-7xl mx-auto flex flex-col gap-8">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-primary">psychology</span>
                                <span class="text-primary text-sm font-bold tracking-widest uppercase">Gợi ý thông
                                    minh</span>
                            </div>
                            <h2
                                class="text-[#111813] dark:text-white text-3xl md:text-4xl font-bold leading-tight tracking-[-0.02em]">
                                Dành riêng cho bạn</h2>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="size-10 rounded-full border border-[#e0e0e0] dark:border-[#29382e] flex items-center justify-center text-[#111813] dark:text-white hover:bg-primary hover:text-[#112116] hover:border-primary transition-colors">
                                <span class="material-symbols-outlined">arrow_back</span>
                            </button>
                            <button
                                class="size-10 rounded-full border border-[#e0e0e0] dark:border-[#29382e] flex items-center justify-center text-[#111813] dark:text-white hover:bg-primary hover:text-[#112116] hover:border-primary transition-colors">
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- AI Card 1 -->
                        <div
                            class="group flex flex-col rounded-2xl bg-white dark:bg-[#1c261f] shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-[#e0e0e0] dark:border-[#29382e] overflow-hidden">
                            <div class="relative w-full aspect-[4/3] overflow-hidden">
                                <div
                                    class="absolute top-3 left-3 z-10 bg-primary/90 text-[#112116] text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1 backdrop-blur-sm">
                                    <span class="material-symbols-outlined text-[14px]">thumb_up</span>
                                    98% Match
                                </div>
                                <div class="w-full h-full bg-center bg-cover transition-transform duration-500 group-hover:scale-110"
                                    data-alt="Grilled Wagyu beef on hot stone with smoke"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA3hrYqfgNxXXpqUWXStf3r6dfLgD95XJIankqjRGEw6vTzFY6rZ1I1oTvl6-oQZhr9JE7szPjMthpzWko2s3Swl7M8-s7h99e83-gEMsxsC2Oj-OGodYQNVdwgSB3aevnk_oqGgih-BNquvhEHSl-9J9EAezinp-LQN9L1UfdjvZfYt59eWWBbJAff2pfrnEPqEz9YBerbUD_WXer5dABglWfykyA9TStuxcVMaQ-84iz5rdufQcgB1g82ppKXWM7IO67q0bSHZJ4");'>
                                </div>
                            </div>
                            <div class="flex flex-col flex-1 p-5 gap-3">
                                <div>
                                    <h3
                                        class="text-[#111813] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">
                                        Bò Wagyu nướng đá</h3>
                                    <p class="text-[#637588] dark:text-[#9db8a6] text-sm mt-1 line-clamp-2">Thịt bò Nhật
                                        hảo hạng nướng trên đá nóng, giữ nguyên vị ngọt.</p>
                                </div>
                                <div
                                    class="mt-auto flex items-center justify-between pt-2 border-t border-[#e0e0e0] dark:border-[#29382e]">
                                    <span class="text-[#111813] dark:text-white font-bold text-lg">899.000₫</span>
                                    <button
                                        class="size-8 rounded-lg bg-[#f0f2f4] dark:bg-[#29382e] text-primary flex items-center justify-center hover:bg-primary hover:text-[#112116] transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- AI Card 2 -->
                        <div
                            class="group flex flex-col rounded-2xl bg-white dark:bg-[#1c261f] shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-[#e0e0e0] dark:border-[#29382e] overflow-hidden">
                            <div class="relative w-full aspect-[4/3] overflow-hidden">
                                <div
                                    class="absolute top-3 left-3 z-10 bg-[#29382e]/90 text-white text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1 backdrop-blur-sm border border-white/10">
                                    <span class="material-symbols-outlined text-[14px]">spa</span>
                                    Healthy
                                </div>
                                <div class="w-full h-full bg-center bg-cover transition-transform duration-500 group-hover:scale-110"
                                    data-alt="Colorful salad bowl with avocado and salmon"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAfWvlrOGByZaowRnntOUDj3SaeJF8aHi7e4zC8qr1PJjqSZqchrO55H95pml-LRgxk1rCRTSJKeoSY31olATFnrcfhptNqmyVdx5C4rpPblCx8REkGPYOd08y5jwJl2T8WL2-NbX2iOs2xwAo0PITXmV-u-9fwLx7Zd_8rLjBbyRkhOKYqriP5-yOMXMrDvdCIV961lC1dbJaO8RumPfpmCORHxGQO3czmPjiq5NPanS0ummIWalyTLVJd8vVJ-oCw4sD3yQXd38c");'>
                                </div>
                            </div>
                            <div class="flex flex-col flex-1 p-5 gap-3">
                                <div>
                                    <h3
                                        class="text-[#111813] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">
                                        Salad Cầu Vồng</h3>
                                    <p class="text-[#637588] dark:text-[#9db8a6] text-sm mt-1 line-clamp-2">Sự kết hợp
                                        của 7 loại rau củ organic và sốt mè rang đặc biệt.</p>
                                </div>
                                <div
                                    class="mt-auto flex items-center justify-between pt-2 border-t border-[#e0e0e0] dark:border-[#29382e]">
                                    <span class="text-[#111813] dark:text-white font-bold text-lg">189.000₫</span>
                                    <button
                                        class="size-8 rounded-lg bg-[#f0f2f4] dark:bg-[#29382e] text-primary flex items-center justify-center hover:bg-primary hover:text-[#112116] transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- AI Card 3 -->
                        <div
                            class="group flex flex-col rounded-2xl bg-white dark:bg-[#1c261f] shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-[#e0e0e0] dark:border-[#29382e] overflow-hidden">
                            <div class="relative w-full aspect-[4/3] overflow-hidden">
                                <div
                                    class="absolute top-3 left-3 z-10 bg-primary/90 text-[#112116] text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1 backdrop-blur-sm">
                                    <span class="material-symbols-outlined text-[14px]">trending_up</span>
                                    Trending
                                </div>
                                <div class="w-full h-full bg-center bg-cover transition-transform duration-500 group-hover:scale-110"
                                    data-alt="Truffle mushroom pasta with creamy sauce"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCyuq9mRU4QskyJA7L2GwcD4Ud98jSgUq_iMnl6gnvhSGFlW7wfCwFcXmaG7MPPnoeLYpP7ujkxnE-48scLvtYmKoxRZXnzXtXzJ3RfgUpByGedG5S7C10lhaThgo5VZPrGgAPhOiKQQ3GaTRC-LJrADFYbZWO4akKAOVUZnwEgvffD81y3fJeGZ5uiZCi1PGXnDgFevfWGSe9xiOoDJGj3U7GgaJ6jNzKUetgvvuZqD3oNR9YK2QOcoOGPHjXP--1UpCvWsgn_7pw");'>
                                </div>
                            </div>
                            <div class="flex flex-col flex-1 p-5 gap-3">
                                <div>
                                    <h3
                                        class="text-[#111813] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">
                                        Mỳ Ý Nấm Truffle</h3>
                                    <p class="text-[#637588] dark:text-[#9db8a6] text-sm mt-1 line-clamp-2">Hương vị nấm
                                        Truffle đen quý hiếm hòa quyện cùng kem tươi.</p>
                                </div>
                                <div
                                    class="mt-auto flex items-center justify-between pt-2 border-t border-[#e0e0e0] dark:border-[#29382e]">
                                    <span class="text-[#111813] dark:text-white font-bold text-lg">350.000₫</span>
                                    <button
                                        class="size-8 rounded-lg bg-[#f0f2f4] dark:bg-[#29382e] text-primary flex items-center justify-center hover:bg-primary hover:text-[#112116] transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- AI Card 4 -->
                        <div
                            class="group flex flex-col rounded-2xl bg-white dark:bg-[#1c261f] shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-[#e0e0e0] dark:border-[#29382e] overflow-hidden">
                            <div class="relative w-full aspect-[4/3] overflow-hidden">
                                <div
                                    class="absolute top-3 left-3 z-10 bg-[#29382e]/90 text-white text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1 backdrop-blur-sm border border-white/10">
                                    <span class="material-symbols-outlined text-[14px]">history</span>
                                    Order Again
                                </div>
                                <div class="w-full h-full bg-center bg-cover transition-transform duration-500 group-hover:scale-110"
                                    data-alt="Risotto with lobster tail on top"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCWRDQSJfaHVdSztuk2jKzKLy1LAFcUTbtN6Wz9q_jGfaX7rZP-QCW6Nn3hK3HaL-zsh4NgZ1W3gJfa88I78l4jC0ZH3Jh-rOuw4KmFY320o0T4j8LOJVgIBuqrIPyYWzT5aWWh5Bw6VPKxTrwO-e0jzVzG98WSEFFH9IcxBHKNt6PzFhAlAkBguXDrbScfhdk58i8o-ThLMRMaA2Zq9KaJIbh2zAX5w0XFsIW37SCe0q0doIZ-VYmo-98IKyehvWMQm0dPksVLb3k");'>
                                </div>
                            </div>
                            <div class="flex flex-col flex-1 p-5 gap-3">
                                <div>
                                    <h3
                                        class="text-[#111813] dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">
                                        Risotto Tôm Hùm</h3>
                                    <p class="text-[#637588] dark:text-[#9db8a6] text-sm mt-1 line-clamp-2">Cơm Ý nấu
                                        chậm với nước dùng tôm hùm thượng hạng.</p>
                                </div>
                                <div
                                    class="mt-auto flex items-center justify-between pt-2 border-t border-[#e0e0e0] dark:border-[#29382e]">
                                    <span class="text-[#111813] dark:text-white font-bold text-lg">1.250.000₫</span>
                                    <button
                                        class="size-8 rounded-lg bg-[#f0f2f4] dark:bg-[#29382e] text-primary flex items-center justify-center hover:bg-primary hover:text-[#112116] transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Feature Quick Actions -->
            <section class="py-10 px-4 md:px-10 lg:px-20">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row gap-6 items-stretch">
                        <!-- Main Card -->
                        <div class="flex-1 rounded-3xl relative overflow-hidden group min-h-[300px]">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                data-alt="Chef plating a gourmet dish in a busy kitchen"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBJ5xdyMksSFHY155gmfrMBe8aVf9e_0Qom7WZrudgJrKmx2PHo9Sf7t8eDwXYXgY1mzVl7NSITwaAC08AGcVc9tUuNMmSBKzver0D6YZuMVf0vDc7XBq0MI_N3xY7ZB0g1_8H2yo5y06UxpuEe6ocuIc9HHBhUv7uuSa2W4E4_1PSeqYSnmBH3RS9tqBqkvCeaVKrzZDNitW5_Rt24ORfAm2hzBjkmrOo0wVNzpd9EUNmobTRHOR6IGUS31eBvUZxlMTlg-fgi1uA");'>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-8 flex flex-col items-start gap-4">
                                <div>
                                    <h3 class="text-white text-3xl font-bold mb-2">Xem Thực Đơn</h3>
                                    <p class="text-gray-200 text-base max-w-sm">Khám phá hơn 200 món ăn Á-Âu được chế
                                        biến từ những nguyên liệu tươi ngon nhất.</p>
                                </div>
                                <button
                                    class="h-12 px-6 rounded-xl bg-primary text-[#112116] font-bold hover:bg-[#15c550] transition-colors flex items-center gap-2">
                                    Khám phá ngay
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex-1 flex flex-col gap-6">
                            <!-- Card 2 -->
                            <div class="flex-1 rounded-3xl relative overflow-hidden group min-h-[200px]">
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                    data-alt="Elegant dining table setup with wine glasses"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA2fwn6lwLvaH8-xF0kDVhgje7SXSmW5MbLHouisVuRlL5aqW46CyNkvPOD66I-_d2YYfEOwbGK_ImoFCm_lNk30KM7Be_oNcZMTfwwZPBvrEpKRzsmOMoX3zIlWHCu_8H1RgB0R78KKZEOuIsXHNw7qwtcyyVemOmvWLJRLmVMvhVRlA7K7UUKer-9aEA9peca1VoE0PEmVQfFlJlWwwBWOSIBW3xkC-5poNmYIHaG2der9cuxJGPQHuFu5zV_6ZecrpZYMmTNNEk");'>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-transparent"></div>
                                <div class="absolute inset-0 p-8 flex flex-col justify-center items-start gap-3">
                                    <div
                                        class="size-12 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-primary mb-2">
                                        <span class="material-symbols-outlined">table_restaurant</span>
                                    </div>
                                    <h3 class="text-white text-2xl font-bold">Đặt Bàn Online</h3>
                                    <p class="text-gray-300 text-sm">Giữ chỗ trước cho bữa tiệc hoàn hảo.</p>
                                </div>
                            </div>
                            <!-- Card 3 -->
                            <div class="flex-1 rounded-3xl relative overflow-hidden group min-h-[200px]">
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                    data-alt="Close up of a hand holding a gift voucher"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCG7f9QIuO305IYVA0NUfhH69-hqraX7wVTnIa2W1IKxH8O8n2UQ0J5nF2URWjWB-EB4BYs7kt_oLuP-FeSdcL0i6Alj85ra_5GwOJX5AeU49buq4egoPtN4ymxWFfDYX67iOvXSkNpndBkT7ppt8XqWqqSz8FBrUmd7HjOlPEcp-ZpXR66BuUL9Qfjt34VKf4KfxicaH_Xmn6Xr_fRxsF0ANMcxOg75WzhfJcEo8SuhmC6Mt7CSzRd1D1t6-P4LX0Dp3WB99mJ05c");'>
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-primary/90 to-primary/40 mix-blend-multiply">
                                </div>
                                <div
                                    class="absolute inset-0 p-8 flex flex-col justify-center items-start gap-3 relative z-10">
                                    <div
                                        class="size-12 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white mb-2">
                                        <span class="material-symbols-outlined">local_offer</span>
                                    </div>
                                    <h3 class="text-white text-2xl font-bold">Ưu Đãi Hôm Nay</h3>
                                    <p class="text-white/90 text-sm">Giảm 20% cho thành viên mới.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Categories Grid -->
            <section class="py-16 px-4 md:px-10 lg:px-20 bg-background-light dark:bg-background-dark">
                <div class="max-w-7xl mx-auto flex flex-col gap-8">
                    <h2 class="text-[#111813] dark:text-white text-3xl font-bold text-center">Danh mục món ăn</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a class="group relative rounded-2xl overflow-hidden aspect-square" href="#">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                data-alt="Appetizers platter"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDQQnLQSykZ5SKycmiT0nlwfMCl_CL2X9eXsbl5TfgyIU8_e9-J6zq7mowSEKV4TAlFduRvWeeGUsp3MWaWoJR5QihPpn4s2_ofqgrlFCtZVq5mOcFh3EX9t44FmsMoYjZGEgDZwAOz2MWAorBBrY2QRpyu2AnXYBjz13-Bfa1u3NyAIiDSPKz06iOlQjOmNi93oggTgNosv0_0iVtPQUgXhwrkMjWHLK6ZRtgIu1jSMVxSD5raF6XJEQOVGMcC_1nspRpi3JoUpH0");'>
                            </div>
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-white text-xl font-bold tracking-wide uppercase">Khai vị</span>
                            </div>
                        </a>
                        <a class="group relative rounded-2xl overflow-hidden aspect-square" href="#">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                data-alt="Grilled main course"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB0Gus1bEhvTTxRicuZP8VooEzGpL4pa79yInWnf8R3HitBARSeguRop4BFb_upfsBMXeoXuxcFryUmzN1CllFwXYcHbLVvBBkEm6fdng2kyZqBckv64PiSuj6wZUw4uu2xLgtLUon_zIHXLFPGv2mQ8pH4yiuiMoMvFT2q6u0BZnLbXqWTYrKA6ovionNNlkz97rhF4ooSv27xivgW5pWToo2S1Yf75iHaXFJpn8IJG-VLW0c_OsWSvJEklWvvjRdvVN1H-DrLVtg");'>
                            </div>
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-white text-xl font-bold tracking-wide uppercase">Món chính</span>
                            </div>
                        </a>
                        <a class="group relative rounded-2xl overflow-hidden aspect-square" href="#">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                data-alt="Colorful desserts"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD7nIj9l17W8456sty6fs62-GFQXaXx_aljMFruQDagqo1gO3Lfgy2fMrrZYX54sBHtWW1tA_RhZoOL00XweHeecKbGzUNvinERVoB0IQenYzrjqwmQbql-IvcIR4DA--kIcA8TQk4zv_ZSnO875zbovHyEYENpooCXXS9eTcBM7dPad_ge_yoJv06KscHgqVO2w7eSOirSqOleF0AZfZnUyp4xxYk0nXl76fFGflNRP7qCElgHXtmOfRwzaRMcjC03gTfdGyngtEs");'>
                            </div>
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-white text-xl font-bold tracking-wide uppercase">Tráng miệng</span>
                            </div>
                        </a>
                        <a class="group relative rounded-2xl overflow-hidden aspect-square" href="#">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                data-alt="Refreshing cocktails"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDtHVeRPFH49pl0mMlBoekSK4oI8pc2Ojo0nidv2JHIk0jFYUBmEz3IyMmHPfDbERxrc57_oCdpECnEcXU9TabY2Rg5etIiiV8jN2cWEgkpj8w9bN96tYwr6RzcPzK4uAIC9AgTgMs0rmkCAy790Yg9IjJyFMTGEw_YQFzJqJw8X2EhYbhr8YD2x56d1R1Y89wD--6FLB-kPSOcxjpHkjQc6KMbAQDrZrZd13jaxJvZv7Xr5gJEaph6JxU4cYfxBeYHLUA1FJdGmsk");'>
                            </div>
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-white text-xl font-bold tracking-wide uppercase">Đồ uống</span>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Testimonial/Social Proof -->
            <section class="py-16 px-4 md:px-10 lg:px-20 border-t border-[#e0e0e0] dark:border-[#29382e]">
                <div class="max-w-4xl mx-auto text-center flex flex-col gap-10">
                    <div>
                        <span class="text-primary font-bold uppercase tracking-widest text-sm">Khách hàng nói gì</span>
                        <h2 class="text-[#111813] dark:text-white text-3xl md:text-4xl font-bold mt-2">Đánh giá 5 sao từ
                            thực khách</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Review 1 -->
                        <div class="flex flex-col gap-4 p-6 rounded-2xl bg-[#f0f2f4] dark:bg-[#1c261f]">
                            <div class="flex gap-1 text-primary">
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                            </div>
                            <p class="text-[#637588] dark:text-[#9db8a6] text-sm italic">"AI gợi ý món bò Wagyu thật sự
                                xuất sắc, đúng ý tôi muốn ăn tối nay. Dịch vụ tuyệt vời!"</p>
                            <div class="flex items-center gap-3 mt-auto">
                                <div class="size-10 rounded-full bg-cover" data-alt="Avatar of user"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC0z5xjt-AmfaBPHdUNd42CAFt8FWeG3Cs00vbSIzQzr3Wd4D5iEpdM71y8wokyBp-E-leYTSMSWvBtrj5t2BbEmEq8vJxONFtFkrcbCIs5S2XHlS4R1Mf01M_UIZt0DLJnCjbbg4KYppfGEJNosvos1DwTFVvNsxG5u8qg1gIQnqUYsdmDHTdRRdCOAR-eXwVcr2Rho-XDqlps2pcs36Wjey1dSNCubz6qlATU94xw9USasDBT6tkTctgReTxgd65ZCe2usfdae0k");'>
                                </div>
                                <div class="text-left">
                                    <p class="text-[#111813] dark:text-white font-bold text-sm">Minh Hoàng</p>
                                    <p class="text-[#637588] dark:text-[#9db8a6] text-xs">Hà Nội</p>
                                </div>
                            </div>
                        </div>
                        <!-- Review 2 -->
                        <div class="flex flex-col gap-4 p-6 rounded-2xl bg-[#f0f2f4] dark:bg-[#1c261f]">
                            <div class="flex gap-1 text-primary">
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                            </div>
                            <p class="text-[#637588] dark:text-[#9db8a6] text-sm italic">"Không gian đẹp, món ăn ngon.
                                Tính năng đặt bàn online rất tiện lợi và nhanh chóng."</p>
                            <div class="flex items-center gap-3 mt-auto">
                                <div class="size-10 rounded-full bg-cover" data-alt="Avatar of user"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCpMjq2Eg0TZERnUsv-DoL43kcw_urNvSj7mhsQTjys0NTy_5bBAm7At9pWRQvzDFN5BqpiWY7I1yfEpg7MLhuMInOQTJzE_BL3s8g0p1NmN-VD8AAS6bwFLRxPMJYV_Tu1nuXhGnHBcSNZ7lcG88Y5w84-UZOc-L5N_rnAUh_u-vbrwDSy4ct3BCj3gt9eio6VF3VHdKnaauz3cQbMkmHf4on11K161wu0BA8yGaiQflbYb1qe3Mxnijc1FZYudizhiFTzjQWtXz0");'>
                                </div>
                                <div class="text-left">
                                    <p class="text-[#111813] dark:text-white font-bold text-sm">Thu Thảo</p>
                                    <p class="text-[#637588] dark:text-[#9db8a6] text-xs">TP. HCM</p>
                                </div>
                            </div>
                        </div>
                        <!-- Review 3 -->
                        <div class="flex flex-col gap-4 p-6 rounded-2xl bg-[#f0f2f4] dark:bg-[#1c261f]">
                            <div class="flex gap-1 text-primary">
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star_half</span>
                            </div>
                            <p class="text-[#637588] dark:text-[#9db8a6] text-sm italic">"Mỳ Ý sốt kem nấm là món 'tủ'
                                của tôi ở đây. Sẽ quay lại nhiều lần nữa."</p>
                            <div class="flex items-center gap-3 mt-auto">
                                <div class="size-10 rounded-full bg-cover" data-alt="Avatar of user"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuABpOJVaL5LUnjBwSB7FkCJgeF57Lj90or-44GQEsf0hi0pmBC4NojQ4Eg2OEKV7HcxrAJeV0LPKDd9o0WTkCmO2M6F22LPb8Glwn3FTBai_uOBzv89kaLxYOUTtaEiO28a_rTH4kKghNI4WERNu7oIK_SF5-CUzRyy_tna4tnapUfRLe2Rb_t2fzF22XFzagGMWXQnovzeQKZbUDyFLgWHV6AqZx3Lzr-Y1OIZc2Tgqz_CXzqzRq_hatKcesRooMJmmkyoDRyXKhg");'>
                                </div>
                                <div class="text-left">
                                    <p class="text-[#111813] dark:text-white font-bold text-sm">Tiến Đạt</p>
                                    <p class="text-[#637588] dark:text-[#9db8a6] text-xs">Đà Nẵng</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer -->
        <footer class="bg-white dark:bg-[#0c140e] border-t border-[#e0e0e0] dark:border-[#29382e] pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-4 md:px-10 lg:px-20">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-2 text-[#111813] dark:text-white mb-2">
                            <span class="material-symbols-outlined text-primary">restaurant_menu</span>
                            <h2 class="text-xl font-black">DeliciousAI</h2>
                        </div>
                        <p class="text-[#637588] dark:text-[#9db8a6] text-sm leading-relaxed">
                            Nhà hàng đầu tiên ứng dụng AI để cá nhân hóa trải nghiệm ẩm thực của bạn.
                        </p>
                        <div class="flex gap-4 mt-2">
                            <a class="text-[#637588] dark:text-[#9db8a6] hover:text-primary transition-colors"
                                href="#"><span class="text-sm">Facebook</span></a>
                            <a class="text-[#637588] dark:text-[#9db8a6] hover:text-primary transition-colors"
                                href="#"><span class="text-sm">Instagram</span></a>
                            <a class="text-[#637588] dark:text-[#9db8a6] hover:text-primary transition-colors"
                                href="#"><span class="text-sm">TikTok</span></a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-[#111813] dark:text-white font-bold text-base">Liên kết</h3>
                        <div class="flex flex-col gap-2">
                            <a class="text-[#637588] dark:text-[#9db8a6] text-sm hover:text-primary transition-colors"
                                href="#">Về chúng tôi</a>
                            <a class="text-[#637588] dark:text-[#9db8a6] text-sm hover:text-primary transition-colors"
                                href="#">Thực đơn</a>
                            <a class="text-[#637588] dark:text-[#9db8a6] text-sm hover:text-primary transition-colors"
                                href="#">Đặt bàn</a>
                            <a class="text-[#637588] dark:text-[#9db8a6] text-sm hover:text-primary transition-colors"
                                href="#">Tuyển dụng</a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-[#111813] dark:text-white font-bold text-base">Liên hệ</h3>
                        <div class="flex flex-col gap-2">
                            <div class="flex gap-2 items-start text-[#637588] dark:text-[#9db8a6] text-sm">
                                <span class="material-symbols-outlined text-base mt-0.5">location_on</span>
                                <span>123 Đường Ẩm Thực, Quận 1, TP.HCM</span>
                            </div>
                            <div class="flex gap-2 items-center text-[#637588] dark:text-[#9db8a6] text-sm">
                                <span class="material-symbols-outlined text-base">call</span>
                                <span>1900 1234</span>
                            </div>
                            <div class="flex gap-2 items-center text-[#637588] dark:text-[#9db8a6] text-sm">
                                <span class="material-symbols-outlined text-base">mail</span>
                                <span>contact@deliciousai.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-[#111813] dark:text-white font-bold text-base">Đăng ký nhận tin</h3>
                        <p class="text-[#637588] dark:text-[#9db8a6] text-sm">Nhận ưu đãi mới nhất từ chúng tôi.</p>
                        <div class="flex w-full gap-2">
                            <input
                                class="flex-1 rounded-lg bg-[#f0f2f4] dark:bg-[#1c261f] border-none text-sm px-4 py-2 text-[#111813] dark:text-white placeholder:text-[#637588] dark:placeholder:text-[#5e6e63] focus:ring-1 focus:ring-primary"
                                placeholder="Email của bạn" type="email" />
                            <button
                                class="bg-primary text-[#112116] rounded-lg px-4 py-2 font-bold hover:bg-[#15c550] transition-colors">
                                <span class="material-symbols-outlined">send</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="border-t border-[#e0e0e0] dark:border-[#29382e] pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-[#637588] dark:text-[#5e6e63] text-sm">© 2024 DeliciousAI. All rights reserved.</p>
                    <div class="flex gap-6">
                        <a class="text-[#637588] dark:text-[#5e6e63] text-sm hover:text-white" href="#">Điều khoản</a>
                        <a class="text-[#637588] dark:text-[#5e6e63] text-sm hover:text-white" href="#">Bảo mật</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Giới thiệu - DeliciousAI Restaurant</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;900&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#19e65e",
                        "primary-dark": "#14b84b",
                        "background-light": "#f6f8f6",
                        "background-dark": "#111813",
                        "surface-dark": "#1c2620",
                        "surface-border": "#29382e",
                    },
                    fontFamily: {
                        "display": ["Work Sans", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
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
    <style type="text/tailwindcss">
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
                <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                    href="{{ url('home') }}">Trang chủ</a>
                <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                    href="{{ url('menu') }}">Thực đơn</a>
                <a class="text-[#637588] dark:text-[#9db8a6] text-sm font-medium leading-normal hover:text-primary transition-colors"
                    href="{{ url('booking-table') }}">Đặt bàn</a>
                <a class="text-[#111813] dark:text-white text-sm font-bold leading-normal hover:text-primary transition-colors"
                    href="">Giới thiệu</a>
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
    <main class="flex-grow flex flex-col items-center w-full max-w-[1400px] mx-auto">
        <section class="w-full py-16 px-6 md:px-8 flex flex-col items-center text-center">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary text-xs font-bold uppercase tracking-widest mb-6">
                <span class="material-symbols-outlined text-sm">auto_awesome</span>
                Kỷ nguyên ẩm thực mới
            </div>
            <h1 class="text-white text-5xl md:text-7xl font-black leading-tight tracking-tight mb-6 max-w-4xl">
                Nơi Hương Vị Gặp Gỡ <span class="text-primary">Trí Tuệ Nhân Tạo</span>
            </h1>
            <p class="text-[#9db8a6] text-xl max-w-2xl font-normal leading-relaxed">
                Tại DeliciousAI, chúng tôi không chỉ phục vụ món ăn. Chúng tôi kiến tạo trải nghiệm ẩm thực cá nhân hóa
                dựa trên sự thấu hiểu và công nghệ tiên tiến nhất.
            </p>
        </section>
        <section class="w-full py-20 px-6 md:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <div
                    class="rounded-3xl overflow-hidden border border-surface-border aspect-[4/5] relative z-10 shadow-2xl">
                    <img alt="Chef preparing food" class="w-full h-full object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDHxoLbain8js09XgdyFYXPq4ncWVbR0D4HnSZHPH2-W5HJrZBFhVJOnQ5sKTYIQ8QQsR1FhKp8MEo0oTpEhHZLxl_IpqjgGsnBibL1gyXs1iWnJ9T3pORL2On-vw0jBDpwK0QDijRLZO5zyzHmOgvYpGTeOHhm4Gzz7kz5oHQCWsO9zCT_h5NlDyR1oSSf_l8HPS0z4lkgRzHKAzEB4Mszc4mJU-_bUyAcN9Ml79Ix1xQD_C7yEvSqLIccFjNifxIjCTEvV-3-UZU" />
                </div>
                <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-primary/20 rounded-full blur-3xl -z-0"></div>
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-primary/10 rounded-full blur-2xl -z-0"></div>
            </div>
            <div class="flex flex-col gap-6">
                <h2 class="text-primary text-sm font-bold uppercase tracking-[0.2em]">Câu chuyện của chúng tôi</h2>
                <h3 class="text-white text-4xl font-black leading-tight">Di sản truyền thống &amp; Tương lai công nghệ
                </h3>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Khởi nguồn từ niềm đam mê với ẩm thực Á Đông truyền thống, DeliciousAI ra đời với sứ mệnh mang đến
                    một làn gió mới cho ngành nhà hàng. Chúng tôi tin rằng công nghệ không làm mất đi linh hồn của món
                    ăn, mà ngược lại, giúp nâng tầm trải nghiệm của mỗi thực khách.
                </p>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Hệ thống AI của chúng tôi phân tích khẩu vị, thành phần dinh dưỡng và xu hướng ẩm thực toàn cầu để
                    gợi ý những món ăn hoàn hảo nhất cho từng cá nhân, đảm bảo mỗi bữa ăn tại DeliciousAI là một hành
                    trình khám phá độc bản.
                </p>
                <div class="grid grid-cols-2 gap-8 mt-4">
                    <div>
                        <p class="text-primary text-4xl font-black mb-1">15k+</p>
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Khách hàng tin dùng</p>
                    </div>
                    <div>
                        <p class="text-primary text-4xl font-black mb-1">98%</p>
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Mức độ hài lòng</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-20 px-6 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-primary text-sm font-bold uppercase tracking-[0.2em] mb-4">Không gian nhà hàng</h2>
                <h3 class="text-white text-4xl font-black">Khám phá các khu vực ẩm thực</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="group relative overflow-hidden rounded-2xl bg-surface-dark border border-surface-border hover:border-primary/50 transition-all duration-500">
                    <div class="aspect-[3/4] overflow-hidden">
                        <img alt="Standard Area"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDWUZQKWvQi52bfRtT9EtexxymyWIxXurVNQuG6YIYNIc4u5vNyDZbbB5usH7gY2kZdwuaZOuBqil8C5YJgUGajPkNhOb_lAAzM-G-xIFGuqAj5FsCzCMf7RM52ixDeSFIW-wUtlU9LcgYeS1OOQe5OlF9FHBSaIJlfHIJe4AIGPaaUi7zO7095MpS-YCojhlxAfBw8S6OJnaWQpJ-lWEZXfPjjgO-MVgu9Iu1EeKLiMJ7GIc5QIWX2ZCgiKdv6tVuk0z_cMIDz8YU" />
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-80">
                    </div>
                    <div class="absolute bottom-0 p-6 w-full">
                        <h4 class="text-white text-xl font-bold mb-2">Tiêu chuẩn</h4>
                        <p
                            class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Không gian ấm cúng, phù hợp cho những bữa tối gia đình thân mật.</p>
                    </div>
                </div>
                <div
                    class="group relative overflow-hidden rounded-2xl bg-surface-dark border border-surface-border hover:border-primary/50 transition-all duration-500">
                    <div class="aspect-[3/4] overflow-hidden">
                        <img alt="Window Area"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDwBYRsP6XR0zynGcU5UhyyVOW0HPOWY03DaJffW6do2o7rK9fhsaocyKfOzg6N0I3o2wV-lucvzZpD8SsUEO6Wv2ySFDa5zED0WJ2WowJMkyHjK4I8wU1AGAmOE83D15vFYW9UmANAVvFAobNmOYQ0JdAweZTYKwFTK_jgnCb5VMvsEAz1kfo_iHB_gWjGuKwZ511lKDtERW6EB4YnAxkczY6MVgnOw7IA_sUJB8F0etnyPOTiJ8z0qGvh_VZUhAF1eiHt2crvZD0" />
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-80">
                    </div>
                    <div class="absolute bottom-0 p-6 w-full">
                        <h4 class="text-white text-xl font-bold mb-2">Gần cửa sổ</h4>
                        <p
                            class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Tận hưởng tầm nhìn tuyệt đẹp xuống phố phường sầm uất về đêm.</p>
                    </div>
                </div>
                <div
                    class="group relative overflow-hidden rounded-2xl bg-surface-dark border border-surface-border hover:border-primary/50 transition-all duration-500">
                    <div class="aspect-[3/4] overflow-hidden">
                        <img alt="Private Area"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFAPQUzrrcJNFsI-BljGpNcy-wu6KzaCwuRxuqfpfcPnuHv0iCC8Q76X5DSuHsKtHXJbwOcd4eQJ544MsFTgy4V8o90l5yyNl1S3SZfCLMfUxJBWTKKF_x4GyppqGx6s89HN8VuUCA7Iom82QG3RKLeVVb7hjh97aKL7YyGsmspe17UbouNOququ3s7A27OqCfxxXZCWWLOP9hW7UmRS4p9Bo0xiP6HCtjyjFguNgTPDuKCOHeDZUfjjSZO2bK0tIhRTxiW-XSHK4" />
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-80">
                    </div>
                    <div class="absolute bottom-0 p-6 w-full">
                        <h4 class="text-white text-xl font-bold mb-2">Riêng tư</h4>
                        <p
                            class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Không gian tách biệt dành cho những cuộc họp đối tác hay sự kiện đặc biệt.</p>
                    </div>
                </div>
                <div
                    class="group relative overflow-hidden rounded-2xl bg-surface-dark border border-surface-border hover:border-primary/50 transition-all duration-500">
                    <div class="aspect-[3/4] overflow-hidden">
                        <img alt="Outdoor Area"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEJXXvhE9UX_S-SlyEUuRwW_ZF1FyIh9S_vueLQ6d5L1MyPKzwvyYgpI6sWwLabUG9ibIcMm3xEeJovf-sN8auG5fBZbu7m4fdfYp3Vgi2c41sAq4Cl0cAnz0bG6dPaccZsT1uqU8zZL5qqKYGUKsbTvsBk6xX0pvmOCQ-qcDqDGQ3WKJOeXpLMP_BBEcLbIv5W6vDaJQeQIDgO7lmRuJ1lGvy0PwTmVfDuQbbankG6QBJHzds4kVpMT6rhLU5twIsWV-yuJNZIXc" />
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-80">
                    </div>
                    <div class="absolute bottom-0 p-6 w-full">
                        <h4 class="text-white text-xl font-bold mb-2">Ngoài trời</h4>
                        <p
                            class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Không gian mở thoáng đãng, lý tưởng cho những buổi tiệc cocktail.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-20 px-6 md:px-8 bg-surface-dark/30 rounded-3xl border border-surface-border mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-primary text-sm font-bold uppercase tracking-[0.2em] mb-4">Đội ngũ đầu bếp</h2>
                    <h3 class="text-white text-3xl font-bold mb-6">Những bậc thầy của hương vị</h3>
                    <div class="space-y-6">
                        <div
                            class="flex items-center gap-6 p-4 rounded-2xl bg-[#161e18] border border-surface-border group hover:border-primary/30 transition-all">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-primary/20 shrink-0">
                                <img alt="Executive Chef" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBFUhVV-FcVtpSkChi44Xnd2OJ3Q556q3oINsOU92SavCkx47YZ3bOO9gf6n-3si1FZvmluzU3M7QkmCIzofD35PxfHBCOTQ3G1bn08g-DdFOKRRABv0v8XDdfr10k1Big8R-gdVK0msqugy4zSnBy8mebmdmyM0-EdRqqVVOhHav0jYSVs8hxKTl2lzgvf8gNIaI3mZhkpKROkLsC4NJ_9GOHA09vD2wHW2djMNM4PzcqWQIm2Rx6lFJHHqGuZyXtpcZ2kNid3Li4" />
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg">Alex Nguyễn</h4>
                                <p class="text-primary text-sm">Bếp trưởng điều hành</p>
                                <p class="text-gray-500 text-sm mt-1">20 năm kinh nghiệm tại các nhà hàng 5 sao quốc tế.
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex items-center gap-6 p-4 rounded-2xl bg-[#161e18] border border-surface-border group hover:border-primary/30 transition-all">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-primary/20 shrink-0">
                                <img alt="Chef de Cuisine" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAwaWT2qt8k9NU492zYMeFWO3A6oxzThGu7Ap5QkvhbtUxU0sjXFEid3wM6nUnferO7zmzTC5_rINcN8cvk6fdekp4ugZstJV0FhEI-TIhfWMlm2jmfZW3TfZ6FSy-QlYwGAePIBB7eedYuBmjvTd2dTYidADD0jbCWYFEaRaMB_bOphjBeEzY-P3TJEvJK2ehxDzxAvDwThwGvOiOoJrda3omfNfPoPzaDN8lVpJA5rkvnB8hx0geHcBbZwOQGcxoiK-wv-5UdKo" />
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg">Minh Trần</h4>
                                <p class="text-primary text-sm">Chuyên gia sáng tạo thực đơn AI</p>
                                <p class="text-gray-500 text-sm mt-1">Người đứng sau những công thức kết hợp độc đáo
                                    nhất.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-primary text-sm font-bold uppercase tracking-[0.2em] mb-4">Cam kết chất lượng</h2>
                    <h3 class="text-white text-3xl font-bold mb-6">Tiêu chuẩn khắt khe nhất</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-6 rounded-2xl bg-[#161e18] border border-surface-border">
                            <span class="material-symbols-outlined text-primary text-3xl mb-4">eco</span>
                            <h4 class="text-white font-bold mb-2">Nguyên liệu sạch</h4>
                            <p class="text-gray-500 text-sm">100% nguyên liệu được tuyển chọn từ các trang trại hữu cơ
                                địa phương.</p>
                        </div>
                        <div class="p-6 rounded-2xl bg-[#161e18] border border-surface-border">
                            <span class="material-symbols-outlined text-primary text-3xl mb-4">verified_user</span>
                            <h4 class="text-white font-bold mb-2">Vệ sinh tuyệt đối</h4>
                            <p class="text-gray-500 text-sm">Tuân thủ nghiêm ngặt các tiêu chuẩn an toàn vệ sinh thực
                                phẩm quốc tế.</p>
                        </div>
                        <div class="p-6 rounded-2xl bg-[#161e18] border border-surface-border">
                            <span
                                class="material-symbols-outlined text-primary text-3xl mb-4">precision_manufacturing</span>
                            <h4 class="text-white font-bold mb-2">Chính xác AI</h4>
                            <p class="text-gray-500 text-sm">Đo lường chính xác hàm lượng dinh dưỡng trong từng khẩu
                                phần ăn.</p>
                        </div>
                        <div class="p-6 rounded-2xl bg-[#161e18] border border-surface-border">
                            <span class="material-symbols-outlined text-primary text-3xl mb-4">diversity_1</span>
                            <h4 class="text-white font-bold mb-2">Phục vụ tận tâm</h4>
                            <p class="text-gray-500 text-sm">Đội ngũ nhân viên chuyên nghiệp, mang đến sự hài lòng vượt
                                mong đợi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="w-full py-20 px-6 md:px-8 text-center bg-gradient-to-b from-transparent to-primary/5 rounded-t-[4rem]">
            <h3 class="text-white text-3xl md:text-5xl font-black mb-8">Sẵn sàng cho một trải nghiệm khác biệt?</h3>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('booking-table') }}"
                    class="h-14 px-10 rounded-xl bg-primary hover:bg-primary-dark text-background-dark text-base font-bold shadow-lg shadow-primary/25 transition-all transform hover:scale-105 flex items-center justify-center gap-2">
                    Đặt bàn ngay
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="{{ url('menu') }}"
                    class="h-14 px-10 rounded-xl border border-surface-border text-white text-base font-bold hover:bg-surface-border transition-all flex items-center justify-center gap-2">
                    Xem thực đơn
                </a>
            </div>
        </section>
    </main>
</body>

</html>
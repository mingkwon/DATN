<!DOCTYPE html>
<html class="dark" lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập - Restaurant AI Manager</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Tailwind Custom Config -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#19e65e",
                        "background-light": "#f6f8f6",
                        "background-dark": "#112116",
                        "surface-dark": "#1c261f",
                        "border-dark": "#3c5344",
                        "text-muted": "#9db8a6",
                    },
                    fontFamily: {
                        display: ["Work Sans", "sans-serif"]
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        lg: "1rem",
                        xl: "1.5rem",
                        full: "9999px"
                    },
                    backgroundImage: {
                        'hero-pattern': "linear-gradient(to bottom, rgba(17, 33, 22, 0.6), rgba(17, 33, 22, 0.9))"
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: "Work Sans", "Noto Sans", sans-serif; }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #112116; }
        ::-webkit-scrollbar-thumb { background: #3c5344; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #19e65e; }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white h-screen overflow-hidden flex flex-col lg:flex-row">

    <!-- Left Visual Panel (Desktop Only) -->
    <div class="hidden lg:flex w-1/2 h-full relative flex-col justify-between p-12 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCeLEuzWIa9rte8V7fzsIHPWCTHaRzZSKBz8sVKPnXQg45jUYgNPRXagjJYFkKr0rlRkQ-kconF0NmqPoKTebHaWA8sjOUwH82QyHGk0103d9_qfNGyuY13AIyMU-6q8vUlKX9-KV1GNxIdT0_qSjIn3pxMCGp0Fmp9_7sWRuKKkfNORpbzD2PoNPSOjcz0hIovhZLehEIwYBCuqlVt7XvcLcIsDKhhsJ2BbF3ek0HH2CLdc7niPnyANu_63_3ULsmBCGi77IIiL7Q"
                alt="Modern fine dining restaurant interior with warm lighting"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-hero-pattern"></div>
        </div>

        <div class="relative z-10 flex items-center gap-3">
            <div class="size-10 bg-primary/20 rounded-xl flex items-center justify-center backdrop-blur-sm border border-primary/30">
                <span class="material-symbols-outlined text-primary">restaurant_menu</span>
            </div>
            <h2 class="text-white text-2xl font-bold tracking-tight">Restaurant AI</h2>
        </div>

        <div class="relative z-10 max-w-md">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 backdrop-blur-md mb-6">
                <span class="material-symbols-outlined text-primary text-sm">auto_awesome</span>
                <span class="text-primary text-xs font-bold uppercase tracking-wider">AI Powered</span>
            </div>
            <h1 class="text-4xl font-bold text-white mb-4 leading-tight">Quản lý nhà hàng thông minh hơn.</h1>
            <p class="text-gray-300 text-lg leading-relaxed">
                Tối ưu hóa quy trình, gợi ý thực đơn và phân tích doanh thu với công nghệ AI tiên tiến nhất dành cho nhà hàng của bạn.
            </p>
        </div>

        <div class="relative z-10 flex items-center gap-2 text-gray-400 text-sm">
            <span class="material-symbols-outlined text-base">location_on</span>
            <span>Hà Nội, Việt Nam</span>
        </div>
    </div>

    <!-- Right Auth Panel -->
    <div class="w-full lg:w-1/2 h-full flex flex-col relative overflow-y-auto bg-background-dark">

        <!-- Mobile Header -->
        <header class="flex lg:hidden items-center justify-between px-6 py-4 border-b border-border-dark">
            <div class="flex items-center gap-3">
                <div class="size-8 bg-primary/20 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-sm">restaurant_menu</span>
                </div>
                <span class="font-bold text-white">Restaurant AI</span>
            </div>
            <button class="text-text-muted hover:text-white">
                <span class="material-symbols-outlined">help</span>
            </button>
        </header>

        <!-- Main Form Area -->
        <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 sm:px-12">
            <div class="w-full max-w-[480px] space-y-8">

                <!-- Session Status Message -->
                @session('status')
                    <div class="p-4 rounded-xl bg-green-900/30 border border-green-600 text-green-400 text-sm font-medium text-center">
                        {{ $value }}
                    </div>
                @endsession

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-red-900/30 border border-red-600 text-red-400 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>Tên đăng nhập hoặc mật khẩu không chính xác</p>
                        @endforeach
                    </div>
                @endif

                <!-- Header -->
                <div class="text-center space-y-2">
                    <h1 class="text-3xl font-bold text-white tracking-tight">Chào mừng trở lại</h1>
                    <p class="text-text-muted">Nhập thông tin đăng nhập của bạn để truy cập bảng điều khiển.</p>
                </div>

                <!-- Tabs (chỉ để đẹp, chưa có route đăng ký thì để # hoặc route('register')) -->
                <div class="border-b border-border-dark">
                    <nav class="-mb-px flex justify-center space-x-8">
                        <a href="{{ route('login') }}"
                           class="border-primary text-primary whitespace-nowrap border-b-2 py-4 px-1 text-sm font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">login</span>
                            Đăng nhập
                        </a>
                        <a href="{{ route('register') ?? '#' }}"
                           class="border-transparent text-text-muted hover:border-gray-300 hover:text-gray-300 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">person_add</span>
                            Đăng ký
                        </a>
                    </nav>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6 mt-8">
                    @csrf

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-white">Email hoặc Tên đăng nhập</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <span class="material-symbols-outlined text-text-muted">mail</span>
                            </div>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="quanly@nhahang.com"
                                class="block w-full rounded-xl border-0 py-4 pl-12 text-white bg-surface-dark ring-1 ring-inset ring-border-dark placeholder:text-text-muted focus:ring-2 focus:ring-primary transition-all"
                            />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-white">Mật khẩu</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <span class="material-symbols-outlined text-text-muted">lock</span>
                            </div>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="block w-full rounded-xl border-0 py-4 pl-12 pr-12 text-white bg-surface-dark ring-1 ring-inset ring-border-dark placeholder:text-text-muted focus:ring-2 focus:ring-primary transition-all"
                            />
                            <button type="button"
                                    onclick="let input = this.previousElementSibling; let icon = this.querySelector('span'); input.type = input.type === 'password' ? 'text' : 'password'; icon.textContent = input.type === 'password' ? 'visibility' : 'visibility_off';"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-text-muted hover:text-white cursor-pointer">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-border-dark bg-surface-dark text-primary focus:ring-primary" />
                            <span class="ml-2 text-sm text-text-muted">Ghi nhớ đăng nhập</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-primary hover:text-green-400">
                                Quên mật khẩu?
                            </a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="w-full py-4 rounded-xl bg-primary text-[#111813] font-bold hover:bg-green-400 transition-colors duration-200">
                        Đăng nhập
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-border-dark"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-background-dark px-6 text-text-muted">Hoặc tiếp tục với</span>
                    </div>
                </div>

                <!-- Social Login (placeholder) -->
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="flex items-center justify-center gap-3 rounded-xl bg-surface-dark py-3 text-white ring-1 ring-border-dark hover:bg-[#253229] transition-all">
                        <svg class="h-5 w-5" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="text-sm font-semibold">Google</span>
                    </a>
                    <a href="#" class="flex items-center justify-center gap-3 rounded-xl bg-surface-dark py-3 text-white ring-1 ring-border-dark hover:bg-[#253229] transition-all">
                        <svg class="h-5 w-5 fill-current text-[#1877F2]" viewBox="0 0 24 24">
                            <path clipRule="evenodd" fillRule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                        <span class="text-sm font-semibold">Facebook</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Support -->
        <div class="p-6 text-center lg:text-right border-t lg:border-none border-border-dark">
            <button class="inline-flex items-center rounded-xl px-4 py-2 bg-surface-dark text-text-muted hover:text-white text-sm font-bold transition-colors">
                <span class="material-symbols-outlined text-sm mr-2">headset_mic</span>
                Trợ giúp & Hỗ trợ
            </button>
        </div>
    </div>
</body>
</html>
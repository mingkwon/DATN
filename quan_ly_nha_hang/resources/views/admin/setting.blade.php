<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cài đặt &amp; Phân quyền - Restaurant Manager</title>
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
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('dashboard') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">dashboard</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Tổng quan</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('tables') }}">
                        <span
                            class="material-symbols-outlined text-gray-400 group-hover:text-white">table_restaurant</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Bàn phục vụ</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('bookings') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">receipt_long</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Danh sách đặt bàn</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('add_food') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">restaurant</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Quản lý thực đơn</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 border border-primary/20"
                        href="">
                        <span class="material-symbols-outlined text-primary fill-1">settings</span>
                        <p class="text-primary text-sm font-bold">Cài đặt</p>
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
            <div class="flex-1 overflow-y-auto p-4 lg:p-8">
                <div class="max-w-[1600px] mx-auto flex flex-col gap-8">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-3">
                                <button
                                    class="lg:hidden size-8 rounded-full bg-surface-dark border border-border-dark flex items-center justify-center text-gray-400">
                                    <span class="material-symbols-outlined">menu</span>
                                </button>
                                <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-tight">Cài
                                    đặt tài khoản &amp; Phân quyền</h1>
                            </div>
                            <p class="text-gray-400 text-base font-normal max-w-2xl">
                                Quản lý danh sách tài khoản, thiết lập vai trò và kiểm soát quyền truy cập hệ thống.
                            </p>
                        </div>
                    </div>

                    <div class="bg-surface-dark border border-border-dark rounded-2xl overflow-hidden flex flex-col">
                        <div
                            class="p-6 border-b border-border-dark flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="relative w-full sm:w-96 group">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-primary transition-colors">search</span>
                                <input
                                    class="w-full bg-background-dark border border-border-dark text-white text-sm rounded-xl py-3 pl-10 pr-4 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all placeholder:text-gray-600"
                                    placeholder="Tìm kiếm theo tên hoặc email nhân viên..." type="text" />
                            </div>
                        </div>

                        <div class="overflow-x-auto relative">
                            <!-- Thông báo khi không tìm thấy -->
                            <div id="no-results" class="hidden p-8 text-center text-gray-400 text-lg font-medium">
                                Không tìm thấy nhân viên nào phù hợp với từ khóa.
                            </div>

                            <table id="users-table" class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-background-dark/50 border-b border-border-dark">
                                        <th class="px-6 py-4 text-gray-400 text-xs font-bold uppercase tracking-wider">
                                            Họ và tên</th>
                                        <th class="px-6 py-4 text-gray-400 text-xs font-bold uppercase tracking-wider">
                                            Email</th>
                                        <th class="px-6 py-4 text-gray-400 text-xs font-bold uppercase tracking-wider">
                                            Vai trò hiện tại</th>
                                        <th class="px-6 py-4 text-gray-400 text-xs font-bold uppercase tracking-wider">
                                            Ngày tạo</th>
                                        <th
                                            class="px-6 py-4 text-gray-400 text-xs font-bold uppercase tracking-wider text-right">
                                            Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border-dark/50">
                                    @php
                                        // Lấy admin@gmail.com (nếu có)
                                        $adminUser = $users->firstWhere('email', 'admin@gmail.com');

                                        // Lấy các user khác, sắp xếp theo created_at giảm dần (mới nhất lên đầu)
                                        $otherUsers = $users
                                            ->where('email', '!=', 'admin@gmail.com')
                                            ->sortByDesc('created_at');
                                    @endphp

                                    @if($adminUser)
                                        <tr
                                            class="hover:bg-white/5 transition-colors group user-row bg-primary/5 border-l-4 border-primary">
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="size-9 rounded-full bg-primary/20 border border-primary/30 flex items-center justify-center text-primary font-bold text-xs">
                                                        {{ strtoupper(substr($adminUser->name, 0, 1)) }}
                                                    </div>
                                                    <span class="text-white font-medium">{{ $adminUser->name }}</span>
                                                    <span
                                                        class="ml-2 text-xs bg-primary/20 text-primary px-2 py-0.5 rounded-full">Admin
                                                        chính</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-gray-400 text-sm">{{ $adminUser->email }}</td>
                                            <td class="px-6 py-5">
                                                <span
                                                    class="px-2.5 py-1 bg-sky-500/10 text-sky-500 border border-sky-500/20 text-[10px] font-bold uppercase rounded-md">
                                                    {{ ucfirst($adminUser->usertype) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 text-gray-400 text-sm">
                                                {{ $adminUser->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-5 text-right">
                                                <span class="text-gray-500 text-sm italic">Không thể chỉnh sửa</span>
                                            </td>
                                        </tr>
                                    @endif

                                    @foreach($otherUsers as $user)
                                        <tr class="hover:bg-white/5 transition-colors group user-row"
                                            data-name="{{ strtolower($user->name) }}"
                                            data-email="{{ strtolower($user->email) }}">
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="size-9 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center text-primary font-bold text-xs">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                    <span class="text-white font-medium">{{ $user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-gray-400 text-sm">{{ $user->email }}</td>
                                            <td class="px-6 py-5">
                                                @php
                                                    $roleColor = match ($user->usertype) {
                                                        'admin' => 'bg-sky-500/10 text-sky-500 border-sky-500/20',
                                                        'staff' => 'bg-orange-500/10 text-orange-500 border-orange-500/20',
                                                        default => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
                                                    };
                                                @endphp
                                                <span
                                                    class="px-2.5 py-1 {{ $roleColor }} text-[10px] font-bold uppercase rounded-md">
                                                    {{ ucfirst($user->usertype) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 text-gray-400 text-sm">
                                                {{ $user->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-5 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ url('ass_staff', $user->id) }}"
                                                        class="px-3 py-1.5 bg-orange-500/10 text-orange-500 hover:bg-orange-500 hover:text-white border border-orange-500/20 rounded-lg text-xs font-bold transition-all">
                                                        → Staff
                                                    </a>

                                                    <a href="{{ url('ass_admin', $user->id) }}"
                                                        class="px-3 py-1.5 bg-sky-500/10 text-sky-500 hover:bg-sky-500 hover:text-white border border-sky-500/20 rounded-lg text-xs font-bold transition-all">
                                                        → Admin
                                                    </a>

                                                    <a href="{{ url('delete_acc', $user->id) }}"
                                                        class="p-2 rounded-lg text-red-400 hover:text-red-500 hover:bg-red-500/10 transition-all"
                                                        title="Xóa tài khoản">
                                                        <span class="material-symbols-outlined text-lg">close</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="p-6 border-t border-border-dark flex items-center justify-between">
                            <p class="text-gray-400 text-sm">
                                Đang hiển thị <span
                                    class="text-white font-medium">{{ $users->firstItem() }}-{{ $users->lastItem() }}</span>
                                trên <span class="text-white font-medium">{{ $users->total() }}</span> nhân viên
                            </p>
                            {{ $users->links() }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-6 bg-surface-dark border border-border-dark rounded-2xl flex items-center gap-4">
                            <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-3xl">groups</span>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Tổng nhân sự</p>
                                <h4 class="text-white text-2xl font-black">{{ $totalUsers }}</h4>
                            </div>
                        </div>
                        <div class="p-6 bg-surface-dark border border-border-dark rounded-2xl flex items-center gap-4">
                            <div class="size-12 rounded-xl bg-sky-500/10 flex items-center justify-center text-sky-500">
                                <span class="material-symbols-outlined text-3xl">admin_panel_settings</span>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Quản trị viên
                                    (Admin)</p>
                                <h4 class="text-white text-2xl font-black">{{ $adminCount }}</h4>
                            </div>
                        </div>
                        <div class="p-6 bg-surface-dark border border-border-dark rounded-2xl flex items-center gap-4">
                            <div
                                class="size-12 rounded-xl bg-orange-500/10 flex items-center justify-center text-orange-500">
                                <span class="material-symbols-outlined text-3xl">badge</span>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Nhân viên (Staff)
                                </p>
                                <h4 class="text-white text-2xl font-black">{{ $staffCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript: Tìm kiếm realtime + Đổi vai trò + Xóa user -->
    <script>
        // Tìm kiếm realtime (giữ nguyên như cũ)
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('input[placeholder*="Tìm kiếm theo tên hoặc email"]');
            const tableRows = document.querySelectorAll('.user-row');
            const noResults = document.getElementById('no-results');
            const table = document.getElementById('users-table');

            if (!searchInput || tableRows.length === 0) return;

            searchInput.addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase().trim();
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const name = row.getAttribute('data-name') || '';
                    const email = row.getAttribute('data-email') || '';

                    if (name.includes(searchTerm) || email.includes(searchTerm)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (visibleCount === 0) {
                    table.style.display = 'none';
                    noResults.classList.remove('hidden');
                } else {
                    table.style.display = '';
                    noResults.classList.add('hidden');
                }
            });
        });
    </script>

</body>

</html>
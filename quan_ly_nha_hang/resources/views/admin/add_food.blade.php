<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Quản lý thực đơn - Restaurant Manager</title>
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

        .modal-open {
            overflow: hidden;
        }

        .modal-base {
            visibility: hidden;
            opacity: 0;
            transition: all 0.2s ease-in-out;
        }

        .modal-base:target,
        .modal-base.active {
            visibility: visible;
            opacity: 1;
        }

        .modal-base:target .modal-content,
        .modal-base.active .modal-content {
            transform: scale(1);
            opacity: 1;
        }

        .modal-content {
            transform: scale(0.95);
            opacity: 0;
            transition: all 0.2s ease-in-out;
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
                        href="{{ url('home') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">dashboard</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Tổng quan</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('tables') }}">
                        <span
                            class="material-symbols-outlined text-gray-400 group-hover:text-white">table_restaurant</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Bàn phục vụ</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 border border-primary/20"
                        href="#">
                        <span class="material-symbols-outlined text-primary fill-1">restaurant</span>
                        <p class="text-primary text-sm font-bold">Quản lý thực đơn</p>
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
            <div class="flex-1 overflow-y-auto p-4 lg:p-8">
                <div class="max-w-[1600px] mx-auto flex flex-col gap-8">
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-3">
                                    <button
                                        class="lg:hidden size-8 rounded-full bg-surface-dark border border-border-dark flex items-center justify-center text-gray-400">
                                        <span class="material-symbols-outlined">menu</span>
                                    </button>
                                    <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-tight">
                                        Quản lý thực đơn</h1>
                                </div>
                                <p class="text-gray-400 text-base font-normal max-w-2xl">
                                    Quản lý danh sách món ăn, cập nhật giá và thông tin để tối ưu doanh thu nhà hàng.
                                </p>
                            </div>
                            <div class="flex items-center gap-3 self-start md:self-auto">
                                <div class="relative group">
                                    <button
                                        class="size-11 rounded-xl bg-surface-dark border border-border-dark flex items-center justify-center text-gray-400 hover:text-white hover:border-gray-500 transition-all">
                                        <span class="material-symbols-outlined">notifications</span>
                                        <span
                                            class="absolute top-2.5 right-3 size-2 bg-red-500 rounded-full border-2 border-surface-dark"></span>
                                    </button>
                                </div>
                                <a class="flex items-center gap-2 bg-primary hover:bg-primary-dark active:scale-95 transition-all text-background-dark px-5 py-3 rounded-xl font-bold text-sm shadow-[0_0_20px_rgba(25,230,94,0.3)] cursor-pointer decoration-none"
                                    href="#add-item-modal">
                                    <span class="material-symbols-outlined text-xl">add_circle</span>
                                    <span>Thêm món mới</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-8">
                        <div class="w-full lg:w-64 flex-shrink-0 flex flex-col gap-6">
                            <div class="relative group">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-primary transition-colors">search</span>
                                <input id="search-food"
                                    class="w-full bg-surface-dark border border-border-dark text-white text-sm rounded-xl py-3 pl-10 pr-4 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all placeholder:text-gray-600"
                                    placeholder="Tìm kiếm món ăn..." type="text" />
                            </div>
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center justify-between px-2">
                                    <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider">Danh mục</h3>
                                    <button class="text-primary text-xs font-medium hover:underline">Chỉnh sửa</button>
                                </div>

                                <!-- Tất cả -->
                                <label
                                    class="group flex items-center gap-3 p-3 rounded-xl border border-border-dark cursor-pointer transition-all hover:bg-surface-dark hover:border-gray-500 has-[:checked]:bg-primary/10 has-[:checked]:border-primary/50">
                                    <input checked class="hidden peer" name="category" type="radio" value="all" />
                                    <div
                                        class="w-1 h-8 rounded-full bg-transparent group-hover:bg-gray-600 peer-checked:bg-primary transition-colors">
                                    </div>
                                    <div class="flex-1 flex justify-between items-center">
                                        <span
                                            class="text-gray-400 group-hover:text-white text-sm font-medium transition-colors peer-checked:text-white peer-checked:font-bold">Tất
                                            cả</span>
                                        <span
                                            class="text-xs bg-surface-dark border border-border-dark text-white px-2 py-1 rounded-md transition-colors peer-checked:bg-primary/20 peer-checked:text-primary peer-checked:border-primary/20">{{ $data->count() }}</span>
                                    </div>
                                </label>

                                <!-- Món khai vị -->
                                <label
                                    class="group flex items-center gap-3 p-3 rounded-xl border border-border-dark cursor-pointer transition-all hover:bg-surface-dark hover:border-gray-500 has-[:checked]:bg-primary/10 has-[:checked]:border-primary/50">
                                    <input class="hidden peer" name="category" type="radio" value="khai-vi" />
                                    <div
                                        class="w-1 h-8 rounded-full bg-transparent group-hover:bg-gray-600 peer-checked:bg-primary transition-colors">
                                    </div>
                                    <div class="flex-1 flex justify-between items-center">
                                        <span
                                            class="text-gray-400 group-hover:text-white text-sm font-medium transition-colors peer-checked:text-white peer-checked:font-bold">Món
                                            khai vị</span>
                                        <span
                                            class="text-xs bg-surface-dark border border-border-dark text-white px-2 py-1 rounded-md transition-colors peer-checked:bg-primary/20 peer-checked:text-primary peer-checked:border-primary/20">{{ $data->where('type', 'khai-vi')->count() }}</span>
                                    </div>
                                </label>

                                <!-- Món chính -->
                                <label
                                    class="group flex items-center gap-3 p-3 rounded-xl border border-border-dark cursor-pointer transition-all hover:bg-surface-dark hover:border-gray-500 has-[:checked]:bg-primary/10 has-[:checked]:border-primary/50">
                                    <input class="hidden peer" name="category" type="radio" value="mon-chinh" />
                                    <div
                                        class="w-1 h-8 rounded-full bg-transparent group-hover:bg-gray-600 peer-checked:bg-primary transition-colors">
                                    </div>
                                    <div class="flex-1 flex justify-between items-center">
                                        <span
                                            class="text-gray-400 group-hover:text-white text-sm font-medium transition-colors peer-checked:text-white peer-checked:font-bold">Món
                                            chính</span>
                                        <span
                                            class="text-xs bg-surface-dark border border-border-dark text-white px-2 py-1 rounded-md transition-colors peer-checked:bg-primary/20 peer-checked:text-primary peer-checked:border-primary/20">{{ $data->where('type', 'mon-chinh')->count() }}</span>
                                    </div>
                                </label>

                                <!-- Tráng miệng -->
                                <label
                                    class="group flex items-center gap-3 p-3 rounded-xl border border-border-dark cursor-pointer transition-all hover:bg-surface-dark hover:border-gray-500 has-[:checked]:bg-primary/10 has-[:checked]:border-primary/50">
                                    <input class="hidden peer" name="category" type="radio" value="trang-mieng" />
                                    <div
                                        class="w-1 h-8 rounded-full bg-transparent group-hover:bg-gray-600 peer-checked:bg-primary transition-colors">
                                    </div>
                                    <div class="flex-1 flex justify-between items-center">
                                        <span
                                            class="text-gray-400 group-hover:text-white text-sm font-medium transition-colors peer-checked:text-white peer-checked:font-bold">Tráng
                                            miệng</span>
                                        <span
                                            class="text-xs bg-surface-dark border border-border-dark text-white px-2 py-1 rounded-md transition-colors peer-checked:bg-primary/20 peer-checked:text-primary peer-checked:border-primary/20">{{ $data->where('type', 'trang-mieng')->count() }}</span>
                                    </div>
                                </label>

                                <!-- Đồ uống -->
                                <label
                                    class="group flex items-center gap-3 p-3 rounded-xl border border-border-dark cursor-pointer transition-all hover:bg-surface-dark hover:border-gray-500 has-[:checked]:bg-primary/10 has-[:checked]:border-primary/50">
                                    <input class="hidden peer" name="category" type="radio" value="do-uong" />
                                    <div
                                        class="w-1 h-8 rounded-full bg-transparent group-hover:bg-gray-600 peer-checked:bg-primary transition-colors">
                                    </div>
                                    <div class="flex-1 flex justify-between items-center">
                                        <span
                                            class="text-gray-400 group-hover:text-white text-sm font-medium transition-colors peer-checked:text-white peer-checked:font-bold">Đồ
                                            uống</span>
                                        <span
                                            class="text-xs bg-surface-dark border border-border-dark text-white px-2 py-1 rounded-md transition-colors peer-checked:bg-primary/20 peer-checked:text-primary peer-checked:border-primary/20">{{ $data->where('type', 'do-uong')->count() }}</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                                <p class="text-white font-medium">Danh sách món ăn</p>
                                <div class="flex items-center gap-2">
                                    <button
                                        class="flex items-center gap-2 px-3 py-2 rounded-lg border border-border-dark bg-surface-dark text-gray-300 text-xs font-medium hover:text-white hover:border-gray-500 transition-colors">
                                        <span class="material-symbols-outlined text-sm">sort</span>
                                        Sắp xếp: Mới nhất
                                    </button>
                                    <button
                                        class="flex items-center gap-2 px-3 py-2 rounded-lg border border-border-dark bg-surface-dark text-gray-300 text-xs font-medium hover:text-white hover:border-gray-500 transition-colors">
                                        <span class="material-symbols-outlined text-sm">filter_list</span>
                                        Bộ lọc
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                                @foreach($data as $data)
                                    <div class="group bg-surface-dark border border-border-dark hover:border-primary/50 rounded-2xl overflow-hidden flex flex-col transition-all duration-300 hover:shadow-xl hover:shadow-black/50"
                                        data-type="{{ $data->type ?? 'unknown' }}">
                                        <div class="h-48 w-full bg-gray-800 relative overflow-hidden rounded-t-2xl">
                                            <!-- thêm rounded nếu cần -->
                                            <div
                                                class="absolute inset-0 transition-transform duration-700 group-hover:scale-110">
                                                <img src="{{ $data->image ? asset('food_img/' . $data->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                                                    alt="{{ $data->title ?? 'Món ăn' }}"
                                                    class="w-full h-full object-cover object-center" />
                                            </div>

                                            <!-- Optional: Overlay hoặc badge nếu cần -->
                                            <!-- Ví dụ badge "Bán chạy" hoặc "Hết hàng" có thể đặt ở đây -->
                                        </div>
                                        <div class="p-4 flex flex-col flex-1 gap-3">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h3
                                                        class="text-white font-bold text-lg group-hover:text-primary transition-colors">
                                                        {{ $data->title }}
                                                    </h3>
                                                    <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $data->detail }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="mt-auto pt-3 border-t border-white/5 flex items-center justify-between">
                                                <p class="text-primary font-bold text-lg">
                                                    {{ $data->price ? number_format($data->price, 0, ',', '.') : '0' }}đ
                                                </p>
                                                <div class="relative group/menu">
                                                    <button
                                                        class="size-8 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-colors focus:outline-none flex items-center justify-center">
                                                        <span class="material-symbols-outlined text-xl">more_vert</span>
                                                    </button>
                                                    <div
                                                        class="absolute right-0 bottom-full mb-1 w-36 bg-surface-dark border border-border-dark rounded-xl shadow-xl shadow-black/50 overflow-hidden invisible opacity-0 group-focus-within/menu:visible group-focus-within/menu:opacity-100 transition-all duration-200 z-10 origin-bottom-right flex flex-col">
                                                        <a class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-colors text-left"
                                                            href="#edit-item-modal-{{ $data->id }}">
                                                            <span class="material-symbols-outlined text-lg">edit</span>
                                                            Sửa món
                                                        </a>
                                                        <a class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors text-left"
                                                            href="#delete-item-modal-{{ $data->id }}">
                                                            <span class="material-symbols-outlined text-lg">delete</span>
                                                            Xóa món
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal sửa món -->
                                    <div class="modal-base fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 overflow-y-auto"
                                        id="edit-item-modal-{{ $data->id }}">
                                        <div
                                            class="modal-content w-full max-w-2xl bg-background-dark border border-border-dark rounded-2xl shadow-2xl flex flex-col max-h-[90vh]">
                                            <div class="flex items-center justify-between p-6 border-b border-border-dark">
                                                <h2 class="text-xl font-bold text-white">Sửa món ăn</h2>
                                                <a href="" class="text-gray-400 hover:text-white transition-colors">
                                                    <span class="material-symbols-outlined">close</span>
                                                </a>
                                            </div>
                                            <div class="p-6 overflow-y-auto">
                                                <form action="{{ url('edit_food', $data->id) }}" method="POST"
                                                    enctype="multipart/form-data" class="flex flex-col gap-6">
                                                    @csrf

                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                        <!-- Tên món -->
                                                        <div class="flex flex-col gap-2">
                                                            <label class="text-sm font-medium text-gray-300">Tên món</label>
                                                            <input name="title" type="text" required
                                                                value="{{ $data->title }}"
                                                                class="w-full bg-surface-dark border border-border-dark text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" />
                                                        </div>

                                                        <!-- Giá -->
                                                        <div class="flex flex-col gap-2">
                                                            <label class="text-sm font-medium text-gray-300">Giá
                                                                (VNĐ)</label>
                                                            <input type="text" inputmode="numeric"
                                                                value="{{ $data->price ? number_format($data->price, 0, ',', '.') : '' }}"
                                                                class="price-display-input w-full bg-surface-dark border border-border-dark text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                                                                required />
                                                            <input type="hidden" name="price" class="price-real-value"
                                                                value="{{ $data->price }}" />
                                                        </div>
                                                    </div>

                                                    <!-- Danh mục -->
                                                    <div class="flex flex-col gap-2">
                                                        <label class="text-sm font-medium text-gray-300">Danh mục</label>
                                                        <select name="type" required
                                                            class="w-full bg-surface-dark border border-border-dark text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                                                            <option value="" disabled>Chọn danh mục món ăn</option>
                                                            <option value="khai-vi" {{ $data->type == 'khai-vi' ? 'selected' : '' }}>Khai vị</option>
                                                            <option value="mon-chinh" {{ $data->type == 'mon-chinh' ? 'selected' : '' }}>Món chính</option>
                                                            <option value="trang-mieng" {{ $data->type == 'trang-mieng' ? 'selected' : '' }}>Tráng miệng</option>
                                                            <option value="do-uong" {{ $data->type == 'do-uong' ? 'selected' : '' }}>Đồ uống</option>
                                                        </select>
                                                    </div>

                                                    <!-- Mô tả -->
                                                    <div class="flex flex-col gap-2">
                                                        <label class="text-sm font-medium text-gray-300">Mô tả món
                                                            ăn</label>
                                                        <textarea name="detail" rows="4" required
                                                            class="w-full bg-surface-dark border border-border-dark text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all resize-none">{{ $data->detail }}</textarea>
                                                    </div>

                                                    <!-- Hình ảnh -->
                                                    <div class="flex flex-col gap-2">
                                                        <label class="text-sm font-medium text-gray-300">Hình ảnh hiện
                                                            tại</label>
                                                        <div class="flex items-center gap-4">
                                                            @if($data->image)
                                                                <div class="size-20 rounded-lg bg-cover bg-center border border-border-dark"
                                                                    style="background-image: url('{{ asset('food_img/' . $data->image) }}')">
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="size-20 rounded-lg bg-gray-700 border border-border-dark flex items-center justify-center">
                                                                    <span class="text-gray-500 text-xs">Không có ảnh</span>
                                                                </div>
                                                            @endif
                                                            <label
                                                                class="flex-1 flex flex-col items-center justify-center h-20 border-2 border-dashed border-border-dark rounded-xl cursor-pointer bg-surface-dark hover:bg-surface-dark/80 hover:border-primary/50 transition-all group">
                                                                <div
                                                                    class="flex flex-col items-center justify-center pt-2 pb-2">
                                                                    <span
                                                                        class="material-symbols-outlined text-2xl text-gray-400 group-hover:text-primary transition-colors">cloud_upload</span>
                                                                    <p class="text-xs text-gray-500 mt-1">Thay đổi ảnh (Tối
                                                                        đa 2MB)</p>
                                                                </div>
                                                                <input type="file" name="image" class="hidden" />
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="p-6 border-t border-border-dark flex justify-end gap-3 bg-surface-dark rounded-b-2xl">
                                                        <a href=""
                                                            class="px-5 py-2.5 rounded-xl border border-border-dark text-gray-300 hover:text-white hover:bg-white/5 transition-all font-medium text-sm">
                                                            Hủy bỏ
                                                        </a>
                                                        <button type="submit"
                                                            class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-background-dark font-bold text-sm shadow-lg shadow-primary/20 transition-all active:scale-95">
                                                            Cập nhật
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal xóa món -->
                                    <div class="modal-base fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
                                        id="delete-item-modal-{{ $data->id }}">
                                        <div
                                            class="modal-content w-full max-w-sm bg-background-dark border border-border-dark rounded-2xl shadow-2xl flex flex-col">
                                            <div class="p-6 flex flex-col items-center text-center gap-4">
                                                <div
                                                    class="size-14 rounded-full bg-red-500/10 flex items-center justify-center text-red-500 mb-2">
                                                    <span class="material-symbols-outlined text-3xl">warning</span>
                                                </div>
                                                <h3 class="text-xl font-bold text-white">Xóa món ăn?</h3>
                                                <p class="text-gray-400 text-sm">Bạn có chắc chắn muốn xóa món này? Hành
                                                    động này không thể hoàn tác.
                                                </p>
                                            </div>
                                            <div
                                                class="p-6 border-t border-border-dark flex gap-3 bg-surface-dark rounded-b-2xl">
                                                <a class="flex-1 px-5 py-2.5 rounded-xl border border-border-dark text-gray-300 hover:text-white hover:bg-white/5 transition-all font-medium text-sm text-center"
                                                    href="#">
                                                    Hủy bỏ
                                                </a>
                                                <a class="flex-1 px-5 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-bold text-sm shadow-lg shadow-red-500/20 transition-all text-center active:scale-95"
                                                    href="{{ url('delete_food', $data->id) }}">
                                                    Xóa
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <a class="group min-h-[300px] border-2 border-dashed border-border-dark hover:border-primary/50 rounded-2xl flex flex-col items-center justify-center gap-4 transition-all hover:bg-surface-dark/50 cursor-pointer decoration-none"
                                    href="#add-item-modal">
                                    <div
                                        class="size-16 rounded-full bg-surface-dark border border-border-dark flex items-center justify-center group-hover:bg-primary group-hover:text-background-dark group-hover:scale-110 transition-all text-gray-400">
                                        <span class="material-symbols-outlined text-3xl">add</span>
                                    </div>
                                    <p class="text-gray-400 group-hover:text-white font-medium">Thêm món ăn mới</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ url('upload_food') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
        @csrf
        <div class="modal-base fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 overflow-y-auto"
            id="add-item-modal">
            <div
                class="modal-content w-full max-w-2xl bg-background-dark border border-border-dark rounded-2xl shadow-2xl flex flex-col max-h-[90vh]">
                <div class="flex items-center justify-between p-6 border-b border-border-dark">
                    <h2 class="text-xl font-bold text-white">Thêm món mới</h2>
                    <a class="text-gray-400 hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined">close</span>
                    </a>
                </div>
                <div class="p-6 overflow-y-auto custom-scrollbar">
                    <div class="flex flex-col gap-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tên món -->
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-gray-300">Tên món</label>
                                <input name="title" type="text" required placeholder="Nhập tên món ăn..."
                                    class="w-full bg-surface-dark border border-border-dark text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary placeholder:text-gray-600 transition-all" />
                            </div>

                            <!-- Giá tiền -->
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-gray-300">Giá (VNĐ)</label>
                                <input name="price" id="price-input" type="text" inputmode="numeric" placeholder="0"
                                    required
                                    class="w-full bg-surface-dark border border-border-dark text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary placeholder:text-gray-600 transition-all" />

                                <!-- Giá trị thật gửi về server (số nguyên) -->
                                <input type="hidden" name="price" id="price-value" value="">
                            </div>
                        </div>

                        <!-- Danh mục -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-300">Danh mục</label>
                            <select name="type" required
                                class="w-full bg-surface-dark border border-border-dark text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                                <option value="" disabled selected>Chọn danh mục món ăn</option>
                                <option value="khai-vi">Khai vị</option>
                                <option value="mon-chinh">Món chính</option>
                                <option value="trang-mieng">Tráng miệng</option>
                                <option value="do-uong">Đồ uống</option>
                            </select>
                        </div>

                        <!-- Mô tả -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-300">Mô tả món ăn</label>
                            <textarea name="detail" rows="4" required
                                placeholder="Nhập mô tả chi tiết về thành phần, hương vị..."
                                class="w-full bg-surface-dark border border-border-dark text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary placeholder:text-gray-600 transition-all resize-none"></textarea>
                        </div>

                        <!-- Upload ảnh -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-300">Hình ảnh</label>
                            <label
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-border-dark rounded-xl cursor-pointer bg-surface-dark hover:bg-surface-dark/80 hover:border-primary/50 transition-all group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <span
                                        class="material-symbols-outlined text-3xl text-gray-400 mb-2 group-hover:text-primary transition-colors">
                                        cloud_upload
                                    </span>
                                    <p class="mb-1 text-sm text-gray-400 group-hover:text-gray-300">
                                        <span class="font-semibold">Nhấn để tải lên</span> hoặc kéo thả
                                    </p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG (Tối đa 2MB)</p>
                                </div>
                                <input type="file" name="img" accept="image/*" required class="hidden" />
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="p-6 border-t border-border-dark flex justify-end gap-3 bg-surface-dark rounded-b-2xl">
                    <a href="#"
                        class="px-5 py-2.5 rounded-xl border border-border-dark text-gray-300 hover:text-white hover:bg-white/5 transition-all font-medium text-sm">
                        Hủy bỏ
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-background-dark font-bold text-sm shadow-lg shadow-primary/20 transition-all cursor-pointer active:scale-95">
                        Thêm món
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const priceInput = document.getElementById('price-input');
            const priceHidden = document.getElementById('price-value');

            priceInput.addEventListener('input', function () {
                let value = this.value.replace(/\D/g, ''); // Chỉ giữ số
                if (value) {
                    this.value = parseInt(value).toLocaleString('vi-VN');
                    priceHidden.value = value;
                } else {
                    this.value = '';
                    priceHidden.value = '';
                }
            });
        });
        // 1. Định dạng giá khi người dùng gõ (dấu chấm ngàn kiểu Việt Nam)
        document.addEventListener('DOMContentLoaded', function () {
            // Áp dụng cho tất cả modal sửa món hiện tại và tương lai
            document.querySelectorAll('.price-display-input').forEach(function (input) {
                input.addEventListener('input', function () {
                    let value = this.value.replace(/\D/g, ''); // Chỉ giữ số

                    // Tìm hidden input tương ứng trong cùng form
                    let hiddenInput = this.closest('form').querySelector('.price-real-value');

                    if (value) {
                        this.value = parseInt(value).toLocaleString('vi-VN');
                        hiddenInput.value = value;
                    } else {
                        this.value = '';
                        hiddenInput.value = '';
                    }
                });
            });
        });

        // 2. Reset toàn bộ form về trạng thái gốc mỗi khi mở modal sửa món
        window.addEventListener('hashchange', function () {
            const hash = window.location.hash;

            // Chỉ xử lý khi mở modal sửa món
            if (hash.startsWith('#edit-item-modal-')) {
                const modalId = hash.substring(1); // bỏ dấu #
                const modal = document.getElementById(modalId);

                if (modal) {
                    const form = modal.querySelector('form');
                    if (form) {
                        // Reset tất cả input, textarea, select về giá trị gốc
                        form.reset();

                        // Đặc biệt: định dạng lại giá về kiểu Việt Nam (1.250.000)
                        const priceDisplay = modal.querySelector('.price-display-input');
                        const priceHidden = modal.querySelector('.price-real-value');

                        if (priceDisplay && priceHidden && priceHidden.value) {
                            priceDisplay.value = parseInt(priceHidden.value).toLocaleString('vi-VN');
                        } else if (priceDisplay) {
                            priceDisplay.value = '';
                        }
                    }
                }
            }
        });

        // Trường hợp trang load mà hash đã có (ví dụ back từ lịch sử trình duyệt)
        if (window.location.hash.startsWith('#edit-item-modal-')) {
            window.dispatchEvent(new Event('hashchange'));
        }
        document.addEventListener('DOMContentLoaded', function () {
            const categoryLabels = document.querySelectorAll('.category-label');
            const foodCards = document.querySelectorAll('[data-type]');

            categoryLabels.forEach(label => {
                label.addEventListener('click', function () {
                    const filter = this.getAttribute('data-filter');

                    // Cập nhật trạng thái active (visual)
                    categoryLabels.forEach(l => {
                        l.classList.remove('bg-primary/10', 'border-primary/30');
                        l.querySelector('div.w-1').classList.remove('bg-primary');
                        l.querySelector('span.text-sm').classList.remove('text-white');
                    });
                    this.classList.add('bg-primary/10', 'border-primary/30');
                    this.querySelector('div.w-1').classList.add('bg-primary');
                    this.querySelector('span.text-sm').classList.add('text-white');

                    // Lọc card món ăn
                    foodCards.forEach(card => {
                        const type = card.getAttribute('data-type');
                        if (filter === 'all' || type === filter) {
                            card.style.display = 'block';
                            card.classList.remove('hidden');
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const categoryRadios = document.querySelectorAll('input[name="category"]');
            const foodCards = document.querySelectorAll('.group[data-type]');

            categoryRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    const filter = this.value;

                    foodCards.forEach(card => {
                        const type = card.getAttribute('data-type') || 'unknown';

                        if (filter === 'all' || type === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            // Trigger lần đầu khi load trang (để "Tất cả" hoạt động ngay)
            document.querySelector('input[name="category"][checked]')?.dispatchEvent(new Event('change'));
        });

        // Tìm kiếm món ăn realtime
        document.getElementById('search-food')?.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase().trim();

            // Lấy tất cả card món ăn (có class group và data-type)
            document.querySelectorAll('.group[data-type]').forEach(card => {
                const titleElement = card.querySelector('h3');
                const title = titleElement ? titleElement.textContent.toLowerCase() : '';

                // Nếu tên món chứa từ khóa tìm kiếm → hiển thị, ngược lại ẩn
                if (title.includes(searchTerm)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
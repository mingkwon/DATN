<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Quản lý đặt bàn - Restaurant Manager</title>
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
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display overflow-hidden">
    <div id="add-booking-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 animate-fade-in">
        <form id="booking-form" action="{{ url('book_table') }}" method="POST">
            @csrf
            <div
                class="w-full max-w-2xl bg-surface-dark border border-border-dark rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                <div class="px-6 py-5 border-b border-border-dark flex items-center justify-between bg-white/5">
                    <h3 class="text-xl font-bold text-white">Thêm đặt bàn mới</h3>
                    <button type="button" onclick="closeAddModal(); resetBookingForm();"
                        class="text-gray-400 hover:text-white transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="p-6 overflow-y-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Họ tên
                                khách
                                hàng</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">person</span>
                                <input name="name" id="customer-name" type="text" required minlength="2" class="w-full bg-background-dark border border-border-dark text-white text-sm rounded-xl py-3 pl-11 pr-4
              focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all
              placeholder:text-gray-600" placeholder="Nhập tên khách hàng" />

                            </div>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Số điện
                                thoại</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">call</span>
                                <input name="phone" id="phone-number" type="tel" inputmode="numeric" pattern="[0-9]*"
                                    minlength="9" maxlength="11" required inputmode="numeric" class="w-full bg-background-dark border border-border-dark text-white text-sm rounded-xl py-3 pl-11 pr-4
              focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all
              placeholder:text-gray-600" placeholder="Nhập số điện thoại" />

                            </div>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Số lượng
                                khách</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">group</span>
                                <input name="guest" id="guest-count-hidden" type="number" min="1" value="2" required
                                    class="w-full bg-background-dark border border-border-dark text-white text-sm rounded-xl py-3 pl-11 pr-4
              focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" />

                            </div>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Ngày
                                đặt</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">calendar_today</span>
                                <input name="date" id="booking-date" type="date" required
                                    min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" class="w-full bg-background-dark border border-border-dark text-white text-sm rounded-xl py-3 pl-11 pr-4
              focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all
              [color-scheme:dark]" />

                            </div>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Thời
                                gian</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">schedule</span>
                                <input name="time" id="booking-time" type="time" required min="08:00" max="22:00" class="w-full bg-background-dark border border-border-dark text-white text-sm rounded-xl py-3 pl-11 pr-4
              focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all
              [color-scheme:dark]" />

                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">
                                Vị trí mong muốn
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                <!-- TIÊU CHUẨN -->
                                <label class="cursor-pointer relative group">
                                    <input checked class="peer sr-only" name="table" type="radio" value="Tiêu chuẩn" />
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
                                    <input class="peer sr-only" name="table" type="radio" value="Gần cửa sổ" />
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
                                    <input class="peer sr-only" name="table" type="radio" value="Riêng tư" />
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
                                    <input class="peer sr-only" name="table" type="radio" value="Ngoài trời" />
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
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Ghi
                                chú</label>
                            <textarea name="note"
                                class="w-full bg-background-dark border border-border-dark text-white text-sm rounded-xl py-3 px-4 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all placeholder:text-gray-600 resize-none"
                                placeholder="Ghi chú thêm (dị ứng, trang trí, v.v.)" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-5 border-t border-border-dark bg-white/5 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeAddModal(); resetBookingForm();"
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
    <div id="assign-table"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 animate-fade-in">
        <div class="absolute inset-0 bg-background-dark/80 backdrop-blur-md"></div>
        <div
            class="relative w-full max-w-4xl bg-surface-dark border border-border-dark rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-border-dark flex items-center justify-between bg-white/5">
                <div>
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">table_bar</span>
                        Xác nhận &amp; Gán bàn
                    </h2>
                    <p class="text-gray-400 text-sm mt-1">Vui lòng chọn bàn trống phù hợp với yêu cầu của khách.
                    </p>
                </div>
                <button type="button" onclick="closeAssignModal();"
                    class="size-10 rounded-full hover:bg-white/10 flex items-center justify-center text-gray-400 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-8">
                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-background-dark/50 border border-border-dark rounded-2xl">
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Khách hàng</span>
                        <div class="flex items-center gap-2">
                            <div
                                class="size-8 rounded-full bg-purple-500 flex items-center justify-center text-white text-xs font-bold">
                                L</div>
                            <span class="text-sm font-semibold text-white">Lê Thị Lan</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Thời gian
                            đặt</span>
                        <div class="flex items-center gap-2 text-white">
                            <span class="material-symbols-outlined text-gray-500 text-lg">schedule</span>
                            <span class="text-sm font-semibold">19:00 - Hôm nay</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Vị trí mong
                            muốn</span>
                        <div class="flex items-center gap-2">
                            <span
                                class="px-2 py-0.5 rounded-md bg-yellow-500/10 border border-yellow-500/30 text-[10px] text-yellow-500 font-bold uppercase">Gần
                                cửa sổ</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-2 border-b border-border-dark pb-px overflow-x-auto">
                        <button
                            class="px-4 py-2 text-sm font-bold text-primary border-b-2 border-primary whitespace-nowrap">Tiêu
                            chuẩn</button>
                        <button
                            class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-white transition-colors whitespace-nowrap">Riêng
                            tư</button>
                        <button
                            class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-white transition-colors whitespace-nowrap flex items-center gap-1">
                            Gần cửa sổ
                            <span class="size-1.5 rounded-full bg-primary"></span>
                        </button>
                        <button
                            class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-white transition-colors whitespace-nowrap">Ngoài
                            trời</button>
                    </div>
                    <div class="flex items-center gap-6 text-[10px] font-bold uppercase tracking-widest text-gray-500">
                        <div class="flex items-center gap-2"><span
                                class="size-3 rounded-sm bg-primary/20 border border-primary/50"></span> Trống
                        </div>
                        <div class="flex items-center gap-2"><span
                                class="size-3 rounded-sm bg-yellow-500/20 border border-yellow-500/50"></span>
                            Đang
                            dùng</div>
                        <div class="flex items-center gap-2"><span
                                class="size-3 rounded-sm bg-blue-500/20 border border-blue-500/50"></span> Đã
                            đặt
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        <div
                            class="group cursor-pointer relative flex flex-col items-center justify-center gap-3 p-5 rounded-2xl bg-primary/5 border border-primary/20 hover:border-primary hover:bg-primary/10 transition-all">
                            <span class="material-symbols-outlined text-primary text-3xl">table_bar</span>
                            <div class="text-center">
                                <p class="text-white text-sm font-bold">Bàn 01</p>
                                <p class="text-primary text-[10px] font-medium">4 Chỗ</p>
                            </div>
                        </div>
                        <div
                            class="opacity-60 cursor-not-allowed flex flex-col items-center justify-center gap-3 p-5 rounded-2xl bg-yellow-500/5 border border-yellow-500/20">
                            <span class="material-symbols-outlined text-yellow-500 text-3xl">group</span>
                            <div class="text-center">
                                <p class="text-white text-sm font-bold">Bàn 03</p>
                                <p class="text-yellow-500 text-[10px] font-medium">Đang dùng</p>
                            </div>
                        </div>
                        <div
                            class="opacity-60 cursor-not-allowed flex flex-col items-center justify-center gap-3 p-5 rounded-2xl bg-blue-500/5 border border-blue-500/20">
                            <span class="material-symbols-outlined text-blue-500 text-3xl">event_seat</span>
                            <div class="text-center">
                                <p class="text-white text-sm font-bold">Bàn 04</p>
                                <p class="text-blue-500 text-[10px] font-medium">Đã đặt</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-border-dark bg-background-dark/80 flex items-center justify-end gap-3">
                <button type="button" onclick="closeAssignModal();"
                    class="px-6 py-2.5 rounded-xl border border-border-dark text-gray-300 font-bold text-sm hover:bg-white/5 transition-colors">
                    Hủy
                </button>
                <button id="confirm-assign-btn"
                    class="px-8 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-background-dark font-black text-sm shadow-[0_0_20px_rgba(25,230,94,0.3)] transition-all active:scale-95">
                    Xác nhận gán bàn
                </button>
            </div>
        </div>
    </div>
    <div aria-labelledby="modal-title" aria-modal="true" class="fixed inset-0 z-50 hidden" id="delete-modal"
        role="dialog">
        <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-surface-dark border border-border-dark text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-500/10 sm:mx-0 sm:h-10 sm:w-10">
                                <span class="material-symbols-outlined text-red-500">warning</span>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-semibold leading-6 text-white" id="modal-title">Xác nhận xóa
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-400">Bạn muốn xóa đặt bàn này? Hành động này không thể
                                        hoàn tác và dữ liệu sẽ bị xóa vĩnh viễn khỏi hệ thống.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-black/20 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <a id="confirm-delete-btn" href="#"
                            class="inline-flex w-full justify-center rounded-xl bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition-colors">
                            Xóa
                        </a>
                        <button
                            class="mt-3 inline-flex w-full justify-center rounded-xl bg-surface-dark px-3 py-2 text-sm font-semibold text-gray-300 ring-1 ring-inset ring-gray-600 hover:bg-white/5 sm:mt-0 sm:w-auto transition-colors"
                            onclick="document.getElementById('delete-modal').classList.add('hidden')"
                            type="button">Hủy</button>
                    </div>
                </div>
            </div>
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
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('add_food') }}">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white">restaurant</span>
                        <p class="text-gray-300 group-hover:text-white text-sm font-medium">Quản lý thực đơn</p>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 border border-primary/20"
                        href="#">
                        <span class="material-symbols-outlined text-primary fill-1">receipt_long</span>
                        <p class="text-primary text-sm font-bold">Danh sách đặt bàn</p>
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
                                        Danh sách đặt bàn</h1>
                                </div>
                                <p class="text-gray-400 text-base font-normal max-w-2xl">
                                    Theo dõi và quản lý danh sách đặt bàn, sắp xếp chỗ ngồi và trạng thái khách hàng.
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
                                <button onclick="openAddModal()"
                                    class="flex items-center gap-2 bg-primary hover:bg-primary-dark active:scale-95 transition-all text-background-dark px-5 py-3 rounded-xl font-bold text-sm shadow-[0_0_20px_rgba(25,230,94,0.3)]">
                                    <span class="material-symbols-outlined text-xl">calendar_add_on</span>
                                    <span>Thêm đặt bàn mới</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                        <div class="relative w-full md:w-96 group">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-primary transition-colors">search</span>
                            <input id="search-input" name="search" value="{{ request('search') }}"
                                class="w-full bg-surface-dark border border-border-dark text-white text-sm rounded-xl py-3 pl-10 pr-12 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all placeholder:text-gray-600"
                                placeholder="Tìm tên khách hàng, SĐT..." type="text" />
                            @if(request('search'))
                                <button type="button" onclick="clearSearch()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition-colors">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            @endif
                        </div>

                        <script>
                            const searchInput = document.getElementById('search-input');

                            searchInput.addEventListener('keypress', function (e) {
                                if (e.key === 'Enter') {
                                    e.preventDefault();
                                    applySearch();
                                }
                            });

                            // Optional: Tìm khi blur (mất focus) - nếu muốn tự động tìm khi gõ xong
                            // searchInput.addEventListener('blur', applySearch);

                            function applySearch() {
                                const url = new URL(window.location);
                                const searchValue = searchInput.value.trim();

                                if (searchValue) {
                                    url.searchParams.set('search', searchValue);
                                } else {
                                    url.searchParams.delete('search');
                                }

                                // Reset về trang 1 khi search mới
                                url.searchParams.delete('page');

                                window.location = url;
                            }

                            function clearSearch() {
                                const url = new URL(window.location);
                                url.searchParams.delete('search');
                                url.searchParams.delete('page');
                                window.location = url;
                            }
                        </script>
                        <div>
                            @if(session()->has('message'))
                                <div id="session-alert"
                                    class="flex items-center gap-2 px-4 py-3 rounded-lg
                                                                                                                                                                                                            bg-primary/10 border border-primary/25
                                                                                                                                                                                                            text-primary text-xs font-semibold
                                                                                                                                                                                                            shadow-md shadow-primary/15
                                                                                                                                                                                                            animate-fade-in relative">

                                    <span class="material-symbols-outlined text-primary text-base mt-0.5">
                                        check_circle
                                    </span>

                                    <span class="flex-1 leading-relaxed">
                                        {{ session()->get('message') }}
                                    </span>

                                    <!-- Close button -->
                                    <button type="button" aria-label="Đóng thông báo" onclick="closeSessionAlert()"
                                        class="ml-1 flex items-center justify-center
                                                                                                                                                                                                                   w-7 h-7 rounded-full
                                                                                                                                                                                                                   text-primary/70 hover:text-primary
                                                                                                                                                                                                                   hover:bg-primary/20
                                                                                                                                                                                                                   transition">
                                        <span class="material-symbols-outlined text-sm">close</span>
                                    </button>
                                </div>
                            @endif
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
                            }, 4000);
                        </script>
                        <div class="flex items-center gap-3 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                            <div class="relative min-w-[150px]">
                                <select id="period-filter" class="
            w-full appearance-none !bg-none bg-surface-dark border border-border-dark 
            text-white text-sm rounded-xl py-3 pl-4 pr-10 
            focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary cursor-pointer
        ">
                                    <option value="">Tất cả ngày</option>
                                    <option value="today" {{ request('period') === 'today' ? 'selected' : '' }}>Hôm nay
                                    </option>
                                    <option value="tomorrow" {{ request('period') === 'tomorrow' ? 'selected' : '' }}>Ngày
                                        mai</option>
                                    <option value="this-week" {{ request('period') === 'this-week' ? 'selected' : '' }}>
                                        Tuần này</option>
                                    <option value="this-month" {{ request('period') === 'this-month' ? 'selected' : '' }}>
                                        Tháng này</option>
                                </select>
                                <span
                                    class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none">
                                    calendar_month
                                </span>
                            </div>

                            <div class="relative min-w-[180px]">
                                <select id="status-filter" class="
            w-full appearance-none !bg-none bg-surface-dark border border-border-dark 
            text-white text-sm rounded-xl py-3 pl-4 pr-10 
            focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary cursor-pointer
        ">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="Chờ xác nhận" {{ request('status') === 'Chờ xác nhận' ? 'selected' : '' }}>Chờ xác nhận</option>
                                    <option value="Đã xác nhận" {{ request('status') === 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                                    <option value="Chờ khách" {{ request('status') === 'Chờ khách' ? 'selected' : '' }}>
                                        Chờ khách</option>
                                    <option value="Đã quá hạn" {{ request('status') === 'Đã quá hạn' ? 'selected' : '' }}>
                                        Đã quá hạn</option>
                                    <option value="Đã hủy" {{ request('status') === 'Đã hủy' ? 'selected' : '' }}>Đã hủy
                                    </option>
                                </select>
                                <span
                                    class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none">
                                    filter_list
                                </span>
                            </div>
                        </div>

                        <!-- JS để reload trang khi thay đổi filter (giữ page nếu có) -->
                        <script>
                            const periodSelect = document.getElementById('period-filter');
                            const statusSelect = document.getElementById('status-filter');

                            function applyFilters() {
                                const url = new URL(window.location);
                                const period = periodSelect.value;
                                const status = statusSelect.value;

                                if (period) {
                                    url.searchParams.set('period', period);
                                } else {
                                    url.searchParams.delete('period');
                                }

                                if (status) {
                                    url.searchParams.set('status', status);
                                } else {
                                    url.searchParams.delete('status');
                                }

                                // Reset về trang 1 khi filter thay đổi (tránh hiển thị trang cũ không còn dữ liệu)
                                url.searchParams.delete('page');

                                window.location = url;
                            }

                            periodSelect.addEventListener('change', applyFilters);
                            statusSelect.addEventListener('change', applyFilters);
                        </script>
                    </div>
                    <div
                        class="bg-surface-dark border border-border-dark rounded-2xl overflow-hidden shadow-xl shadow-black/20">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse table-fixed">
                                <thead>
                                    <tr class="border-b border-border-dark bg-white/5">
                                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                            Khách hàng</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                            Số điện thoại</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                            Ngày đặt</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                            Thời gian</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                            Bàn</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                            Số khách</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                            Ghi chú</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                            Trạng thái</th>
                                        <th
                                            class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">
                                            Hành động</th>
                                    </tr>
                                </thead>

                                @foreach($data as $booking)
                                    <tbody class="divide-y divide-border-dark">
                                        <tr class="group hover:bg-white/5 transition-colors">
                                            <td class="px-6 py-4">
                                                <p class="text-white text-sm font-semibold">{{ $booking->name }}</p>
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-300">{{ $booking->phone }}</td>

                                            <td class="px-6 py-4 text-sm text-gray-300">
                                                {{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y') }}
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-300 font-medium">{{ $booking->time }}
                                            </td>

                                            {{-- TABLE TYPE --}}
                                            <td class="px-6 py-4">
                                                @php
                                                    $tableIcons = [
                                                        'Tiêu chuẩn' => 'deck',
                                                        'Gần cửa sổ' => 'window',
                                                        'Riêng tư' => 'privacy_tip',
                                                        'Ngoài trời' => 'yard',
                                                    ];
                                                    $tableIcon = $tableIcons[$booking->table] ?? 'table_restaurant';
                                                @endphp

                                                <div class="flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-gray-300 text-lg">
                                                        {{ $tableIcon }}
                                                    </span>
                                                    <span class="text-sm text-gray-300">{{ $booking->table }}</span>
                                                </div>
                                            </td>

                                            <!-- Số khách -->
                                            <td class="px-6 py-4 text-sm text-gray-300 font-medium">{{ $booking->guest }}
                                                người
                                            </td>

                                            {{-- NOTE --}}
                                            <td class="px-6 py-4 text-sm text-gray-400 italic align-middle">
                                                <div class="break-words leading-relaxed">
                                                    {{ $booking->note ?? '--' }}
                                                </div>
                                            </td>

                                            {{-- STATUS --}}
                                            <td class="px-6 py-4">
                                                @php
                                                    $status = $booking->display_status;
                                                    $statusDotClass = match ($status) {
                                                        'Chờ xác nhận' => 'size-1.5 rounded-full bg-yellow-500 animate-pulse',
                                                        'Đã xác nhận' => 'size-1.5 rounded-full bg-primary',
                                                        'Chờ khách' => 'size-1.5 rounded-full bg-primary',
                                                        'Đã quá hạn' => 'size-1.5 rounded-full bg-red-500',
                                                        'Đã hủy' => 'size-1.5 rounded-full bg-red-500',
                                                        default => 'size-1.5 rounded-full bg-gray-400',
                                                    };
                                                @endphp

                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-white/5 border border-white/10 text-white">
                                                    <span class="{{ $statusDotClass }}"></span>
                                                    {{ $status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                @php
                                                    $status = $booking->display_status;
                                                @endphp

                                                <div class="flex items-center justify-end gap-2">

                                                    {{-- ❌ CHỈ ĐƯỢC XÓA --}}
                                                    @if(in_array($status, ['Đã quá hạn', 'Đã hủy']))

                                                        <button
                                                            class="p-2 rounded-lg text-red-500 hover:bg-red-500/10 transition-all"
                                                            onclick="openDeleteModal({{ $booking->id }})" title="Xóa">
                                                            <span class="material-symbols-outlined text-lg">delete</span>
                                                        </button>

                                                        {{-- ✅ CÒN LẠI: ĐẦY ĐỦ HÀNH ĐỘNG --}}
                                                    @else

                                                        {{-- XÁC NHẬN (chỉ khi chờ xác nhận) --}}
                                                        @if($booking->status === 'Chờ xác nhận')
                                                            <button onclick="openAssignModal({{ $booking->id }})"
                                                                class="p-2 rounded-lg text-primary hover:bg-primary/10 transition-all"
                                                                title="Xác nhận">
                                                                <span class="material-symbols-outlined text-lg">check</span>
                                                            </button>
                                                        @endif

                                                        {{-- HỦY --}}
                                                        <a href="{{ url('reject_book', $booking->id) }}"
                                                            class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-all"
                                                            title="Hủy bàn">
                                                            <span class="material-symbols-outlined text-lg">close</span>
                                                        </a>

                                                        {{-- XÓA --}}
                                                        <button
                                                            class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-all"
                                                            onclick="openDeleteModal({{ $booking->id }})" title="Xóa">
                                                            <span class="material-symbols-outlined text-lg">delete</span>
                                                        </button>

                                                    @endif
                                                </div>
                                            </td>



                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div
                            class="px-6 py-4 border-t border-border-dark flex flex-col sm:flex-row items-center justify-between gap-4">
                            <!-- Thông tin hiển thị -->
                            <p class="text-sm text-gray-400 order-2 sm:order-1">
                                Hiển thị <span
                                    class="text-white font-medium">{{ $data->firstItem() }}-{{ $data->lastItem() }}</span>
                                trong số <span class="text-white font-medium">{{ $data->total() }}</span> đặt bàn
                            </p>

                            <!-- Phân trang: left - số trang - right -->
                            <div class="flex items-center gap-3 order-1 sm:order-2">
                                <!-- Nút Previous -->
                                @if ($data->onFirstPage())
                                    <button
                                        class="p-2 rounded-lg bg-surface-dark border border-border-dark text-gray-400 cursor-not-allowed"
                                        disabled>
                                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                                    </button>
                                @else
                                    <a href="{{ $data->previousPageUrl() }}"
                                        class="p-2 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:border-gray-500 transition-all">
                                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                                    </a>
                                @endif

                                <!-- Số trang ở giữa (chỉ hiển thị 5 trang gần nhất để gọn) -->
                                <div class="flex items-center gap-1 text-sm text-gray-300">
                                    @if ($data->lastPage() > 1)
                                        <!-- Trang đầu nếu không ở trang 1-2 -->
                                        @if ($data->currentPage() > 3)
                                            <a href="{{ $data->url(1) }}"
                                                class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">1</a>
                                            <span class="px-1">...</span>
                                        @endif

                                        <!-- Các trang gần hiện tại -->
                                        @foreach (range(max(1, $data->currentPage() - 2), min($data->lastPage(), $data->currentPage() + 2)) as $page)
                                            @if ($page == $data->currentPage())
                                                <span
                                                    class="px-3 py-1.5 rounded-lg bg-primary/20 text-primary font-bold">{{ $page }}</span>
                                            @else
                                                <a href="{{ $data->url($page) }}"
                                                    class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        <!-- Trang cuối nếu không ở trang cuối -->
                                        @if ($data->currentPage() < $data->lastPage() - 2)
                                            <span class="px-1">...</span>
                                            <a href="{{ $data->url($data->lastPage()) }}"
                                                class="px-3 py-1.5 rounded-lg hover:bg-white/10 transition">{{ $data->lastPage() }}</a>
                                        @endif
                                    @endif
                                </div>

                                <!-- Nút Next -->
                                @if ($data->hasMorePages())
                                    <a href="{{ $data->nextPageUrl() }}"
                                        class="p-2 rounded-lg bg-surface-dark border border-border-dark text-gray-400 hover:text-white hover:border-gray-500 transition-all">
                                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                                    </a>
                                @else
                                    <button
                                        class="p-2 rounded-lg bg-surface-dark border border-border-dark text-gray-400 cursor-not-allowed"
                                        disabled>
                                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Thêm đặt bàn mới 
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

        // Gán bàn
        let currentBookingId = null;

        function openAssignModal(bookingId) {
            currentBookingId = bookingId;  // Lưu ID booking để dùng sau
            document.getElementById('assign-table').classList.remove('hidden');
            document.getElementById('assign-table').classList.add('flex');

            // Optional: Có thể load thêm thông tin booking vào modal nếu cần (dùng AJAX sau này)
            console.log('Mở modal gán bàn cho booking ID:', bookingId);
        }

        function closeAssignModal() {
            document.getElementById('assign-table').classList.add('hidden');
            document.getElementById('assign-table').classList.remove('flex');
            currentBookingId = null; // Reset
        }

        // Xử lý click nút "Xác nhận gán bàn" trong modal
        document.getElementById('confirm-assign-btn').addEventListener('click', function () {
            if (currentBookingId) {
                // Chuyển hướng đến route approve_book
                window.location.href = `/approve_book/${currentBookingId}`;
            } else {
                alert('Không tìm thấy ID booking!');
            }
        });
    </script>
    <!-- Nút thêm mới -->
    <script>
        const dateInput = document.getElementById('booking-date');
        const timeInput = document.getElementById('booking-time');
        const confirmBtn = document.getElementById('confirm-button');

        function isValidPhone(phone) {
            // chỉ số, 9–11 ký tự
            return /^\d{9,11}$/.test(phone);
        }

        function isValidForm() {
            if (!dateInput.value || !timeInput.value) return false;

            const phone = phoneInput.value.trim();
            if (!isValidPhone(phone)) return false;

            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            const selectedDate = new Date(dateInput.value + 'T00:00');
            const [h, m] = timeInput.value.split(':');
            const selectedDateTime = new Date(dateInput.value);
            selectedDateTime.setHours(h, m, 0, 0);

            // ❌ Ngày < hôm nay
            if (selectedDate < today) return false;

            // ❌ Ngày = hôm nay nhưng giờ < hiện tại
            if (selectedDate.getTime() === today.getTime() && selectedDateTime < now) {
                return false;
            }

            return true;
        }

        function toggleSubmitButton() {
            confirmBtn.disabled = !isValidForm();
            confirmBtn.classList.toggle('opacity-50', confirmBtn.disabled);
            confirmBtn.classList.toggle('cursor-not-allowed', confirmBtn.disabled);
        }

        dateInput.addEventListener('change', toggleSubmitButton);
        timeInput.addEventListener('change', toggleSubmitButton);

        // Reset modal 
        const bookingForm = document.getElementById('booking-form');
        const modal = document.getElementById('add-booking-modal');

        function resetBookingForm() {
            bookingForm.reset();

            // reset trạng thái nút submit (nếu có style disable)
            confirmBtn.disabled = false;
            confirmBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }

        // Disable ngay khi mở modal
        // document.getElementById('add-booking-modal')
        //     .addEventListener('transitionend', toggleSubmitButton);

        const phoneInput = document.getElementById('phone-number');
        phoneInput.addEventListener('input', function () {
            // Chỉ giữ lại số
            this.value = this.value.replace(/\D/g, '');

            // Giới hạn 11 ký tự
            if (this.value.length > 11) {
                this.value = this.value.slice(0, 11);
            }
        });
    </script>


</body>

</html>
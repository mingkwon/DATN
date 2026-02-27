<!DOCTYPE html>
<html class="dark" lang="vi">

<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Restaurant AI - Báo cáo doanh thu</title>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #2A4034;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #19e65e;
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
                        href="">
                        <span class="material-symbols-outlined text-primary fill-1">dashboard</span>
                        <p class="text-primary text-sm font-bold">Tổng quan</p>
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
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group"
                        href="{{ url('setting') }}">
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
        <main class="flex-1 flex flex-col h-full overflow-hidden relative">
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
            <div class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8 xl:p-10">
                <div class="space-y-6">
                    <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-6">
                        <div>
                            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Báo cáo doanh
                                thu
                            </h1>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="relative group">
                                <!-- Nút hiển thị khoảng thời gian đã chọn -->
                                <button id="date-range-btn"
                                    class="flex items-center bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] rounded-xl overflow-hidden h-10 shadow-sm hover:border-primary/50 transition-all focus:outline-none focus:ring-2 focus:ring-primary/30"
                                    aria-expanded="false">
                                    <div class="flex items-center px-4 border-r border-slate-200 dark:border-[#29382e]">
                                        <span
                                            class="material-symbols-outlined text-[18px] text-slate-400 dark:text-[#9db8a6] mr-2">calendar_today</span>
                                        <div class="flex flex-col items-start">
                                            <span
                                                class="text-[10px] uppercase font-bold text-slate-400 dark:text-[#9db8a6]/60 leading-none mb-0.5">Từ
                                                ngày</span>
                                            <span id="start-date-display"
                                                class="text-xs font-bold text-slate-900 dark:text-white">01/10/2023</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center px-4">
                                        <span
                                            class="material-symbols-outlined text-[18px] text-slate-400 dark:text-[#9db8a6] mr-2">event</span>
                                        <div class="flex flex-col items-start">
                                            <span
                                                class="text-[10px] uppercase font-bold text-slate-400 dark:text-[#9db8a6]/60 leading-none mb-0.5">Đến
                                                ngày</span>
                                            <span id="end-date-display"
                                                class="text-xs font-bold text-slate-900 dark:text-white">31/10/2023</span>
                                        </div>
                                    </div>
                                    <span
                                        class="material-symbols-outlined ml-2 mr-3 text-slate-400 group-hover:text-primary transition-colors">expand_more</span>
                                </button>

                                <!-- Dropdown chọn ngày -->
                                <div id="date-picker-dropdown"
                                    class="absolute top-full left-0 mt-2 z-50 hidden w-[320px] bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] rounded-xl shadow-2xl overflow-hidden">

                                    <div class="p-4 border-b border-slate-200 dark:border-[#29382e]">
                                        <div class="grid grid-cols-2 gap-4">
                                            <!-- Từ ngày -->
                                            <div>
                                                <label
                                                    class="block text-xs font-bold text-slate-500 dark:text-[#9db8a6]/80 mb-1.5">Từ
                                                    ngày</label>
                                                <input type="date" id="start-date-input"
                                                    class="date-picker-input w-full h-10 px-3 rounded-lg border border-slate-200 dark:border-[#29382e] bg-transparent text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none" />
                                            </div>

                                            <!-- Đến ngày -->
                                            <div>
                                                <label
                                                    class="block text-xs font-bold text-slate-500 dark:text-[#9db8a6]/80 mb-1.5">Đến
                                                    ngày</label>
                                                <input type="date" id="end-date-input"
                                                    class="date-picker-input w-full h-10 px-3 rounded-lg border border-slate-200 dark:border-[#29382e] bg-transparent text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Phím tắt nhanh -->
                                    <div class="p-3 border-b border-slate-200 dark:border-[#29382e] text-sm">
                                        <p
                                            class="text-xs font-bold text-slate-400 dark:text-[#9db8a6]/70 uppercase mb-2">
                                            Phím tắt</p>
                                        <div class="grid grid-cols-2 gap-2">
                                            <button
                                                class="quick-range px-3 py-2 text-left text-xs rounded-lg hover:bg-slate-100 dark:hover:bg-[#29382e] transition bg-primary/10 text-primary"
                                                data-days="0">Hôm nay</button>
                                            <button
                                                class="quick-range px-3 py-2 text-left text-xs rounded-lg hover:bg-slate-100 dark:hover:bg-[#29382e] transition"
                                                data-days="1">Hôm qua</button>
                                            <button
                                                class="quick-range px-3 py-2 text-left text-xs rounded-lg hover:bg-slate-100 dark:hover:bg-[#29382e] transition"
                                                data-days="7">7 ngày qua</button>
                                            <button
                                                class="quick-range px-3 py-2 text-left text-xs rounded-lg hover:bg-slate-100 dark:hover:bg-[#29382e] transition"
                                                data-days="30">30 ngày qua</button>
                                            <button
                                                class="quick-range col-span-2 px-3 py-2 text-left text-xs rounded-lg hover:bg-slate-100 dark:hover:bg-[#29382e] transition"
                                                data-days="this-month">Tháng này</button>
                                        </div>
                                    </div>

                                    <!-- Nút hành động -->
                                    <div class="p-4 flex gap-3">
                                        <button id="cancel-date"
                                            class="flex-1 py-2.5 text-sm font-medium rounded-lg border border-slate-200 dark:border-[#29382e] hover:bg-slate-50 dark:hover:bg-[#29382e] transition">Hủy</button>
                                        <button id="apply-date"
                                            class="flex-1 py-2.5 text-sm font-bold rounded-lg bg-primary text-background-dark hover:brightness-110 transition">Áp
                                            dụng</button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative group">
                                <button
                                    class="size-11 rounded-xl bg-surface-dark border border-border-dark flex items-center justify-center text-gray-400 hover:text-white hover:border-gray-500 transition-all">
                                    <span class="material-symbols-outlined">notifications</span>
                                    <span
                                        class="absolute top-2.5 right-3 size-2 bg-red-500 rounded-full border-2 border-surface-dark"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <script>
                        function refreshDatePicker(inputId, newValue) {
                            const oldInput = document.getElementById(inputId);
                            if (!oldInput) return;

                            const parent = oldInput.parentNode;

                            // Tạo input mới
                            const newInput = document.createElement('input');
                            newInput.type = 'date';
                            newInput.id = inputId;
                            newInput.className = oldInput.className;

                            // Disable cache picker bằng cách set min/max tạm thời
                            newInput.min = newInput.max = newValue; // force picker reset

                            // Replace
                            parent.replaceChild(newInput, oldInput);

                            // Cập nhật biến global
                            if (inputId === 'start-date-input') startInput = newInput;
                            if (inputId === 'end-date-input') endInput = newInput;

                            // Force reset value và redraw picker
                            setTimeout(() => {
                                newInput.value = newValue;
                                newInput.min = ''; // xóa min/max để picker bình thường lại
                                newInput.max = '';
                                newInput.dispatchEvent(new Event('input'));
                                newInput.dispatchEvent(new Event('change'));
                                newInput.focus();
                                setTimeout(() => newInput.blur(), 10);
                            }, 0);
                        }

                        const dateBtn = document.getElementById('date-range-btn');
                        const dropdown = document.getElementById('date-picker-dropdown');
                        let startInput = document.getElementById('start-date-input');
                        let endInput = document.getElementById('end-date-input');
                        const startDisplay = document.getElementById('start-date-display');
                        const endDisplay = document.getElementById('end-date-display');
                        const applyBtn = document.getElementById('apply-date');
                        const cancelBtn = document.getElementById('cancel-date');

                        // === THÊM PHẦN NÀY: Khởi tạo mặc định là hôm nay khi load trang ===
                        document.addEventListener('DOMContentLoaded', () => {
                            const today = new Date();
                            const todayISO = today.toISOString().split('T')[0]; // định dạng YYYY-MM-DD cho input type="date"

                            // Set giá trị cho input ẩn (type="date")
                            startInput.value = todayISO;
                            endInput.value = todayISO;

                            // Cập nhật hiển thị trên nút (định dạng dd/mm/yyyy)
                            const formattedToday = today.toLocaleDateString('vi-VN', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            });

                            startDisplay.textContent = formattedToday;
                            endDisplay.textContent = formattedToday;

                            // Optional: Highlight nút "Hôm nay" trong phím tắt
                            const todayBtn = document.querySelector('.quick-range[data-days="0"]');
                            if (todayBtn) {
                                todayBtn.classList.add('bg-primary/10', 'text-primary');
                            }
                        });

                        document.addEventListener('click', (e) => {
                            if (!dateBtn.contains(e.target) && !dropdown.contains(e.target)) {
                                dropdown.classList.add('hidden');
                            }
                        });

                        // Áp dụng ngày (giữ nguyên)
                        applyBtn.addEventListener('click', () => {
                            const start = new Date(startInput.value);
                            const end = new Date(endInput.value);

                            if (start > end) {
                                alert("Ngày bắt đầu không được lớn hơn ngày kết thúc!");
                                return;
                            }

                            startDisplay.textContent = start.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });
                            endDisplay.textContent = end.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });

                            dropdown.classList.add('hidden');
                            console.log("Khoảng thời gian mới:", startInput.value, "→", endInput.value);
                            loadAIInsight();
                        });

                        cancelBtn.addEventListener('click', () => {
                            dropdown.classList.add('hidden');
                        });

                        // Xử lý phím tắt - luôn dùng ngày hiện tại thực tế
                        const quickButtons = document.querySelectorAll('.quick-range');

                        quickButtons.forEach(btn => {
                            btn.addEventListener('click', () => {
                                quickButtons.forEach(b => b.classList.remove('bg-primary/10', 'text-primary'));
                                btn.classList.add('bg-primary/10', 'text-primary');

                                const days = btn.dataset.days;
                                const now = new Date(); // Lấy ngày mới mỗi lần click
                                let start = new Date(now);
                                let end = new Date(now);

                                if (days === '0') {
                                    start = now;
                                    end = now;
                                } else if (days === '1') {
                                    start.setDate(now.getDate() - 1);
                                    end.setDate(now.getDate() - 1);
                                } else if (days === '7') {
                                    start.setDate(now.getDate() - 7);
                                    end = now;
                                } else if (days === '30') {
                                    start.setDate(now.getDate() - 30);
                                    end = now;
                                } else if (days === 'this-month') {
                                    start = new Date(now.getFullYear(), now.getMonth(), 1);
                                    end = now;
                                }

                                const startISO = start.toISOString().split('T')[0];
                                const endISO = end.toISOString().split('T')[0];

                                // Refresh picker để UI hiển thị đúng
                                refreshDatePicker('start-date-input', startISO);
                                refreshDatePicker('end-date-input', endISO);

                                startDisplay.textContent = start.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });
                                endDisplay.textContent = end.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });

                                fetchReports(startISO, endISO);
                                setTimeout(() => {
                                    loadAIInsight();
                                }, 50);

                                dropdown.classList.add('hidden');
                            });
                        });

                        // Khởi tạo mặc định
                        document.addEventListener('DOMContentLoaded', () => {
                            const now = new Date();
                            const nowISO = now.toISOString().split('T')[0];

                            refreshDatePicker('start-date-input', nowISO);
                            refreshDatePicker('end-date-input', nowISO);

                            const formattedNow = now.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });

                            startDisplay.textContent = formattedNow;
                            endDisplay.textContent = formattedNow;

                            const todayBtn = document.querySelector('.quick-range[data-days="0"]');
                            if (todayBtn) todayBtn.classList.add('bg-primary/10', 'text-primary');

                            fetchReports(nowISO, nowISO);
                        });

                        // Khi mở dropdown, refresh picker lần nữa (đề phòng)
                        dateBtn.addEventListener('click', () => {
                            dropdown.classList.toggle('hidden');
                            dateBtn.setAttribute('aria-expanded', !dropdown.classList.contains('hidden'));

                            if (!dropdown.classList.contains('hidden')) {
                                const now = new Date();
                                const nowISO = now.toISOString().split('T')[0];

                                refreshDatePicker('start-date-input', startInput.value || nowISO);
                                refreshDatePicker('end-date-input', endInput.value || nowISO);

                                // Force thêm lần nữa sau 100ms (để browser kịp redraw)
                                setTimeout(() => {
                                    refreshDatePicker('start-date-input', startInput.value || nowISO);
                                    refreshDatePicker('end-date-input', endInput.value || nowISO);
                                }, 100);
                            }
                        });
                        // Hàm lấy dữ liệu mới từ server khi áp dụng bộ lọc
                        function fetchReports(startDate, endDate) {
                            fetch(`/admin/dashboard?start_date=${startDate}&end_date=${endDate}`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json'
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    // Cập nhật các chỉ số chính
                                    document.getElementById('total-revenue').textContent = data.tongDoanhThu || '0đ';
                                    document.getElementById('total-orders').textContent = data.tongDonHang || '0';
                                    document.getElementById('cancel-rate').textContent = data.tyLeHuyDon || '0.00%';
                                    document.getElementById('avg-order-value').textContent = data.giaTriTbDon || '0đ';

                                    // Cập nhật tiêu đề biểu đồ theo tháng của end_date
                                    let endDateSafe = endDate || new Date().toISOString().split('T')[0]; // fallback hôm nay nếu rỗng
                                    const end = new Date(endDateSafe);
                                    const monthYear = isNaN(end.getTime())
                                        ? new Date().toLocaleDateString('vi-VN', { month: '2-digit', year: 'numeric' })
                                        : end.toLocaleDateString('vi-VN', { month: '2-digit', year: 'numeric' });
                                    document.getElementById('chart-title').textContent = `Diễn biến doanh thu tháng ${monthYear}`;

                                    // Cập nhật biểu đồ
                                    if (data.dailyDates && data.dailyRevenue) {
                                        renderRevenueChart(data.dailyDates, data.dailyRevenue);
                                    }
                                })
                                .catch(error => console.error('Lỗi:', error));
                        }

                        // Khi click "Áp dụng"
                        applyBtn.addEventListener('click', () => {
                            const start = new Date(startInput.value);
                            const end = new Date(endInput.value);

                            if (start > end) {
                                alert("Ngày bắt đầu không được lớn hơn ngày kết thúc!");
                                return;
                            }

                            startDisplay.textContent = start.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });
                            endDisplay.textContent = end.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });

                            setTimeout(() => {
                                loadAIInsight();
                            }, 50);

                            dropdown.classList.add('hidden');

                            // Gọi AJAX
                            fetchReports(startInput.value, endInput.value);
                        });
                    </script>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div
                            class="flex flex-col justify-between gap-4 rounded-xl p-6 bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-1">
                                    <p
                                        class="text-slate-500 dark:text-[#9db8a6] text-sm font-medium uppercase tracking-wider">
                                        Tổng doanh thu</p>
                                    <p id="total-revenue" class="text-slate-900 dark:text-white text-2xl font-bold">
                                        {{ $tongDoanhThu }}
                                    </p>
                                </div>
                                <div class="p-2 rounded-lg bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined">payments</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-between gap-4 rounded-xl p-6 bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-1">
                                    <p
                                        class="text-slate-500 dark:text-[#9db8a6] text-sm font-medium uppercase tracking-wider">
                                        Số đơn hoàn thành</p>
                                    <p id="total-orders" class="text-slate-900 dark:text-white text-2xl font-bold">
                                        {{ $tongDonHang }}
                                    </p>
                                </div>
                                <div class="p-2 rounded-lg bg-blue-500/10 text-blue-500">
                                    <span class="material-symbols-outlined">receipt_long</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-between gap-4 rounded-xl p-6 bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-1">
                                    <p
                                        class="text-slate-500 dark:text-[#9db8a6] text-sm font-medium uppercase tracking-wider">
                                        Tỷ lệ hủy đơn</p>
                                    <p id="cancel-rate" class="text-slate-900 dark:text-white text-2xl font-bold">
                                        {{ $tyLeHuyDon }}
                                    </p>
                                </div>
                                <div class="p-2 rounded-lg bg-red-500/10 text-red-500">
                                    <span class="material-symbols-outlined">event_busy</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-between gap-4 rounded-xl p-6 bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-1">
                                    <p
                                        class="text-slate-500 dark:text-[#9db8a6] text-sm font-medium uppercase tracking-wider">
                                        Giá trị TB đơn</p>
                                    <p id="avg-order-value" class="text-slate-900 dark:text-white text-2xl font-bold">
                                        {{ $giaTriTbDon }}
                                    </p>
                                </div>
                                <div class="p-2 rounded-lg bg-purple-500/10 text-purple-500">
                                    <span class="material-symbols-outlined">monitoring</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative overflow-hidden rounded-xl bg-gradient-to-br from-primary/20 to-transparent p-[1px] mb-6">
                        <div
                            class="relative flex flex-col md:flex-row items-center justify-between rounded-xl bg-white dark:bg-card-dark p-6 gap-6">
                            <div class="flex items-center gap-4">
                                <div>
                                    <div class="absolute top-0 right-0 p-4 opacity-10">
                                        <span
                                            class="material-symbols-outlined text-6xl text-primary">auto_awesome</span>
                                    </div>
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="material-symbols-outlined text-primary">auto_awesome</span>
                                        <h3 class="text-slate-900 dark:text-white font-bold text-base">AI Insight</h3>
                                    </div>
                                    <p id="ai-insight-text"
                                        class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4 min-h-[60px]">
                                        Đang suy nghĩ...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                        <div
                            class="xl:col-span-2 flex flex-col rounded-xl bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] p-6 shadow-sm">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h3 id="chart-title" class="text-slate-900 dark:text-white text-lg font-bold">Diễn
                                        biến doanh thu</h3>
                                </div>
                            </div>
                            <div class="relative w-full h-[320px]">
                                <canvas id="monthlyRevenueChart"></canvas>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6">
                            <div id="category-pie-container"
                                class="flex-1 flex flex-col rounded-xl bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] p-5 shadow-sm">
                                <h3 class="text-slate-900 dark:text-white font-bold text-base mb-4">
                                    Doanh thu theo danh
                                    mục</h3>
                                <div class="flex items-center gap-6">
                                    <div class="relative size-32 shrink-0">
                                        <svg class="size-full -rotate-90" viewBox="0 0 36 36">
                                            <path class="text-slate-100 dark:text-[#29382e]"
                                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                                fill="none" stroke="currentColor" stroke-width="3.5"></path>

                                            @php
                                                $cumulative = 0;
                                                $colors = [
                                                    'Món chính' => '#19e65e',
                                                    'Đồ uống' => '#3b82f6',
                                                    'Khai vị' => '#8b5cf6',
                                                    'Tráng miệng' => '#f97316'
                                                ];
                                                // Lấy key trực tiếp từ mảng để tránh sai dấu/khoảng trắng
                                                $fixedCategories = array_keys($categoryPercent ?? [
                                                    'Món chính' => 0,
                                                    'Đồ uống' => 0,
                                                    'Khai vị' => 0,
                                                    'Tráng miệng' => 0
                                                ]);
                                            @endphp

                                            @foreach($fixedCategories as $category)
                                                @php $percent = $categoryPercent[$category] ?? 0; @endphp
                                                @if($percent > 0)
                                                    <path style="stroke: {{ $colors[$category] ?? '#6b7280' }}"
                                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                                        fill="none" stroke-dasharray="{{ $percent }}, 100"
                                                        stroke-dashoffset="{{ -$cumulative }}" stroke-width="3.5"></path>
                                                    @php $cumulative += $percent; @endphp
                                                @endif
                                            @endforeach
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center flex-col">
                                            <span class="text-xl font-bold text-slate-900 dark:text-white">100%</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-3 flex-1 text-sm">
                                        @foreach($fixedCategories as $category)
                                            @php $percent = $categoryPercent[$category] ?? 0; @endphp
                                            <div class="flex justify-between items-center">
                                                <div class="flex items-center gap-2">
                                                    <span class="size-2 rounded-full"
                                                        style="background-color: {{ $colors[$category] ?? '#6b7280' }}"></span>
                                                    <span class="text-slate-500 dark:text-slate-300">{{ $category }}</span>
                                                </div>
                                                <span
                                                    class="font-bold text-slate-900 dark:text-white">{{ $percent }}%</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div id="area-pie-container"
                                class="flex-1 flex flex-col rounded-xl bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] p-5 shadow-sm">
                                <h3 class="text-slate-900 dark:text-white font-bold text-base mb-4">
                                    Doanh thu theo khu
                                    vực</h3>
                                <div class="flex items-center gap-6">
                                    <div class="relative size-32 shrink-0">
                                        <svg class="size-full -rotate-90" viewBox="0 0 36 36">
                                            <path class="text-slate-100 dark:text-[#29382e]"
                                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                                fill="none" stroke="currentColor" stroke-width="3.5"></path>

                                            @php
                                                $cumulative = 0;
                                                $colors = [
                                                    'Tiêu chuẩn' => '#19e65e',
                                                    'Gần cửa sổ' => '#3b82f6',
                                                    'Riêng tư' => '#8b5cf6',
                                                    'Ngoài trời' => '#f97316',
                                                ];
                                                $fixedAreas = ['Tiêu chuẩn', 'Gần cửa sổ', 'Riêng tư', 'Ngoài trời'];
                                            @endphp

                                            @foreach($fixedAreas as $area)
                                                @php
                                                    $percent = $areaPercent[$area] ?? 0;
                                                    $display = $percent > 0 ? '' : 'none';
                                                @endphp
                                                <path
                                                    style="stroke: {{ $colors[$area] ?? '#6b7280' }}; display: {{ $display }};"
                                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    fill="none" stroke-dasharray="{{ $percent }}, 100"
                                                    stroke-dashoffset="{{ -$cumulative }}" stroke-width="3.5"></path>
                                                @php $cumulative += $percent; @endphp
                                            @endforeach
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center flex-col">
                                            <span class="text-xl font-bold text-slate-900 dark:text-white">100%</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-3 flex-1 text-sm">
                                        @foreach($fixedAreas as $area)
                                            @php $percent = $areaPercent[$area] ?? 0; @endphp
                                            <div class="flex justify-between items-center">
                                                <div class="flex items-center gap-2">
                                                    <span class="size-2 rounded-full"
                                                        style="background-color: {{ $colors[$area] ?? '#6b7280' }}"></span>
                                                    <span class="text-slate-500 dark:text-slate-300">{{ $area }}</span>
                                                </div>
                                                <span
                                                    class="font-bold text-slate-900 dark:text-white">{{ $percent }}%</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-full rounded-xl bg-white dark:bg-card-dark border border-slate-200 dark:border-[#29382e] shadow-sm overflow-hidden mb-10">
                        <div
                            class="px-6 py-4 border-b border-slate-200 dark:border-[#29382e] flex justify-between items-center">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Món ăn bán chạy nhất</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-slate-50 dark:bg-[#1f3328] text-slate-500 dark:text-[#9db8a6]">
                                    <tr>
                                        <th class="px-6 py-3 font-medium">Món ăn</th>
                                        <th class="px-6 py-3 font-medium">Danh mục</th>
                                        <th class="px-6 py-3 font-medium text-right">Đã bán</th>
                                        <th class="px-6 py-3 font-medium text-right">Doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-[#29382e]">
                                    @forelse($topFoodsFormatted as $mon)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-[#29382e]/50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <!-- Hình ảnh: dùng placeholder nếu không có -->
                                                    <div class="size-10 rounded-lg bg-cover bg-center bg-gray-200 dark:bg-gray-700"
                                                        style="background-image: url('{{ $mon['hinh_anh'] ?? 'https://via.placeholder.com/40?text=' . urlencode(substr($mon['ten_mon'], 0, 1)) }}');">
                                                    </div>
                                                    <span
                                                        class="font-bold text-slate-900 dark:text-white">{{ $mon['ten_mon'] }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-300">{{ $mon['danh_muc'] }}
                                            </td>
                                            <td class="px-6 py-4 text-right font-medium text-slate-900 dark:text-white">
                                                {{ $mon['so_luong'] }}
                                            </td>
                                            <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white">
                                                {{ $mon['doanh_thu'] }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                class="px-6 py-10 text-center text-slate-500 dark:text-slate-400 italic">
                                                Chưa có dữ liệu món ăn bán chạy trong khoảng thời gian này.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>

    <script>
        let revenueChart = null; // Để destroy và tạo mới khi cập nhật

        // Format ngắn gọn: 3269160 → "3,3tr"
        const formatShortVND = (value) => {
            if (value >= 1000000000) return (value / 1000000000).toFixed(1).replace('.', ',') + 'tỷ';
            if (value >= 1000000) return (value / 1000000).toFixed(1).replace('.', ',') + 'tr';
            if (value >= 1000) return (value / 1000).toFixed(0) + 'k';
            return value.toString();
        };

        function renderRevenueChart(dates, revenue) {
            const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');

            // Destroy chart cũ nếu tồn tại
            if (revenueChart) revenueChart.destroy();

            revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Doanh thu',
                        data: revenue,
                        borderColor: '#19e65e',
                        backgroundColor: 'rgba(25, 230, 94, 0.2)',
                        fill: true,
                        tension: 0.5,
                        pointBackgroundColor: '#19e65e',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 8,
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: (context) => formatShortVND(context.parsed.y) + 'đ'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { color: 'rgba(255,255,255,0.05)' },
                            ticks: {
                                color: '#9db8a6',
                                maxRotation: 0,
                                minRotation: 0,
                                autoSkip: true,
                                maxTicksLimit: 10  // Giới hạn ~10 nhãn để tránh sát
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255,255,255,0.05)' },
                            ticks: {
                                color: '#9db8a6',
                                callback: formatShortVND
                            }
                        }
                    }
                }
            });
        }

        // Render danh mục tròn bằng ID
        function renderCategoryPie(categoryPercent) {
            const container = document.getElementById('category-pie-container');
            if (!container) {
                console.error('Không tìm thấy #category-pie-container');
                return;
            }

            const svg = container.querySelector('svg');
            if (!svg) {
                console.error('Không tìm thấy SVG trong danh mục');
                return;
            }

            // Lấy tất cả path có stroke-dasharray (các phần slice)
            const paths = svg.querySelectorAll('path[stroke-dasharray]');
            // Lấy legend items (các div justify-between trong flex-col gap-3)
            const legendItems = container.querySelectorAll('.flex.justify-between');

            let cumulative = 0;
            const fixedCategories = ['Món chính', 'Đồ uống', 'Khai vị', 'Tráng miệng'];
            const colors = ['#19e65e', '#3b82f6', '#8b5cf6', '#f97316'];

            fixedCategories.forEach((cat, index) => {
                const percent = categoryPercent[cat] || 0;

                // Cập nhật path
                const path = paths[index];
                if (path) {
                    path.setAttribute('stroke-dasharray', `${percent}, 100`);
                    path.setAttribute('stroke-dashoffset', `-${cumulative}`);
                    path.style.stroke = colors[index];
                    path.style.display = percent > 0 ? '' : 'none';
                    cumulative += percent;
                }

                // Cập nhật % trong legend
                const legend = legendItems[index];
                if (legend) {
                    const percentSpan = legend.querySelector('span.font-bold');
                    if (percentSpan) {
                        percentSpan.textContent = `${percent}%`;
                    }
                }
            });

            console.log('Render danh mục thành công:', categoryPercent);
        }

        // Render khu vực tròn bằng ID
        function renderAreaPie(areaPercent) {
            const container = document.getElementById('area-pie-container');
            if (!container) {
                console.error('Không tìm thấy #area-pie-container');
                return;
            }

            const svg = container.querySelector('svg');
            if (!svg) {
                console.error('Không tìm thấy SVG trong khu vực');
                return;
            }

            const paths = svg.querySelectorAll('path[stroke-dasharray]');
            const legendItems = container.querySelectorAll('.flex.justify-between');

            let cumulative = 0;
            const fixedAreas = ['Tiêu chuẩn', 'Gần cửa sổ', 'Riêng tư', 'Ngoài trời'];
            const colors = ['#19e65e', '#3b82f6', '#8b5cf6', '#f97316'];

            fixedAreas.forEach((area, index) => {
                const percent = areaPercent[area] || 0;

                const path = paths[index];
                if (path) {
                    path.setAttribute('stroke-dasharray', `${percent}, 100`);
                    path.setAttribute('stroke-dashoffset', `-${cumulative}`);
                    path.style.stroke = colors[index];
                    path.style.display = percent > 0 ? '' : 'none';
                    cumulative += percent;
                }

                const legend = legendItems[index];
                if (legend) {
                    const percentSpan = legend.querySelector('span.font-bold');
                    if (percentSpan) {
                        percentSpan.textContent = `${percent}%`;
                    }
                }
            });

            console.log('Render khu vực thành công:', areaPercent);
        }

        // Hàm tải AI Insight
        function loadAIInsight() {
            const startDate = startInput.value;
            const endDate = endInput.value;

            if (!startDate || !endDate) {
                console.warn('Ngày chưa được set, bỏ qua gọi AI Insight');
                document.getElementById('ai-insight-text').textContent = 'Đang chờ ngày hợp lệ...';
                return;
            }

            console.log('Gọi AI Grok Insight với ngày:', startDate, endDate);

            fetch(`/ai-grok-insight?start_date=${startDate}&end_date=${endDate}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    console.log('AI Grok status:', response.status);
                    if (!response.ok) throw new Error('Network response was not ok ' + response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('AI Insight data:', data);

                    let insightText = data.insight || 'Không có insight mới.';

                    // Chuyển markdown **tên món** thành <strong style="color: #19e65e;">
                    insightText = insightText.replace(/\*\*(.*?)\*\*/g, '<strong style="color: #19e65e; font-weight: bold;">$1</strong>');

                    // Giữ xuống dòng
                    insightText = insightText.replace(/\n/g, '<br>');

                    document.getElementById('ai-insight-text').innerHTML = insightText;
                })
                .catch(error => {
                    console.error('AI Grok error:', error);
                    document.getElementById('ai-insight-text').textContent = 'Không thể tải insight (lỗi: ' + error.message + ')';
                });
        }

        // Cập nhật biểu đồ khi fetch dữ liệu mới
        function fetchReports(startDate, endDate) {
            fetch(`/admin/dashboard?start_date=${startDate}&end_date=${endDate}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Cập nhật các chỉ số chính
                    document.getElementById('total-revenue').textContent = data.tongDoanhThu || '0đ';
                    document.getElementById('total-orders').textContent = data.tongDonHang || '0';
                    document.getElementById('cancel-rate').textContent = data.tyLeHuyDon || '0.00%';
                    document.getElementById('avg-order-value').textContent = data.giaTriTbDon || '0đ';

                    // Cập nhật tiêu đề biểu đồ đường
                    const end = new Date(endDate);
                    const monthYear = end.toLocaleDateString('vi-VN', { month: '2-digit', year: 'numeric' });
                    document.getElementById('chart-title').textContent = `Diễn biến doanh thu ${monthYear}`;

                    // Cập nhật biểu đồ đường
                    if (data.dailyDates && data.dailyRevenue) {
                        renderRevenueChart(data.dailyDates, data.dailyRevenue);
                    }

                    // Cập nhật biểu đồ tròn DANH MỤC
                    if (data.categoryPercent) {
                        renderCategoryPie(data.categoryPercent);
                    }

                    // Cập nhật biểu đồ tròn KHU VỰC
                    if (data.areaPercent) {
                        renderAreaPie(data.areaPercent);
                    }

                    // Cập nhật bảng món bán chạy (chỉ 4 cột, bỏ xu hướng)
                    if (data.topFoods) {
                        const tbody = document.querySelector('tbody');
                        tbody.innerHTML = ''; // xóa cũ
                        data.topFoods.forEach(mon => {
                            // Sử dụng asset() để lấy đường dẫn đúng: /food_img/ten_anh.jpg
                            const imageUrl = mon.hinh_anh
                                ? `${window.location.origin}/food_img/${mon.hinh_anh}`
                                : 'https://via.placeholder.com/40?text=' + encodeURIComponent(mon.ten_mon.charAt(0));

                            tbody.innerHTML += `
                        <tr class="hover:bg-slate-50 dark:hover:bg-[#29382e]/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="size-10 rounded-lg bg-cover bg-center bg-gray-200 dark:bg-gray-700"
                                        style="background-image: url('${imageUrl}');">
                                    </div>
                                    <span class="font-bold text-slate-900 dark:text-white">${mon.ten_mon}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-300">${mon.danh_muc}</td>
                            <td class="px-6 py-4 text-right font-medium text-slate-900 dark:text-white">${mon.so_luong}</td>
                            <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white">${mon.doanh_thu}</td>
                        </tr>`;
                        });
                    }
                })
                .catch(error => console.error('Lỗi:', error));
        }

        // Khởi tạo biểu đồ lần đầu (dữ liệu từ Blade)
        document.addEventListener('DOMContentLoaded', () => {
            const now = new Date();
            const nowISO = now.toISOString().split('T')[0];

            refreshDatePicker('start-date-input', nowISO);
            refreshDatePicker('end-date-input', nowISO);

            const formattedNow = now.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });

            startDisplay.textContent = formattedNow;
            endDisplay.textContent = formattedNow;

            const todayBtn = document.querySelector('.quick-range[data-days="0"]');
            if (todayBtn) todayBtn.classList.add('bg-primary/10', 'text-primary');

            // Load dữ liệu lần đầu
            fetchReports(nowISO, nowISO);

            // Gọi AI Insight SAU khi ngày đã set xong
            setTimeout(() => {
                loadAIInsight();
            }, 100);  // Delay nhỏ để đảm bảo input value đã cập nhật
        });
    </script>

</body>

</html>
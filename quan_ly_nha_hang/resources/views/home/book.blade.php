{{-- resources/views/home/book.blade.php --}}
<section id="book-table" class="py-5 bg-dark text-white">
    <div class="container">
        <div style="margin-top: 55px;" class="text-center mb-5">
            <h2 class="display-4 fw-bold text-danger mb-3">ĐẶT BÀN</h2>
            <p class="lead">Chọn ngày giờ để xem bàn trống</p>
        </div>

        {{-- Thông báo thành công --}}
        @if(session('success'))
            <div class="alert alert-success text-center mb-4 rounded-3 shadow alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center mb-4 rounded-3 shadow">{{ session('error') }}</div>
        @endif

        {{-- Form chọn ngày giờ – ĐẸP NHƯ APP THẬT – NÚT Ở DƯỚI & CĂN GIỮA --}}
<div class="row justify-content-center mb-5">
    <div class="col-lg-6 col-md-8">
        <div class="card bg-secondary border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-5">
                <form id="checkAvailabilityForm">
                    @csrf

                    <div class="row g-4">
                        <!-- Ngày -->
                        <div class="col-md-6">
                            <label class="form-label text-warning fw-bold mb-3">
                                <i class="far fa-calendar-alt me-2"></i> Chọn ngày
                            </label>
                            <input type="date" 
                                   name="booking_date" 
                                   class="form-control form-control-lg rounded-3 shadow-sm" 
                                   value="{{ old('booking_date', now()->format('Y-m-d')) }}" 
                                   min="{{ now()->format('Y-m-d') }}" 
                                   required>
                        </div>

                        <!-- Giờ -->
                        <div class="col-md-6">
                            <label class="form-label text-warning fw-bold mb-3">
                                <i class="far fa-clock me-2"></i> Chọn giờ
                            </label>
                            <select name="booking_time" class="form-control form-control-lg rounded-3 shadow-sm" required>
                                <option value="" disabled {{ old('booking_time') ? '' : 'selected' }}>-- Chọn giờ --</option>
                                @for($h = 8; $h <= 22; $h++)
                                    @for($m = 0; $m < 60; $m += 30)
                                        @if($h != 22 || $m == 0)
                                            <option value="{{ sprintf('%02d:%02d', $h, $m) }}"
                                                {{ old('booking_time') == sprintf('%02d:%02d', $h, $m) ? 'selected' : '' }}>
                                                {{ sprintf('%02d:%02d', $h, $m) }}
                                            </option>
                                        @endif
                                    @endfor
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Nút Xem bàn – Ở dưới, căn giữa, to đẹp -->
                    <div class="text-center mt-5">
                        <button type="submit" 
                                class="btn btn-danger btn-lg px-5 py-3 rounded-pill shadow-lg hover-lift">
                            <i class="fas fa-search me-2"></i>
                            <strong>XEM SƠ ĐỒ BÀN</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Thêm CSS nhỏ để nút đẹp hơn (dán vào <style> ở cuối file book.blade.php) --}}
<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(220, 53, 69, 0.4) !important;
    }
    .form-control-lg, .form-select-lg {
        height: 58px;
    }
</style>

        {{-- Khu vực sơ đồ bàn --}}
        <div id="tableMapContainer"></div>
    </div>
</section>

{{-- Modal đặt bàn --}}
<div class="modal fade" id="bookModal">
    <div class="modal-dialog modal-md">
        <form id="bookingForm">
            @csrf
            <input type="hidden" name="table_id" id="tableId">
            <input type="hidden" name="booking_date" id="formDate">
            <input type="hidden" name="booking_time" id="formTime">

            <div class="modal-content bg-dark text-light border-danger">
                <div class="modal-header">
                    <h4>Đặt bàn <span id="tableNum" class="text-warning"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <!-- Vùng hiển thị thông báo ngay trong modal -->
                    <div id="modalAlert"></div>

                    <input type="text" name="customer_name" class="form-control form-control-lg mb-3" placeholder="Họ tên" required>
                    <input type="tel" name="phone" class="form-control form-control-lg mb-3" placeholder="Số điện thoại" required>
                    <input type="number" name="guests" class="form-control form-control-lg mb-3" placeholder="Số khách" required>
                    <textarea name="note" class="form-control form-control-lg mb-3" rows="2" placeholder="Ghi chú"></textarea>

                    <button type="submit" class="btn btn-danger btn-lg w-100">XÁC NHẬN ĐẶT BÀN</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
// Load sơ đồ bàn
document.getElementById('checkAvailabilityForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    fetch('{{ route("booking.check") }}', {
        method: 'POST',
        body: fd,
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    })
    .then(r => r.text())
    .then(html => {
        document.getElementById('tableMapContainer').innerHTML = html;
        document.getElementById('tableMapContainer').style.display = 'block';
        document.getElementById('tableMapContainer').scrollIntoView({behavior: 'smooth'});
    })
    .catch(err => console.error('Lỗi load bàn:', err));
});

// Click bàn
document.addEventListener('click', function(e) {
    const item = e.target.closest('.table-item.available');
    if (item) {

        // RESET TOÀN BỘ MODAL
        const form = document.getElementById('bookingForm');
        const alertBox = document.getElementById('modalAlert');

        // Xóa thông báo cũ
        if (alertBox) alertBox.innerHTML = "";

        // Reset các input nhưng giữ hidden input
        form.querySelectorAll('input:not([type="hidden"]), textarea').forEach(el => {
            el.value = "";
        });

        // Cập nhật lại thông tin mới
        document.getElementById('tableId').value = item.dataset.id;
        document.getElementById('tableNum').textContent = item.dataset.number;
        document.getElementById('formDate').value = document.querySelector('[name="booking_date"]').value;
        document.getElementById('formTime').value = document.querySelector('[name="booking_time"]').value;

        // Mở modal
        new bootstrap.Modal(document.getElementById('bookModal')).show();
    }
});


// XỬ LÝ ĐẶT BÀN – ĐÂY LÀ CHỖ QUAN TRỌNG NHẤT!
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const fd = new FormData(this);

    fetch('{{ route("booking.store") }}', {
        method: 'POST',
        body: fd,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(async response => {
        let data = await response.json();
        const alertBox = document.getElementById('modalAlert');

        // Xóa alert cũ
        alertBox.innerHTML = '';

        if (!response.ok) {
            alertBox.innerHTML = `
                <div class="alert alert-danger rounded-3 mb-3">
                    ${data.message || 'Vui lòng kiểm tra thông tin!'}
                </div>
            `;
            return;
        }

        // Thành công
        alertBox.innerHTML = `
            <div class="alert alert-success rounded-3 mb-3">
                ${data.message}
            </div>
        `;

        // Reload sơ đồ bàn
        document.getElementById('checkAvailabilityForm').dispatchEvent(new Event('submit'));

        // Đóng modal sau 1.5 giây
        setTimeout(() => {
            const modalEl = document.getElementById('bookModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            modalInstance.hide();
        }, 1500);
    })
    .catch(err => {
        document.getElementById('modalAlert').innerHTML = `
            <div class="alert alert-danger rounded-3 mb-3">
                Có lỗi xảy ra, vui lòng thử lại!
            </div>
        `;
    });
});

</script>
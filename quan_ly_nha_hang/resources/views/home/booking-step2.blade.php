<x-app-layout>
// Nếu layout của bạn tên khác thì đổi thành <x-tên-layout-của-bạn>

@slot('content')
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="display-5 fw-bold text-danger">
                SƠ ĐỒ BÀN - {{ $bookingDateTime->format('d/m/Y') }} lúc {{ $bookingDateTime->format('H:i') }}
            </h2>
            <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm">← Thay đổi ngày giờ</a>
        </div>

        <div class="floor-plan position-relative rounded-4 overflow-hidden shadow-lg" style="height: 720px; background: #0f2027;">

            @foreach($allTables as $table)
                <div class="table-item {{ $table->current_status === 'booked' ? 'booked' : 'available' }}"
                     style="position:absolute;left:{{ $table->pos_x }}%;top:{{ $table->pos_y }}%;transform:translate(-50%,-50%);"
                     @if($table->current_status === 'available')
                         data-id="{{ $table->id }}" data-number="{{ $table->number }}"
                     @endif>

                    <div class="table-circle {{ $table->zone === 'vip' ? 'vip' : ($table->zone === 'sushi_bar' ? 'sushi' : ($table->zone === 'outdoor' ? 'outdoor' : 'normal')) }}">
                        {{ $table->zone === 'sushi_bar' ? 'S' : ($table->zone === 'vip' ? 'VIP' : '') }}
                    </div>
                    <div class="table-label">
                        <strong>{{ $table->number }}</strong><br>
                        <small>{{ $table->seats }} chỗ</small>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <span class="badge bg-success fs-5 p-3 mx-2">Bàn trống</span>
            <span class="badge bg-danger fs-5 p-3 mx-2">Đã đặt</span>
        </div>
    </div>
</section>
@endslot

<!-- Modal + style + script giữ nguyên như cũ -->
<div class="modal fade" id="bookModal"> ... </div>

<style>
    /* toàn bộ CSS như cũ */
    .table-circle{width:82px;height:82px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:bold;font-size:22px;box-shadow:0 10px 20px rgba(0,0,0,.8);transition:all .3s}
    .normal{background:#2c3e50}.vip{background:linear-gradient(45deg,#8e44ad,#3498db);width:110px;height:110px}.sushi{background:#e74c3c}.outdoor{background:#27ae60}
    .table-item.available{cursor:pointer}.table-item.available:hover .table-circle{transform:scale(1.3)}
    .table-item.booked{opacity:.4;filter:grayscale(100%);cursor:not-allowed}
    .table-label{background:rgba(0,0,0,.8);color:#fff;padding:6px 14px;border-radius:30px;font-size:13px;margin-top:10px;display:inline-block}
</style>

<script>
    document.querySelectorAll('.table-item.available').forEach(e=>e.addEventListener('click',function(){
        document.getElementById('tableId').value=this.dataset.id;
        document.getElementById('tableNum').textContent=this.dataset.number;
        new bootstrap.Modal(document.getElementById('bookModal')).show();
    }));
</script>

</x-app-layout>
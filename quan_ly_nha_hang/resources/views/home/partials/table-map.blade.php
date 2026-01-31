<div class="text-center mb-4">
    <h3 class="text-warning">
        Bàn trống lúc {{ request('booking_time') }} ngày {{ \Carbon\Carbon::parse(request('booking_date'))->format('d/m/Y') }}
    </h3>
</div>

<div class="floor-plan position-relative rounded-4 overflow-hidden shadow-lg mb-4" 
     style="height: 600px; 
            background-image: url('{{ asset('images/map-table.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            background-color: #0f2027;">

    @foreach($tables as $table)
        <div class="table-item {{ $table->is_booked ? 'booked' : 'available' }}"
             style="position:absolute; left:{{ $table->pos_x }}%; top:{{ $table->pos_y }}%; transform:translate(-50%,-50%);"
             @if(!$table->is_booked) data-id="{{ $table->id }}" data-number="{{ $table->number }}" @endif>

            <!-- BÀN TRÒN + TEXT Ở GIỮA -->
            <div class="table-wrapper">
                <div class="table-circle 
                    {{ $table->zone == 'vip' ? 'vip' : 
                       ($table->zone == 'sushi_bar' ? 'sushi' : 
                       ($table->zone == 'outdoor' ? 'outdoor' : 'normal')) }}">
                    
                    <!-- TEXT Ở GIỮA BÀN -->
                    <div class="table-text" style="text-align: center; font-size:15px">
                        <strong class="d-block">{{ $table->number }}</strong>
                        <small class="d-block">{{ $table->seats }} ghế</small>
                        <!-- @if($table->zone == 'sushi_bar') <span class="sushi-label">S</span> @endif -->
                        @if($table->zone == 'vip') <span class="vip-label">VIP</span> @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="text-center">
    <span class="badge bg-success fs-5 p-3 mx-2">Bàn trống</span>
    <span class="badge bg-danger fs-5 p-3 mx-2">Đã đặt</span>
</div>


<!-- CSS  -->
<style>
    /* Bàn hình vuông bo góc đẹp hiện đại */
    .table-wrapper {
        width: 55px;
        height: 55px;
        position: relative;
    }

    .table-circle {
        width: 100%;
        height: 100%;
        border-radius: 8px !important; /* Bo góc vuông */
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: bold;
        transition: all 0.1s ease;
        position: relative;
        border: 3px solid rgba(255,255,255,0.15);
    }

    /* Màu nền theo khu vực */
    .normal   { background: linear-gradient(135deg, #727BAF, #848dc1ff); }
    .vip      { 
        background: linear-gradient(135deg, #8e44ad, #9b59b6); 
        width: 90px !important; 
        height: 90px !important; 
        font-size: 18px;
        border: 4px solid #f1c40f !important;
        box-shadow: 0 0 30px rgba(241, 196, 15, 0.5) !important;
    }
    .sushi    { background: linear-gradient(135deg, #482C21, #5e3b2dff); }
    .outdoor  { background: linear-gradient(135deg, #27ae60, #2ecc71); }

    /* Chữ ở giữa bàn */
    .table-text {
        text-align: center;
        line-height: 1.2;
    }

    .table-text strong {
        font-size: 22px;
        display: block;
        margin-bottom: 4px;
        text-shadow: 0 2px 6px rgba(0,0,0,0.6);
    }

    .table-text small {
        font-size: 13px;
        opacity: 0.9;
        display: block;
        text-shadow: 0 1px 4px rgba(0,0,0,0.5);
    }

    /* Badge VIP / S */
    .sushi-label, .vip-label {
        position: absolute;
        top: 2px;
        right: 2px;
        font-size: 11px;
        font-weight: bold;
        padding: 2px 4px;
        border-radius: 20px;
        background: rgba(0,0,0,0.5);
        /* backdrop-filter: blur(4px); */
        z-index: 10;
    }

    .vip-label   { background: #f1c40f; color: #000; }
    .sushi-label { background: #fff; color: #482C21; }

    /* Hover khi bàn trống */
    .table-item.available {
        cursor: pointer;
        z-index: 5;
    }

    .table-item.available:hover .table-circle {
        transform: scale(1.01);
        box-shadow: 0 0 10px #ff6b6b !important;
        border-color: #ff6b6b !important;
    }

    /* Bàn đã đặt */
    .table-item.booked {
        opacity: 0.35;
        filter: grayscale(100%) brightness(0.8);
        cursor: not-allowed;
    }

    .table-item.booked .table-circle {
        transform: scale(0.9);
    }
</style>
@extends('layouts.app')
@section('content')
<section class="py-5 bg-dark text-white">
    <div class="container">
        <h2 class="text-center mb-5 text-danger display-4">ĐẶT BÀN TRỰC TUYẾN</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-secondary border-danger shadow-lg">
                    <div class="card-body p-5">
                        <form action="{{ route('booking.load') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fs-5">Chọn ngày</label>
                                <input type="date" name="booking_date" class="form-control form-control-lg" 
                                       min="{{ date('Y-m-d') }}" value="{{ old('booking_date', date('Y-m-d')) }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fs-5">Chọn giờ</label>
                                <select name="booking_time" class="form-select form-select-lg" required>
                                    @for($h = 8; $h <= 22; $h++)
                                        @for($m = 0; $m < 60; $m += 30)
                                            @if($h < 22 || $m == 0)
                                                <option value="{{ sprintf('%02d:%02d', $h, $m) }}">
                                                    {{ sprintf('%02d:%02d', $h, $m) }}
                                                </option>
                                            @endif
                                        @endfor
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger btn-lg w-100 shadow">
                                XEM SƠ ĐỒ BÀN
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
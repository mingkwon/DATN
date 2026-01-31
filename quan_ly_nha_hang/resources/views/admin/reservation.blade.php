<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        table {
            border: 1px solid #DB6574;
            margin: auto;
            width: 800px;
        }

        th {
            background-color: #DB6574;
            color: white;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        td {
            color: white;
            padding: 10px;
            text-align: center;
            border: 1px solid #DB6574;
        }
    </style>
  </head>
  <body>
    
    @include('admin.header')
    
    @include('admin.sidebar')

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h1>Thông tin đặt bàn</h1>
            <table>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>SĐT</th>
                    <th>Số người</th>
                    <th>Thời gian đặt bàn</th>
                    <th>Bàn</th>
                    <th>Số ghế</th>
                    <th>Khu vực</th>
                    <th>Ghi chú</th>
                </tr>
                @foreach ($reservation as $reservation)
                <tr>
                    <td>{{$reservation->customer_name}}</td>
                    <td>{{$reservation->phone}}</td>
                    <td>{{$reservation->guests}}</td>
                    <td>{{$reservation->booking_time}}</td>
                    <td>{{$reservation->table->number}}</td>
                    <td>{{$reservation->table->seats}}</td>
                    <td>{{$reservation->table->zone}}</td>
                    <td>{{$reservation->note}}</td>
                </tr>
                @endforeach
            </table>

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>
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
            border-bottom: 1px solid #DB6574;
            text-align: center;
        }
    </style>
</head>

<body>

    @include('admin.header')

    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1>All Foods</h1>
                <div>
                    <table>
                        <tr>
                            <th>Food title</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>

                        @foreach($data as $data)

                            <tr>
                                <td>{{$data->title}}</td>
                                <td>{{$data->detail}}</td>
                                <td>{{$data->price}}</td>
                                <td>
                                    <img width="150" src="food_img/{{$data->image}}" alt="">
                                </td>
                                <td>
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')"
                                        href="{{ url('delete_food', $data->id) }}">
                                        Delete
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ url('update_food', $data->id) }}">
                                        Update
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
</body>

</html>
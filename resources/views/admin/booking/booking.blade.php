@extends('layouts.master')
@section('title','')
@section('content')
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header">
            <h4>Danh sách đặt phòng khách sạn

            </h4>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success alert-block">{{ session('success') }}</div>
            @endif

            <table id="myDataTable" class="table table-bordered display">
                <thead>
                    <th>ID</th>
                    <th>ID User</th>
                    <th>Tên người đặt</th>

                    <th>Ngày bắt dầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt phòng</th>
                    <th>Tổng tiền</th>


                </thead>
                <tbody>
                    @foreach ($bookings as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->user_id }}</td>
                        <td>{{$item->customer?->email }}</td>

                        <td>{{$item->start_date}}</td>
                        <td>{{$item->end_date}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->date_booking}}</td>
                        <td>{{$item->total_price}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>

@endsection
@extends('layouts.master')
@section('title','')
@section('content')
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header">
            <h4>Infomation Room
                <a href="./create-room" class="btn btn-primary btn-sm float-end">Add Room</a>
            </h4>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success alert-block">{{ session('success') }}</div>
            @endif

            <table id="myDataTable" class="table table-bordered display">
                <thead>
                    <th>ID</th>
                    <th>Tên phòng</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Chỉnh sửa</th>
                    <th>Xoa</th>

                </thead>
                <tbody>
                    @foreach ($rooms as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->status }}</td>

                        <td><a href="{{url('edit-room/'.$item->id) }}" class="btn btn-success">Edit</a></td>
                        <td><a href="{{url('delete-hotel/'.$item->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>

@endsection
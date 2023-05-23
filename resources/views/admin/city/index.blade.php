@extends('layouts.master')
@section('title','')
@section('content')
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header">
            <h4>Thông tin khách sạn 
                <a href="./create-hotel" class="btn btn-primary btn-sm float-end">Thêm khách sạn</a>
            </h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-block">{{ session('success') }}</div>
            @endif

            <table id="myDataTable"  class="table table-bordered display">
                <thead >
                    <th>ID</th>
                    <th>Name</th>
                    <th>Sub Name</th>
                    <th>Image</th>
                    <th>EDIT</th>
                    <th>DELETE</th>

                </thead>
                <tbody>
                    @foreach ($citys as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->sub_name}}</td>
                            <td >
                                <img class="" src="{{asset('images/city/'.$item->image)}}" width="100" height="90" alt="img">
                            </td>
                            <td><a href="{{url('edit-city/'.$item->id) }}" class="btn btn-success">Edit</a></td>
                            <td><a href="{{url('delete-city/'.$item->id) }}" class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
</div>

@endsection
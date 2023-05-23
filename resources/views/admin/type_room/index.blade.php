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
                    <th>Price</th>
                    <th>Area</th>
                    <th>Number Of People</th>
                    <th>Number Of Bed</th>
                    
                    <th>EDIT</th>
                    <th>DELETE</th>

                </thead>
                <tbody>
                    @foreach ($typerooms as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->area}}</td>
                            <td>{{$item->number_of_people}}</td>
                            <td>{{$item->number_of_bed}}</td>
                           
                            <td><a href="{{url('edit-hotel/'.$item->id) }}" class="btn btn-success">Edit</a></td>
                            <td><a href="{{url('delete-hotel/'.$item->id) }}" class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
</div>

@endsection
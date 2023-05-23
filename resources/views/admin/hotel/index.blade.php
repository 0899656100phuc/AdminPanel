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
                    <th>Tên khách sạn</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th>Số sao</th>
                    <th>Mô tả</th>

                    <th>Image</th>
                    <th>EDIT</th>
                    <th>DELETE</th>

                </thead>
                <tbody>
                    @foreach ($hotels as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->star_number}}</td>
                            <td class="truncate">
                                <span>{{$item->description}}</span>
                                @if(strlen($item->description) > 150)
                                  <span class="see-more">Xem thêm</span>
                                @endif
                            </td>

                           
                            <td >
                                <img class="" src="{{asset('images/hotel/'.$item->image)}}" width="100" height="90" alt="img">
                            </td>
                            <td><a href="{{url('edit-hotel/'.$item->id) }}" class="btn btn-success">Edit</a></td>
                            <td><a href="{{url('delete-hotel/'.$item->id) }}" class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
</div>
<script>
    document.querySelectorAll('.see-more').forEach(item => {
      item.addEventListener('click', event => {
        const span = event.target.previousElementSibling;
        span.style.maxHeight = 'none';
        item.style.display = 'none';
      })
    })
  </script>

@endsection
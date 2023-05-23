@extends('layouts.master')

@section('title','hotel')


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Thêm tỉnh thành</h1>
   {{--  <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Hotel</li>
    </ol> --}}
    <div class="row">


    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="">Form thông tin</h4>
        </div>
        <div class="card-body">
            <form action="/create-city" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tên tỉnh thành:</label>
                    <input type="text" name="name" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tên đầy đủ:</label>
                    <input type="text" name="sub_name" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Hình ảnh:</label>
                    <input name="image" class="form-control form-control-sm" id="formFiles" type="file">
                </div>
                
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>

    </div>
    
</div>

@endsection
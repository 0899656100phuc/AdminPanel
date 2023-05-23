@extends('layouts.master')

@section('title','hotel')


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Thêm khách sạn</h1>
    {{-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Form thông tin</li>
    </ol> --}}
    <div class="row">


    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="">Form thông tin </h4>
        </div>
        <div class="card-body">
            <form action="/create-hotel" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Tỉnh thành:</label>
                            <select name="city" class="form-control" id="">
                                @foreach ($citys as $item)
                                    <option value="{{$item->id}}">{{$item->id}} / {{$item->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Tên khách sạn:</label>
                            <input type="text" name="name" class="form-control" id="recipient-name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
                            <input type="text" name="address" class="form-control" id="recipient-name">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Số điện thoại:</label>
                            <input type="text" name="phone" class="form-control" id="recipient-name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="text" name="email" class="form-control" id="recipient-name">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Số sao:</label>
                            <input type="number" max="6" min="0" name="star_number" class="form-control" id="recipient-name">
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Cover Hình ảnh:</label>
                            <input name="cover_image" class="form-control form-control-sm" id="formFiles" type="file">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Nhiều hình ảnh nếu có:</label>
                            <input  class="form-control form-control-sm" id="formFiles" type="file" name="images[]" multiple>
                        </div>
                    </div>
                  </div>
                  
                
                
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Mô tả:</label>
                    <textarea name="description" class="form-control" id="recipient-name" rows="4"></textarea>
                  </div>
                <table class="table table-bordered " id="table">
                    <tr>
                        <th>Dịch vụ</th>
                        <th>Hành động</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="inputs[0][name_service]" placeholder="Enter your service" class="form-control"></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Thêm dịch vụ</button></td>
                    </tr>
                </table>
               
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ url('dashboard') }}" class="btn btn-danger">Trở về</a>
                </div>

            </form>
        </div>

    </div>
    
</div>
<script>
    var i=0;
    $('#add').click(function(){
        
        ++i;
        $('#table').append(
            `<tr>
               
                <td>
                    <input type="text" name="inputs[`+i+`][name_service]" placeholder="Enter your service" class="form-control">
                </td>
                <td>
                    <button type="button" name="add" id="add" class="btn btn-danger remove-input-field">remove</button>
                </td>
            </tr>`);
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
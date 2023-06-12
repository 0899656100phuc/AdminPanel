@extends('layouts.master')

@section('title','hotel')


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add Room</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Room</li>
    </ol>
    <div class="row">


    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="">Add Room </h4>
        </div>
        <div class="card-body">
            <form action="/create-room" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Name:</label>
                    <input type="text" name="name" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Hotel:</label>
                    <select name="hotel" class="form-control" id="">
                        @foreach ($hotels as $item)
                        <option value="{{$item->id}}">{{$item->id}} / {{$item->name}}</option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Type Room:</label>
                    <select name="typeroom" class="form-control" id="">
                        @foreach ($typerooms as $item)
                        <option value="{{$item->id}}">{{$item->id}} / {{$item->name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Hình ảnh phòng:</label>
                        <input class="form-control form-control-sm" id="formFiles" type="file" name="images[]" multiple>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Description:</label>
                    <textarea name="description" id="" cols="30" rows="6" class="form-control"></textarea>
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
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Status:</label>
                    <select name="status">
                        <option value="Còn trống">Còn phòng trống</option>
                        <option value="Đã đặt">Đã được đặt</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>

    </div>

</div>
<script>
    var i = 0;
    $('#add').click(function() {

        ++i;
        $('#table').append(
            `<tr>
               
                <td>
                    <input type="text" name="inputs[` + i + `][name_service]" placeholder="Enter your service" class="form-control">
                </td>
                <td>
                    <button type="button" name="add" id="add" class="btn btn-danger remove-input-field">remove</button>
                </td>
            </tr>`);
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>
@endsection
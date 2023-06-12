@extends('layouts.master')

@section('title', 'hotel')


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Hotel</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Hotel</li>
    </ol>
    <div class="row">


    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="">Edit Hotel</h4>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-3">

                    <div class="mb-3">

                        <label for="formFileSm" class="form-label">Images:</label>
                        @foreach ($rooms->images as $item)
                        <form action="{{ url('/deleteimage', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn text-danger">x</button>
                        </form>
                        <img src="{{ '/images/room/' . $item->image }}" width="70" height="70" alt="Image" srcset="">
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-9">
                    <form action="{{ url('update-room/' . $rooms->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $rooms->id }}" class="form-control"
                            id="recipient-name">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label"> Tên phòng:</label>
                            <input type="text" name="name" value="{{ $rooms->name }}" class="form-control"
                                id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Chọn khách sạn:</label>
                            <select name="hotel" class="form-control" id="">
                                @foreach ($hotels as $item)
                                <option value="{{$item->id}}" {{ $rooms->hotel_id == $item->id ? 'selected' : '' }}>
                                    {{$item->id}} / {{$item->name}}
                                </option>

                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Type Room:</label>
                            <select name="typeroom" class="form-control" id="">
                                @foreach ($typeRoom as $item)
                                <option value="{{$item->id}}"
                                    {{ $rooms->type_room_id  == $item->id ? 'selected' : '' }}>{{$item->id}} /
                                    {{$item->name}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Mô tả:</label>
                            <textarea type="text" name="description" class="form-control"
                                id="recipient-name">{{ $rooms->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Images:</label>
                            <input input class="form-control form-control-sm" id="formFiles" type="file" name="images[]"
                                multiple>
                        </div>
                        <div class="mb-3">
                            <table class="table table-bordered " id="table">
                                <tr>
                                    <th>Service</th>
                                    <th>
                                        Action
                                        <button type="button" name="add" id="add" class="btn btn-success">Add</button>
                                    </th>

                                </tr>
                                @if ($rooms && count($rooms->services) > 0)
                                @foreach ($rooms->services as $item)
                                <tr>
                                    <td><input type="text" name="inputs[0][name_service]" value="{{ $item->name }}"
                                            placeholder="Enter your service" class="form-control"></td>
                                    <td>
                                        <form action="{{ url('/deleteserviceRoom', ['service_id' => $item->id]) }}"
                                            method="POST">
                                            @csrf

                                            <input type="hidden" name="_method" value="PUT">
                                            <button type="submit" name="delete" class="btn btn-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Status:</label>
                            <select name="status">
                                <option value="Còn trống" @if($rooms->status == 'Còn trống') selected @endif>Còn phòng
                                    trống</option>
                                <option value="Đã đặt" @if($rooms->status == 'Đã đặt') selected @endif>Đã đặt</option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ url('dashboard') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>

                </div>





            </div>

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
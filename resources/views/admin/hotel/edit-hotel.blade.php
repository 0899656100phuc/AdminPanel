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
            <div class="row">
                <div class="col-lg-3">
                    <div class="mb-3">

                        <img src="{{ '/images/hotel/' . $hotels->image }}" width="70" height="70" alt="Image">
                    </div>
                    <div class="mb-3">
                        @if (count($hotels->images) > 0)
                            <label for="formFileSm" class="form-label">Images:</label>
                            @foreach ($hotels->images as $item)
                                <form action="{{ url('/deleteimage', ['hotel_id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn text-danger">x</button>
                                </form>
                                <img src="{{ '/images/hotel/' . $item->image }}" width="70" height="70"
                                    alt="Image" srcset="">
                            @endforeach
                        @endif
                    </div>
                    
                </div>

                <div class="col-lg-9">
                    <form action="{{ url('update-hotel/' . $hotels->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $hotels->id }}" class="form-control"
                            id="recipient-name">

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" name="name" value="{{ $hotels->name }}" class="form-control"
                                id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="text" name="email" value="{{ $hotels->email }}" class="form-control"
                                id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Address:</label>
                            <input type="text" name="address" value="{{ $hotels->address }}" class="form-control"
                                id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Phone:</label>
                            <input type="text" name="phone" value="{{ $hotels->phone }}" class="form-control"
                                id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Số sao:</label>
                            <input type="number" max="6" min="0" name="star_number"
                                value="{{ $hotels->star_number }}" class="form-control" id="pwd">
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả:</label>
                            <textarea name="description" class="form-control" id="description">{{ $hotels->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Image Cover:</label>
                            <input name="cover_image" value="{{ $hotels->image }}" class="form-control form-control-sm"
                                id="formFiles" type="file">
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
                                        <button type="button" name="add" id="add"
                                            class="btn btn-success">Add</button>
                                    </th>
    
                                </tr>
                                @if ($hotels && count($hotels->services) > 0)
                                @foreach ($hotels->services as $item)
                                    <tr>
                                        <td><input type="text" name="inputs[0][name_service]"
                                                value="{{ $item->name }}" placeholder="Enter your service"
                                                class="form-control"></td>
                                        <td>
                                            <form action="{{ url('/deleteservice', ['service_id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                         
                                                <input type="hidden" name="_method" value="PUT">
                                                <button type="submit" name="delete"
                                                    class="btn btn-danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </table>
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

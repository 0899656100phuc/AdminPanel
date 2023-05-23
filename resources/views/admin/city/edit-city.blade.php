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
                <form action="{{ url('update-city/' . $citys->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <input type="hidden" name="id" value="{{ $citys->id }}" class="form-control"
                        id="recipient-name">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label"> Name:</label>
                        <input type="text" name="name" value="{{ $citys->name }}" class="form-control"
                            id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Sub name:</label>
                        <input type="text" name="sub_name" value="{{ $citys->sub_name }}" class="form-control"
                            id="recipient-name">
                    </div>


                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Image:</label>
                        <input name="image" value="{{ $citys->image }}" class="form-control form-control-sm"
                            id="formFiles" type="file">
                        <img src="{{ '/images/city/' . $citys->image }}" width="70" height="70" alt="Image">
                    </div>


                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('dashboard') }}" class="btn btn-danger">Back</a>

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

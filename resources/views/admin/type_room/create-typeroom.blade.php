@extends('layouts.master')

@section('title','hotel')


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add Type Room</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Type Room</li>
    </ol>
    <div class="row">


    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="">Add Type Room </h4>
        </div>
        <div class="card-body">
            <form action="/create-type-room" method="POST" >
                @csrf
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Name:</label>
                    <input type="text" name="name" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Price:</label>
                    <input type="number" name="price" class="form-control" id="recipient-name">
                </div>
                
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Area:</label>
                    <input type="number" name="area" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Number Of People:</label>
                    <input type="text" name="number_of_people" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Bumber Of Bed:</label>
                    <input type="text" name="number_of_bed" class="form-control" id="recipient-name">
                </div>
                
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url('dashboard')}}" class="btn btn-danger">Back</a>
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
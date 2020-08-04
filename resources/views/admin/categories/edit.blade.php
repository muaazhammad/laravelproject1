@extends('layouts.admin')


@section('content')

    <h1 text-align="center">Create New Category</h1>
    <br>
    @if(session()->has('message'))
        <div class="alert alert-success p-2">

            <p> {{ session()->get('message')}}</p>

        </div>
    @endif

    <div class="col-md-6">
        <form action="/admin/categories/{{$category->id}}" method = "post" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="form-group ">
            <!-- @csrf -->
                <label for="name">Name </label>
                <input type="text" class="form-control" name="name" value = "{{$category->name}}" >
                <br>
            </div>
            <button type="submit" class="btn btn-primary">Edit Category</button>

        </form>
    </div>

@endsection



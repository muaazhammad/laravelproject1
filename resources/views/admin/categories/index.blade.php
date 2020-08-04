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
        <form action="/admin/categories" method = "post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group ">
            <!-- @csrf -->
                <label for="name">Name </label>
                <input type="text" class="form-control" name="name" value = "" >
                <br>
            </div>
                <button type="submit" class="btn btn-primary">Create Category</button>

        </form>
    </div>
    <div class="col-md-6">

        <?php $no=1; ?>
        <h1>All Categories </h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>

                <th scope="col">Name</th>
                <th>Del</th>
            </tr>
            </thead>

            @if($categories)
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row"> {{$no}} </th>
                        <td><a href="{{route('categories.edit', $category->id)}}">{{ $category->name  }}</a></td>
                        <td> <form action="{{route('categories.destroy', $category->id)}}"  method = "POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">Delete</button>

                            </form> </td>
                    </tr>
                    <?php $no++; ?>
                @endforeach
                </tbody>
            @endif
        </table>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection



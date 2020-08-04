@extends('layouts.admin')

@section('content')


<h1 text-align="center">Create New Post</h1>
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-lg-9">
<form action="/admin/posts" method = "post" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group ">

      <label for="name">Post Title </label>
      <input type="text" class="form-control" name="title" value = "" >
       <br>
       <label for="name">Body</label><br>
      <textarea name="body" id="" cols="100" rows="8"></textarea>
    </div>
      <br>
      <br>

        <div class="form-group">
        <label for="user_id">Author</label>
        <select class="form-control" id="exampleSelect1" name = "user_id">
            @foreach($users as $user)
            <option value="{{$user->id}}" >{{$user->name}}</option>
            @endforeach
        </select>
        </div>

        <div class="form-group">
        <label for="user_id">Category</label>
        <select class="form-control"  name = "category_id">
            @foreach($categories as $category)
                <option value="{{$category->id}}" >{{$category->name}}</option>
            @endforeach
        </select>
        </div>

        <label for="file">Upload Photo</label>
        <input type="file" name="file" id="fileToUpload">
        <br>
        <button type="submit" class="btn btn-primary">Create Post</button>

    </form>
</div>



@endsection

@extends('layouts.admin')


@section('content')

<h1>Create New User </h1><br>

@include ('includes.form_error')

<div class="col-lg-9">
<form action="/admin/users" method = "post" enctype="multipart/form-data">

    {{ csrf_field() }}
    <div class="form-group ">
    <!-- @csrf -->

    

      <label for="name">Enter Name </label>
      <input type="text" class="form-control" name="name" value = "" >
       <br>
       <label for="email">Email </label>
      <input type="text" class="form-control" name="email" value = "" >
      <br>
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" value = "" >
      <br>
      <div class="form-group">
      <label for="status">Status</label>
      <select class="form-control" id="exampleSelect1" name = "is_active">
        <option value = '1' >Active</option>
        <option selected value='0'>Not active</option>
      </select>
    </div>
    
   
    <div class="form-group">
      <label for="role_id">Select Role</label>
      <select class="form-control" id="exampleSelect1" name = "role_id">
         @foreach($mcroles as $role)
        <option value ="{{$role->id}}">{{ $role->name }}</option>
         @endforeach
      </select>
    </div> 

    <label for="file">Upload Photo</label>
    <input type="file" name="file" id="fileToUpload">
    <br>

<br>

      
   
    <button type="submit" class="btn btn-primary">Create User</button>
  </fieldset>
</form>

</div>

@endsection



@extends('layouts.admin')


@section('content')

<h1>Edit User </h1><br>

@include ('includes.form_error')

<div class="col-lg-2 ">

<img src="/images/{{$user->photo?$user->photo->file:'userplaceholder.jpeg'}}"  style="width :120px ;   height:120px ; padding-top:5px">
</div>

<div class="col-lg-10">
<form action="/admin/users/{{$user->id}}" method = "post" enctype="multipart/form-data">

    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="form-group ">
    <!-- @csrf -->

    

      <label for="name">Enter Name </label>
      <input type="text" class="form-control" name="name" value = "{{$user->name}}" >
       <br>
       <label for="email">Email </label>
      <input type="text" class="form-control" name="email" value = "{{$user->email}}" >
      <br>
      <!-- <label for="password">Password</label> -->
      <input type="hidden" class="form-control" name="password" value = "{{$user->password}}" >
      <br>
      <div class="form-group"> 
      <label for="status">Status</label>
      <select class="form-control" id="exampleSelect1" name = "is_active">
        <option value = '1' {{ $user->is_active == '1'? 'selected': ''}}>Active</option>
        <option  value='0' {{ $user->is_active == '0'? 'selected': ''}}>Not active</option>
      </select>
    </div>
    
   
    <div class="form-group">
      <label for="role_id">Select Role</label>
      <select class="form-control" id="exampleSelect1" name = "role_id">
         @foreach($mcroles as $role)
        <option value ="{{$role->id}}" {{ $role->id == $user->role_id? 'selected': ''}}>{{ $role->name }}</option>
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



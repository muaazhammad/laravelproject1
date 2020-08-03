@extends('layouts.admin')


@section('content')
@if(session()->has('message'))
<div class="alert alert-success p-2">

  <p> {{ session()->get('message')}}</p>
   
</div>
@endif

<?php $no=1; ?>
<h1>All users </h1><br>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">image</th>
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">Role</th>
      <th scope="col">Status</th>
      <th scope="col">Created at</th>
      <th>Del</th>
    </tr>
  </thead>

  <!-- @if($mcusers) -->
  <tbody>
  @foreach($mcusers as $user)
    <tr>
    <td scope="row"> {{$no}} </td>
      <td> <img height ='40px' width = '60px' src="/images/{{$user->photo?$user->photo->file:'userplaceholder.jpeg'}}" alt=""> </td>
      <td><a href=" {{'/admin/users/'.$user->id.'/edit/'}}">{{ $user->name  }}</a></td>
      <td>{{ $user->email  }}</td>
      <td>{{ $user->role->name }}</td>
      <td>{{ $user->is_active?'Active':'Not Active'}}</td>
      <td>{{ $user->created_at->diffForHumans() }}</td>
      <td> <form action="{{'/admin/users/'.$user->id}}"  method = "POST">
       {{ method_field('DELETE') }}
       {{ csrf_field() }}
       
       <button type="submit" class="btn btn-primary">Delete</button>
      </form> </td>
     
    </tr>
     <?php $no++; ?>
    @endforeach
  </tbody>
  <!-- @endif -->
</table>


@endsection



@extends('layouts.admin')


@section('content')
@if(session()->has('message'))
<div class="alert alert-success p-2">

  <p> {{ session()->get('message')}}</p>

</div>
@endif

<?php $no=1; ?>
<h1>All Posts </h1>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">image</th>
      <th scope="col">Author</th>
      <th scope="col">Category</th>
      <th scope="col">Title</th>
      <th scope="col">Body</th>
      <th>Edit</th>
      <th>Del</th>
    </tr>
  </thead>



    <tbody>

        @foreach($posts as $post)

      <tr>
        <th scope="row"> {{$no}} </th>
          <td> <img height ='40px' width = '60px' src="/images/{{$post->photo?$post->photo->file:'userplaceholder.jpeg'}}" alt=""> </td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->category->name}}</td>
        <td><a href="{{route('posts.edit', $post->id)}}">{{ $post->title}}</a>  </td>
        <td>{{ $post->body }}</td>
        <td> <a class="btn btn-primary" href=" {{'/admin/posts/'.$post->id.'/edit/'}}">Edit</a></td>
        <td> <form action="{{'/admin/posts/'.$post->id}}"  method = "POST">
         {{ method_field('DELETE') }}
         {{ csrf_field() }}

         <button type="submit" class="btn btn-primary">Delete</button>

        </form> </td>
      </tr>
      <?php $no++; ?>
      @endforeach


    </tbody>





</table>


@endsection



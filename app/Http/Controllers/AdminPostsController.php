<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Post;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts= Post::all();
        $user =User::pluck('name');
        return view('admin.posts.index',compact('posts','user') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $users= User::all();
        $categories = Category::all();
        return view('admin/posts/create',compact('users', 'categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        //
        $input= $request->all();
        $photo = new Photo;
        //take photo and save it to directry and database
        if ($request->hasfile('file'))
        {
            $file = $request->file('file');

            $file->move('images',$file->getClientOriginalName());       //image1 is the destination foldrer
            $photo->file = $file->getClientOriginalName();
            $photo->save();
            // echo "file saved";
            $input['photo_id']= $photo->id ;
        }

        Post::create($input);
        // return view('admin/users' ) ;
        session()->flash('message', 'Post Created successfully!');
        return redirect('/admin/posts');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

           $users= User::all();
           $categories = Category::all();
           $post = Post::find($id);
           return view('admin.posts.edit', compact('post','users','categories'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        echo 'update';

        $input= $request->all();
        //take photo and save it to directry and database
        if ($request->hasfile('file'))
        {
            $file = $request->file('file');
            $file->move('images',$file->getClientOriginalName());       //image1 is the destination foldrer
            $photo = new Photo;
            $photo->file = $file->getClientOriginalName();
            $photo->save();
            // echo "file saved";
            $input['photo_id']= $photo->id ;
        }

        $post= Post::findorfail($id);
        $post->update($input);
        // return view('admin/users' ) ;
        session()->flash('message', 'post updated successfully!');
        return redirect('/admin/posts');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::findorfail($id);
        unlink(public_path('/images/'.$post->photo->file));
        $post->destroy($id);
        session()->flash('message', 'user deleted successfully!');
        return redirect('/admin/posts');
        //
    }
}

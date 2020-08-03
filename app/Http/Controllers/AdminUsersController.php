<?php

namespace App\Http\Controllers;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mcusers= User::all();
        return view ('admin.users/index', compact('mcusers' ) ) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $mcroles= Role::pluck('id')->all();
        $mcroles= Role::all();
        return view('admin/users/create',compact('mcroles'));
        // )
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input= $request->all();
        $photo = new Photo;    
        //take photo and save it to directry and databse
        if ($request->hasfile('file'))
        {
                $file = $request->file('file');

                $file->move('images',$file->getClientOriginalName());       //image1 is the destination foldrer
                $photo->file = $file->getClientOriginalName();
                $photo->save();
                // echo "file saved";
                $input['photo_id']= $photo->id ;
        }
        else {
            //   echo "no file";
        }
   
        $input['password']=bcrypt($request->password);
        User::create($input);
        // return view('admin/users' ) ;
        session()->flash('message', 'user Created successfully!');
        return redirect('/admin/users');


        // return $input;
        
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

        $user = User::find($id);
        $mcroles= Role::all();

        return view ('admin/users/edit', compact('user','mcroles') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $user = User::find($id);
        $input= $request->except('password');    //we dont update the passwaord it is same as previous
        // $input = $request->all();
        if ($request->hasfile('file'))
        {
                $file = $request->file('file');
                $file->move('images',$file->getClientOriginalName());  //image1 is the destination foldrer
                $photo = new Photo;        
                $photo->file = $file->getClientOriginalName();
                $photo->save();
                // echo "file saved";
                $input['photo_id']= $photo->id ;
        }
        else {
            //   echo "no file";
        }
   
        // $input['password']=bcrypt($request->password);
        $user->update($input);
        session()->flash('message', 'user Updated successfully!');
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        unlink(public_path('/images/'.$user->photo->file));
        $user->destroy($id);
        session()->flash('message', 'user deleted successfully!');
        return redirect('/admin/users');
    }
}

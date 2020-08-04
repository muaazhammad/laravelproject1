<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class adminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        session()->flash('message', 'category added successfully!');
        return redirect('admin/categories');

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
        $category= Category::find($id);
        return view ('admin.categories.edit',compact('category'));
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

        $category = Category::find($id);
        $category->update($request->all());
        session()->flash('message', 'category updated successfully!');
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//        $category= Category::findorfail($id);
//        $category->destroy($id);
//        session()->flash('message', 'category deleted successfully!');
//        return redirect('admin/categories');
        //

        $category= Category::findorfail($id);
        if($category->post->count()>0){
            session()->flash('message', 'Cannot delete a category which is linked to posts ');
            return redirect('admin/categories');
        }
        else {
            $category->destroy($id);
            session()->flash('message', 'category deleted successfully!');
            return redirect('admin/categories');
        }
    }
}

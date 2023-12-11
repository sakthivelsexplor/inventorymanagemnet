<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories= Category::get();
        return Response::json([
            'Data'=>$Categories,
            'Success'=>True
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $Category = new Category;
        $Category->Name =  $request->Name;
        $Category->Description =$request->Description;
        $Category->save();

        return Response::json([
            'InsertID'=>$Category->id,
            'Success'=>True
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Category = Category::find($id);
        if($Category){
            return Response::json([
                'Data'=>$Category,
                'Success'=>True
            ]);

        }else{
            return Response::json([
                'Data'=>$Category,
                'Success'=>False,
                'Message'=>'Category not found'
            ]);
            
        }
    }

   

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(CategoryRequest $request, $id)
    {
        $Category = Category::find($id);
        if($Category){
            $Category->Name =  $request->Name;
            $Category->Description =$request->Description;
            $Category->save();

            return Response::json([
                'UpdateID'=>$Category->id,
                'Success'=>True
            ]);

        }else{

            return Response::json([
                'Data'=>$Category,
                'Success'=>False,
                'Message'=>'Category not found'
            ]);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Category = Category::find($id);
        if($Category){
            $Category->delete();
            return Response::json([
                'Message'=>'Deleted successfully',
                'Success'=>True
            ]);

        }else{
            return Response::json([
                'Message'=>'Deleted Failed',
                'Success'=> False
            ]);
        }
    }
}

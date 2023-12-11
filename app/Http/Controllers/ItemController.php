<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Http\Requests\ItemRequest;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Items= Item::with(['category.details'])->get();
        return Response::json([
            'Data'=>$Items,
            'Success'=>True
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $Item = new Item;
        $Item->Name =  $request->Name;
        $Item->Description =$request->Description;
        $Item->Price =$request->Price;
        $Item->Quantity =$request->Quantity;
        $Item->save();

        $CategoryIdsArr =[];
        $Categories = $request->CategoryID;
        foreach($Categories as $category){
            $CategoryIdsArr[]=[
                'ItemID'=>$Item->id,
                'CategoryID'=>$category

            ] ;
        }

        if(sizeof($CategoryIdsArr)){
            ItemCategory::insert($CategoryIdsArr);
        }

        return Response::json([
            'InsertID'=>$Item->id,
            'Success'=>True
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Item = Item::with('category.details')->find($id);
        if($Item){
            return Response::json([
                'Data'=>$Item,
                'Success'=>True
            ]);

        }else{
            return Response::json([
                'Data'=>$Item,
                'Success'=>False,
                'Message'=>'Item not found'
            ]);
            
        }
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
        $Item = Item::find($id);
        if($Item){
            $Item->Name =  $request->Name;
            $Item->Description =$request->Description;
            $Item->Price =$request->Price;
            $Item->Quantity =$request->Quantity;
            $Item->save();

            $CategoryIdsArr =[];
            $Categories = $request->CategoryID;
            foreach($Categories as $category){
                $CategoryIdsArr[]=[
                    'ItemID'=>$Item->id,
                    'CategoryID'=>$category

                ] ;
            }

            if(sizeof($CategoryIdsArr)){
                ItemCategory::insert($CategoryIdsArr);
            }


            return Response::json([
                'UpdateID'=>$Item->id,
                'Success'=>True,
                'Message'=>'Updated successfully'
            ]);

        }else{

            return Response::json([
                'Data'=>$Item,
                'Success'=>False,
                'Message'=>'Updated failed'
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Item = Item::find($id);
        if($Item){
            $Item->delete();
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

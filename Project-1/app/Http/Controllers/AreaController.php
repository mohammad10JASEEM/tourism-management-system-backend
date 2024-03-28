<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area=Area::get();
        return response()->json([
            'data'=>$area
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
        $validatedData = Validator::make($request->all(),[
            'name' => ['required', 'unique:areas', 'alpha'],
            'country_id'=>['required','exists:countries,id']
        ]);
        if( $validatedData->fails() ){
            return response()->json([
                'message'=> $validatedData->errors()->first(),
            ],422);
        }
    $area= Area::Create([
        'name'=>$request->name,
        'country_id'=>$request->country_id
    ]);
    return response()->json([
        'message'=>"succesfully",
        'data'=>$area
        ],200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
        $area=Area::findOrFail($id);}
        catch(\Exception $exception){
            return response()->json([
                'message'=>'Not Found'
            ],404);
        }
        return response()->json([
          'data'=>Area::with(['country'])->where('id',$area->id)->get()
        ],200);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        try{
        $area=Area::findOrFail($id);
        }catch(\Exception $exception){
            return response()->json([
                'message'=>'Not Found'
            ],404);
        }
        $validatedData = Validator::make($request->all(),[
            'name' => ['required', 'unique:areas', 'alpha'],
            'country_id'=>['required','exists:countries,id']
        ]);
        if( $validatedData->fails() ){
            return response()->json([
                'message'=> $validatedData->errors()->first(),
            ],422);
        }

        $area->name=$request->name;
        $area->country_id=$request->country_id;
        $area->save();
        return response()->json([
            'message'=>'update succesfully',
            'data'=>$area
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
        Area::findOrFail($id)->delete();
        }catch(\Exception $exception){
            return response()->json([
                'message'=>'Not Found'
            ],404);
        }
        return response()->json([
            'message'=>'delete done!!'
        ],200);
    }
}

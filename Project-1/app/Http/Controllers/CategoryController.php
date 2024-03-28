<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category=Category::get();
        return response()->json([
            'data'=>$category
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validatedData = FacadesValidator::make($request->all(),[
            'name' => ['required', 'unique:categories', 'alpha']
        ]);
        if( $validatedData->fails() ){
            return response()->json([
                'message'=> $validatedData->errors()->first(),
            ],422);
        }
        $category= Category::Create([
            'name'=>$request->name,
        ]);
        return response()->json([
            'message'=>"succesfully",
            'data'=>$category
            ],200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
        $category=Category::findOrFail($id);
        }catch(\Exception $exception){
            return response()->json([
                'message'=>'Not Found'
            ],404);
        }
        return response()->json([
          'data'=>$category
        ],200);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        try{
        $country=Category::findOrFail($id);
    }catch(\Exception $exception){
        return response()->json([
            'message'=>'Not Found'
        ],404);
    }
    $validatedData = FacadesValidator::make($request->all(),[
        'name' => ['required', 'unique:categories', 'alpha']
    ]);
    if( $validatedData->fails() ){
        return response()->json([
            'message'=> $validatedData->errors()->first(),
        ],422);
    }
        $country->name=$request->name;
        $country->save();
    
        return response()->json([
            'message'=>'update succesfully',
            'data'=>$country
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
        Category::findOrFail($id)->delete();
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

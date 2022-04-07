<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            // 'message' => "Ok",
            'data' => Restaurant::all()
        ], 200);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'grade' => 'required',
            'localization' => 'required',
            'phone_number' => 'required',
            'website' => 'required',
            'hours' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "error",
            ], 400);
        } else {
            $restaurant = Restaurant::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'grade' => $request['grade'],
                'localization' => $request['localization'],
                'phone_number' => $request['phone_number'],
                'website' => $request['website'],
                'hours' => $request['hours'],
            ]);
            return response()->json([
                'message' => "Ok",
                'data' => $restaurant
            ], 201);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);

        if ($restaurant == NULL) {
            return response()->json([
                'message' => "Restaurant not found !",
            ], 400);
        } else {
            return response()->json([
                'message' => "Restaurant not found !",
                'data' => $restaurant
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);

        if ($restaurant == NULL) {
            return response()->json([
                'message' => "Restaurant not found !",
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'grade' => 'required|numeric',
            'localization' => 'required',
            'phone_number' => 'required',
            'website' => 'required',
            'hours' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Empty field",
            ], 400);
        } else {
            $restaurant->update($request->all());
            return response()->json([
                'message' => "Ok",
                'data' => $restaurant
            ], 200);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);

        if ($restaurant == NULL) {
            return response()->json([
                'message' => "Restaurant not found !",
            ], 400);
        } else {
            $restaurant->delete();

            return response()->json([
                'message' => "Restaurant deleted with success !",
                'data' => $restaurant
            ], 200);;
        }
    }
}

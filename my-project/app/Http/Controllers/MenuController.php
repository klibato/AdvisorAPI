<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => "Menus of restaurant",
            'data' => Menu::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string', 'max:255',
            'description' => 'required', 'string', 'max:255',
            'price' => 'required', 'integer',
        ]);
        $restaurant = Restaurant::find($id);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Empty field ! ",
            ], 400);
        } else {
            $menu = Menu::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'restaurants_id' => $id
            ]);
            return response()->json([
                'message' => "This menu is created",
                'data' => $menu
            ], 201);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $id)
    {
        $restaurant = Restaurant::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $restaurantId, $menuId)
    {
        $restaurant = Restaurant::find($restaurantId);

        if ($restaurant == NULL) {
            return response()->json([
                'message' => "Restaurant not found !",
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string', 'max:255',
            'description' => 'required', 'string', 'max:255',
            'price' => 'required', 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "empty field",
            ], 400);
        } else {
            $menu = Menu::find($menuId);
            if (!$menu) {
                return response()->json([
                    'message' => "Do not troll",
                ], 400);
            } else {
                Menu::select('id')->where('id', $menuId)->update($request->all());

                return response()->json([
                    'message' => "This menu is updated",
                    'data' => $menu
                ], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $restaurantId, $menuId)
    {
        $restaurant = Restaurant::find($restaurantId);

        if ($restaurant == NULL) {
            return response()->json([
                'message' => "Restaurant not found !",
            ], 400);
        }
        $menu = Menu::find($menuId);
        if (!$menu) {
            return response()->json([
                'message' => "Do not troll",
            ], 400);
        } else {
            Menu::select('id')->where('id', $menuId)->delete($request->all());

            return response()->json([
                'message' => "This menu is deleted",
                'data' => $menu
            ], 200);
        }
    }
}

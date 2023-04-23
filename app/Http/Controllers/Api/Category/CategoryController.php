<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cat = Category::orderBy('id', 'desc')->get();
        return Response::json($cat);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $count= count($request->names);

        for ($i = 0; $i < $count; $i++){

            $category = new Category();
            $category->name = $request->names[$i]['name'];
            $category->save();
        }

        return Response::json('Category inserted successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cat = Category::find($id);

        return Response::json($cat);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cat = Category::find($id);
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$cat->id
        ]);

        $cat->name = $request->name;
        $cat->save();

        return Response::json('Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cat = Category::find($id);
        $cat->delete();
        return Response::json('Category deleted successfully!');
    }
}

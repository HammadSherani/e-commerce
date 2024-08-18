<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        // echo "prev";
        // print_r($category);
        return view('admin.subcategory', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:sub_category',
            'category_id' => 'required',
            'status' => 'required',

        ]);

        if (!empty($validator)) {
            $category = new SubCategory();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->category_id = $request->category_id;
            $category->status = $request->status;
            $category->save();
            return response()->json(['success' => 'SubCategory Added successfully.']);
        }


        $request->session()->flash('success', 'SubCategory Added successfully.');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

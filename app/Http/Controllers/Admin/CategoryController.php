<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $category_list = Category::all()::paginate(5);

        $category_list = DB::table('category')->paginate(5);
        // Pass the data to the view using compact
        return view('admin.category.index', compact('category_list'));
        // return view("admin.category.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:category', // Assuming the table is 'categories'
        ]);

        if ($validator->passes()) {
            // Your logic here if validation passes

            $data = new Category();
            $data->name = $request->name;
            $data->slug = $request->slug;
            $data->status = $request->status;
            $data->save();

            session()->flash('success', 'Your post has been created successfully!');

            // return response()->json([
            //     'status' => true,
            //     'message' => 'Validation passed',
            // ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }


        // return redirect()->route('admin.category.index');

       
        




        // $category_list = Category::all();
        // return redirect()->route('admin.category.index')->with('category_list', $category_list);

        // $category_list  = Category->get();
        // return redirect()->route("admin.category.index" ,compact('category_list'));  


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
    public function destroy($id, Request $request)
    {
        $category = Category::find($id);
        $category->delete();

        // if ($category) {
        //     $category->delete();
        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Category deleted successfully',
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Category not found',
        //     ]);
        // }


        
    }
}

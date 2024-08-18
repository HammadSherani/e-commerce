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
    public function index(Request $request)
    {

        // $category_list = Category::all()::paginate(5);
        $search = $request['table_search'] ?? '';

        if (!empty($search)) {
            $category_list = DB::table('category')->where('name', '=', $search)->get();
        } else {
            $category_list = Category::all();
        }

        $category_list = DB::table('category')->paginate(5);

        return view('admin.category.index', compact('category_list', 'search'));
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

            $request->session()->flash('success', 'Your post has been created successfully!');

            return response()->json([
                'status' => true,
                'message' => 'Validation passed',
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
    public function edit($categoryId, Request $request)
    {
        $category = Category::find($categoryId);

        if(empty($category)){
        return redirect()->route('admin.category.index');

        }else {

        return view('admin.category.edit', compact('category'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if(empty($category)){
        return response()->json([
            "status" => false,
            'notFound' => true,
            "message" => "Category not found",
        ]);
        };
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:category', // Assuming the table is 'categories'
        ]);

        if ($validator->passes()) {
            // Your logic here if validation passes
            
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();
            
            
            return response()->json([
                'status' => true,
                'message' => 'Validation passed',
            ]);
        }
        // return view('admin.category.edit', compact('category'));
        // $request->session()->flash('success', 'Your post has been Updated successfully!');


        // echo "update";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId, Request $request)
    {
        // dd($categoryId);
        $category = Category::find($categoryId);
        $category->delete();

        $request->session()->flash('success', 'Your post has been deleted successfully!');
        return redirect()->route('admin.category.index');



    }
}

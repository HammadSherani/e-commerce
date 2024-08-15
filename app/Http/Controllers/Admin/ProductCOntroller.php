<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Get the search value from the request
        $search = $request['search'] ?? '';

        // Perform the query with pagination
        if(!empty($search)){
            $product_list = DB::table('products')->where('name', '=', $search)->get();
        }else {
            $product_list = Product::all();
        }
        
        return view("admin.products.index", compact('product_list', 'search'));
        // $product_list = DB::table('products')->paginate(5);

        // $search = $request->input('search');

        // Perform the query with pagination
        // $product_list  = Product::when($search, function ($query) use ($search) {
        //     return $query->where('name', 'like', '%' . $search . '%')
        //                  ->orWhere('email', 'like', '%' . $search . '%');
        // })->paginate(5); // Adjust the number per page as needed

        // return view('admin.products.index', compact('product_list', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'sku' => 'required',
            'status' => 'required',
        ]);


        // echo "<prev>";
        // print_r($validator);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('admin.products.index');

    }



    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('admin.products.create');
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

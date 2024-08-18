<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminLoginController extends Controller
{
    public function index() {
        return view('admin.login');
    }

    public function authenticator(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]); 

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }else {
            // return back()->withErrors(['email' => 'Email Not Found']);
            $request->session()->flash('error', 'Please Enter Correct Email and Password');
             return redirect()->route('admin.login');
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

     public function category(){
        return view('admin.category');
    }
    //  public function subcategory(){
    //     $category = Category::orderBy('Name', 'asc')->get();
    //     return view('admin.subcategory');   
    // }
    //  public function brands(){
    //     $brands_list = DB::table('category')->paginate(3);
    //     return view('admin.brands.index', compact('brands_list'));


    //     // return view('admin.brands.index');   
    // }
     
     public function orders(){
        return view('admin.orders');   
    }
     public function discounts(){
        return view('admin.discounts');   
    }
     public function users(){
        return view('admin.users');   
    }
     public function pages(){
        return view('admin.pages');   
    }


};

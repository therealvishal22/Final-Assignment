<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Login as LoginEvents;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = User::latest()->paginate(3);
    
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 3);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:15|unique:users',
            'email' => 'required|email',
            'password' => 'required',
            'gender' => 'required',
            'hobbies' => 'required',
        ]);

       

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->hobbies = $request->hobbies;
        $user->password = Hash::make($request->password);
        $user->save();
        $password = Hash::make('password');
        return redirect()->route('products.index')->with('success', 'Admin Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $product
     * @return \Illuminate\Http\Response
     */
    public function show(User $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(User $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $product)
    {
        $request->validate
        ([
            'name' => 'required',
            'gender' => 'required',
            'hobbies' => 'required',
            'email' => 'required',
            // 'password' => 'required',

        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Admin Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Admin Deleted Successfully');
    }
}

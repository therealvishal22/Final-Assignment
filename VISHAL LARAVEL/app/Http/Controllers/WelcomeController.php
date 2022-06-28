<?php

namespace App\Http\Controllers;
use App\Models\Sample;
use App\Models\Category;
use App\Models\User;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $sample = Sample::latest()->paginate(30);
        $jay = Category :: get('name');
        return view('welcome',compact('sample','jay'))
            ->with('i', (request()->input('page', 1) - 1) * 30);
    }

 
    public function filterProduct(Request $request)
    {
        $query = Sample::query();
        $categories = Category::all();
        if ($request->ajax()) {
            if (empty($request->category)) {
                $products = $query->get();
            }
            else
            {
            $products = $query->where(['category' => $request->category])->get();
            }
            return response()->json($products);
        }
    }
}

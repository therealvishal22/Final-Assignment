<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Sample;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class SmapleController extends Controller
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
        $sample = Sample::where('active','yes')->latest()->paginate(3);
    
        return view('sample.index',compact('sample'))
            ->with('i', (request()->input('page', 1) - 1) * 3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $cat = Category::where('active','yes')->get('name');
        return view('sample.create',compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate
        ([
             'name' => 'required',
             'category' => 'required',
             'image' => 'required',
             'created_by' => 'required',
             'active' => 'required',
        
        ]);

        // $input = $request->all();
       
        // Sample::create($input);

         $sample = new Sample;

        // if($request->file('images')) 
        // {

        
            $imageName = time().'.'.$request->file('image')->extension();
            $request->image->move(public_path('./public/images/'), $imageName);
            $sample=$request->all();
            $sample['image'] = $imageName;
        // }    
             Sample::create($sample);

        return redirect()->route('sample.index')
                        ->with('success','Product Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return view('sample.show',compact('samples'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sample $sample)
    {
        $jay = Category :: get('name');
        return view('sample.edit',compact('sample','jay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Sample $sample,Request $request)
    {
        $request->validate
        ([
             'name' => 'required',
             'category' => 'required',
             'image' => 'required',
             'created_by' => 'required',
             'active' => 'required',
        
        ]);
       
        if(!empty($request->image))
        {
            // unlink(public_path('images',$sample->image));

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('./public/images/'), $imageName);

            $sample->name = $request->name;

            $sample->category = $request->category;

            $sample->active = $request->active;
            $sample['image'] = $imageName;
            
        $sample->update();

        return redirect()->route('sample.index') ->with('success','Product Updated Successfully');
        }
        else
        {
            $sample->name = $request->name;
            $sample->category = $request->category;
            $sample->active = $request->active;
            $sample->update();

            return redirect('products') ->with('success','Post created successfully.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $sample)
    {
        $sample->delete();
        return redirect()->route('sample.index')
                        ->with('success','Product Deleted Successfully');
    }
}

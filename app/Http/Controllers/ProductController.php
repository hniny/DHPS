<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = new Product;
        $details = $query->pluck('detail','id');
        // dd($details);
        if(isset($request->name)){
            // dd($request->name);
        $query = $query->where('name','like','%'.$request->name.'%');
        // dd($name);
        }
        if (isset($request->detail)) {
            // dd($request->detail);
            $query = $query->where('detail',$request->detail);
        }
        $products = $query->latest()->paginate(5);
        return view('products.index',compact('products','details'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->withTitle('Products')
            ->withName($request->name)
            ->withDetail($request->detail);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create')->withTitle('Create New Product');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $product = new Product();
        $product->name = $request->name;
        $product->detail = $request->detail;
		 $product->price = $request->price;
        if ($request->hasfile('image')) {
                $file = $request->image;
                $destinationPath ='uploads';
                $file->move($destinationPath,$file->getClientOriginalName());
                $product->image = $file->getClientOriginalName();
            } 

        $product->save();
            return redirect()->route('products.index')
                            ->with('success','Product created successfully.');
       
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->detail = $request->detail;
         $product->price = $request->price;
        if ($request->hasfile('image')) {
            $file = $request->image;
            $destinationPath ='uploads';
            $file->move($destinationPath,$file->getClientOriginalName());
            $product->image = $file->getClientOriginalName();
        } 
        $product->save();
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}

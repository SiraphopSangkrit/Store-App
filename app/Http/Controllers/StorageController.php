<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function StorageIndex()
    {
        return Inertia::render(
            'Storages/List',[
                'products'=>Product::with('category')->get(),
                'categories'=> Category::all()
            ]
        );
    }

    public function CategoryIndex()
    {
        return Inertia::render(
            'Category/Category',[
                'categories'=> Category::all()
            ]);
    }
    public function CategoryStore(Request $request)
    {
        $category = new Category;
        $category->title=$request->input('cname');
$category->create_by_user=$request->user()->id;
$category->save();
        return back()->with('message', 'Category added successfully');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StorageStore(Request $request)
    {
        $product = new Product;
        $product->product_name=$request->input('pname');
        $product->product_color=$request->input('pcolor');
        $product->product_price=$request->input('pprice');
        $product->product_image=$request->input('pimage');
        $product->category_id=$request->input('cid');
        $product->product_qty=$request->input('pqty');
        $product->create_by_user=$request->user()->id;
        $product->save();
        return back();
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

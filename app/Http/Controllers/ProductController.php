<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{

    public function index()
    {
        // Get All products
        $products = Product::all();
        return response()->json($products);

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'notes' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'price' => 'required'
         ]);

        $product = new Product();

        // image upload
        if($request->hasFile('photo')) {

        $allowedfileExtension=['pdf','jpg','png'];
        $file = $request->file('photo');
        $extenstion = $file->getClientOriginalExtension();
        $check = in_array($extenstion, $allowedfileExtension);

        if($check){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $product->photo = $name;
        }
        }


        // text data
        $product->notes = $request->input('notes');
        $product->notesprice = $request->input('notes price');
        $product->notesdescription = $request->input('notes description');

        $product->save();
        return response()->json($product);


    }


    public function show($id)
    {
        
        // show each product by its ID from database
        $product = Product::find($id);
        return response()->json($product);
    }


    public function update(Request $request, $id)
    {
        // PUT(id)
        // Update Info by Id

        $this->validate($request, [
            'notes' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'price' => 'required'
         ]);

        $product = Product::find($id);


        // image upload
        if($request->hasFile('photo')) {

            $allowedfileExtension=['pdf','jpg','png'];
            $file = $request->file('photo');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $product->photo = $name;
            }
            }
        // text Data
        $product->notes = $request->input('notes');
        $product->notesprice = $request->input('notesprice');
        $product->notesdescription = $request->input('notesdescription');

        $product->save();

        return response()->json($product);

    }


    public function destroy($id)
    {
        // DELETE(id)
        // Delete by Id
        $product = Product::find($id);
        $product->delete();
        return response()->json('Product Deleted Successfully');

    }
}
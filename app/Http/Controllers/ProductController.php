<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {

         $products = Product::all();
        return view('products', compact('products'));
    }


    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Name is Required',
            'name.unique' => 'Product Already Exists',
            'price.required' => 'Price is Required',
            'image.required' => 'Image is Required',
            'image.mimes' => 'Uploaded image should be of type jpeg, png, jpg, or gif',
            'image.max' => 'Uploaded image should not be larger than 2MB',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return response()->json([
           'status' => 'success',
        ]);
    }


    public function updateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name,'.$request->id,
            'price' => 'required',
            'image' => 'nullable',
        ], [
            'name.required' => 'Name is Required',
            'name.unique' => 'Product Already Exists',
            'price.required' => 'Price is Required',
            'image.required' => 'Image is Required',
            'image.mimes' => 'Uploaded image should be of type jpeg, png, jpg, or gif',
            'image.max' => 'Uploaded image should not be larger than 2MB',
        ]);

        $product =Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time().'.'.$image->getClientOriginalExtension();
        //     $image->move(public_path('uploads'), $imageName);
        //     if ($product->image && file_exists(public_path('uploads'.$product->image))) {
        //         unlink(public_path('uploads'.$product->image));
        //     }
        //     $product->image = $imageName;
        // }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $Image = Product::where('id',$request->id)->first();
            // unlink(public_path('uploads/'.$Image->image));
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('uploads/'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return response()->json([
           'status' => 'success',
        ]);
    }




    // public function edit($id){
    //     $product = Product::findOrFail($id);
    //     $imagePath = asset('/uploads/' . $product->image);
    //     $product->image_path = $imagePath;
    //     return response()->json($product);
    // }

    public function edit($id) {
        $data = Product::findOrFail($id);
        return response()->json($data);
    }

    // public function updateProduct(Request $request)
    // {
    //     $request->validate(
    //         [
    //             'up_name' => 'required|unique:products,name,'.$request->up_id,
    //             'up_price' => 'required',
    //         ],
    //         [
    //             'up_name.required' => 'Name is Required',
    //             'up_price.unique' => 'Product Already Exists',
    //             'up_price.required' => 'Name is Required',
    //         ]
    //     );
    //     Product::where('id',$request->up_id)->update([
    //         'name'=>$request->up_name,
    //         'price'=>$request->up_price,
    //     ]);
    //     return response()->json([
    //         'status' => 'success',
    //     ]);
    // }


//     public function updateProduct(Request $request)
// {
//     $request->validate([
//         'up_name' => 'required|unique:products,name,'.$request->up_id,
//         'up_price' => 'required',
//         'up_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ], [
//         'up_name.required' => 'Name is required',
//         'up_name.unique' => 'Product name already exists',
//         'up_price.required' => 'Price is required',
//         'up_image.image' => 'Uploaded file is not an image',
//         'up_image.mimes' => 'Uploaded image should be of type jpeg, png, jpg, or gif',
//         'up_image.max' => 'Uploaded image should not be larger than 2MB',
//     ]);

//     $productww = Product::findOrFail($request->up_id);
//     $productww->name = $request->up_name;
//     $productww->price = $request->up_price;

//     if ($request->hasFile('up_image')) {
//         $image = $request->file('up_image');
//         $imageName = time().'.'.$image->getClientOriginalExtension();
//         $image->move(public_path('uploads'), $imageName);
//         $productww->image = $imageName;
//     }

//     $product->save();

//     return response()->json([
//         'status' => 'success',
//     ]);
// }
    public function deleteProduct(Request $request)
    {
        Product::find($request->product_id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

public function pagination(Request $request)
{
    $products = Product::latest()->paginate(5);
    return view('pagination_products', compact('products'))->render();
}

public function searchProduct(Request $request)
{
    $products = Product::where('name', 'like', '%'.$request->search_string.'%')
    ->orWhere('price', 'like', '%'.$request->search_string.'%')
    ->paginate(5);

    if ($products->count() >= 1){
        return view('pagination_products', compact('products'))->render();
    }else
    {
        return  response()->json([
            'status' => 'nothing_found',
        ]);
    }
}
}

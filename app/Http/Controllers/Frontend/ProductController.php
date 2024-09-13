<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PHPUnit\Framework\Constraint\Count;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    //
    public function showProduct(){
        $products = Product::where('id_user',Auth::id())->get();
        // dd($products);
        return view('frontend.product.my-product',['products'=>$products]);
    }
    public function deleteProduct($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back();
        // dd($products);
    }
    public function showFormCreate(){
        $brands = Brand::all();
        $categories = Category::all();
        return view('frontend.product.form-add-product',['brands'=>$brands,'categories'=>$categories]);
    }

    private function uploadImages($files, $imageNames){
        foreach($files as $file){
            $path = public_path('frontend/images/products/');
            $ext = $file->getClientOriginalExtension();
            $imageName = time().rand(1000, 9999).'.'.$ext;
            // Full Size
            $file->move($path, $imageName);

            $manager = new ImageManager(new Driver());
            $image = $manager->read($path.$imageName);
            // Small Size 85x84
            $imageSmall = $image->cover(85,84);
            $pathSmall = public_path('frontend/images/products/small/');
            $imageSmall->save($pathSmall.$imageName);

            // Medium Size 329x380
            $imageMedium = $image->cover(329,380);
            $pathMedium = public_path('frontend/images/products/medium/');
            $imageMedium->save($pathMedium.$imageName);

            array_push($imageNames, $imageName);
        }
        return $imageNames;
    }


    public function createProduct(ProductRequest $request){
        $data = $request->all();
        $data['id_user'] = Auth::id();
        // dd($request->all());
        $imageNames = [];
        if($request->hasFile('images')){
            $imageNames = $this->uploadImages($request->file('images'),$imageNames);
            // foreach($request->file('images') as $file){
            //     $path = public_path('frontend/images/products/');
            //     $ext = $file->getClientOriginalExtension();
            //     $imageName = time().rand(1000, 9999).'.'.$ext;
            //     // Full Size
            //     $file->move($path, $imageName);

            //     $manager = new ImageManager(new Driver());
            //     $image = $manager->read($path.$imageName);
            //     // Small Size 85x84
            //     $imageSmall = $image->cover(85,84);
            //     $pathSmall = public_path('frontend/images/products/small/');
            //     $imageSmall->save($pathSmall.$imageName);

            //     // Medium Size 329x380
            //     $imageMedium = $image->cover(329,380);
            //     $pathMedium = public_path('frontend/images/products/medium/');
            //     $imageMedium->save($pathMedium.$imageName);

            //     array_push($imageNames, $imageName);
            // }
            $imageNamesJson = json_encode($imageNames);
            $data['images'] = $imageNamesJson;

        }
        // dd($data);
        Product::create($data);
        return redirect('/my-product')->with('success','Add Finished!!');


    }

    public function showFormEdit($id){
        $product = Product::findOrFail($id);
        
        // dd($product->images);
        // dd($product->first_image);
        $brands = Brand::all();
        $categories = Category::all();
        return view('frontend.product.form-edit',['product'=>$product,'brands'=>$brands,'categories'=>$categories]);
    }
    public function update(ProductRequest $request, $id){
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->id_category = $request->id_category;
        $product->id_brand = $request->id_brand;
        $product->option = $request->option;
        $product->discount_percentage = $request->discount_percentage;
        $product->company = $request->company;
        $product->detail = $request->detail;
        $product->id_user = Auth::id();
        $currentImages = json_decode($product->images);
        $imagesRemoveCount = $request->images_to_remove ? count($request->images_to_remove) : 0;
        $newImagesCount = $request->hasFile('images') ? count($request->file('images')) : 0;
        $updatedImagesCount = count($currentImages)-$imagesRemoveCount+$newImagesCount;
        if($updatedImagesCount > 3){
            return back()->with('success','Khong Duoc Vuot Qua 3 Anh!');
        }
        $currentImages = json_decode($product->images);
        $imagesRemove = $request->images_to_remove;
        if($imagesRemoveCount>0){
            // dd("true");
            foreach($currentImages as $key => $value){
                if(in_array($value,$imagesRemove)){
                    unlink(public_path('frontend/images/products/'.$value));
                    unlink(public_path('frontend/images/products/small/'.$value));
                    unlink(public_path('frontend/images/products/medium/'.$value));
                    unset($currentImages[$key]);
                }
            }
            $currentImages = array_values($currentImages);
        }
        if($request->hasFile('images')){
            $currentImages = $this->uploadImages($request->file('images'),$currentImages);
        }
        // dd($currentImages);

        $product->images = json_encode($currentImages);

        $product->save();

        return back()->with('success','Update Finished!');
        // dd($updatedImagesCount);
        
    }

    public function productDetail($id){
        $product = Product::findOrFail($id);
        $product->images = json_decode($product->images, true);
        

        return view('frontend.product.product-detail',['product'=>$product]);
    }
}

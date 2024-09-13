<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Brand;
use App\Models\Category;

class HomeController extends Controller
{
    //
    public function index(){
        $newProducts = Product::orderBy('created_at','desc')->take(6)->get();
        // dd($newProducts->images);
        $brands = Brand::all();
        $categories = Category::all();
        $totalQTY = array_sum(array_column(session()->get('cart',[]),'qty'));
        return view('frontend.index',['newProducts'=>$newProducts,'totalQTY'=>$totalQTY, 'brands'=>$brands, 'categories'=>$categories]);
    }
    public function addToCart(Request $request){
        // if(!Auth::check()){
        //     return response()->json(['error'=>'Vui lòng đăng nhập để add to cart']);
        // }
        // session()->forget('cart');
        $productID = $request->product_id;
        $name = $request->name;
        $image = $request->image;
        $price = $request->price;
        // dd($request->all());
        // (1) Nếu rỗng thì không có dấu [] trả về null, nếu có thì trả về 1 mảng rỗng
        $cart = session()->get('cart',[]); // (1)
        if(isset($cart[$productID])){
            $cart[$productID]['qty']++;
        }else{
            $cart[$productID] = [
                'name'=> $name,
                'qty'=> 1,
                'image'=> $image,
                'price'=> $price,
            ];
        }
        session()->put('cart',$cart);
        // $totalQTY = array_sum(array_column($cart,'qty'));
        return response()->json(['success'=>'Add session finished!!!']);
    }

    //====================== Search by name ======================//
    public function searchByName(Request $request){
        $search = $request->search;
        // dd($search);
        $products = Product::where('name','like','%'.$search.'%')->get();
        // dd($products->all());
        $output = "";
        foreach($products as $product){
            // echo $value->name;
            // echo '<br>';
            $image = json_decode($product->images);
            // dd($image[0]);
            $output .= "
                            <div class='col-sm-4'>
                                <div class='product-image-wrapper'>
                                    <div class='single-products'>
                                        <div class='productinfo text-center'>
                                            <img class='image-product' src='" . asset('frontend/images/products/' . $image[0]) . "' alt='' />
                                            <h2 class='price-product' data-price-product='" . $product->price . "'>$$product->price </h2>
                                            <p class='name-product'> $product->name </p>
                                            <a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
                                        </div>
                                        <div class='product-overlay'>
                                            <div class='overlay-content'>
                                                <h2>$ $product->price </h2>
                                                <p> $product->name </p>
                                                <a id='btn-add-to-cart' data-id-product='" . $product->id . "' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='choose'>
                                        <ul class='nav nav-pills nav-justified'>
                                            <li><a href='product-details/ $product->id '><i class='fa fa-plus-square'></i>Product Detail</a></li>
                                            <li><a href='#'><i class='fa fa-plus-square'></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        ";
        }
        
        return $output != '' ?  response($output) : response("Không tìm thấy sản phẩm");
    }

    // ====================== Menu Search ======================//

    public function searchByMenuSearch(Request $request)
    {
        $totalQTY = array_sum(array_column(session()->get('cart',[]),'qty'));
        $brands = Brand::all();
        $categories = Category::all();
        $query = Product::query();

        // Thêm điều kiện tìm kiếm
        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->price) {
            [$minPrice, $maxPrice] = explode('-', $request->price);
            $query->whereBetween('price', [(int)$minPrice, (int)$maxPrice]);
        }

        if ($request->category) {
            $query->where('id_category', $request->category);
        }

        if ($request->brand) {
            $query->where('id_brand', $request->brand);
        }

        if ($request->status) {
            $query->where('option', $request->status);
        }

        $products = $query->paginate(1);
        // Thêm vào tham số tìm kiếm khi phân trang nếu không nó sẽ định lại lấy tất cả các products thay vì
        // Lấy dựa theo search như name,price,...
        $products->appends($request->all());

        return view('frontend.search.search', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'totalQTY' => $totalQTY,
            'request' => $request
        ]);
    }

    public function searchPrice(Request $request){
        // dd($request->all());
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $products = Product::whereBetween('price',[$minPrice,$maxPrice])->get();
        // dd($products->all());
        return response()->json(['products'=>$products]);
        // $html = "";
        // foreach($products as $product){
        //     $image = json_decode($product->images);
        //     $html.= "<div class='col-sm-4'>
        //                 <div class='product-image-wrapper'>
        //                     <div class='single-products'>
        //                         <div class='productinfo text-center'>
        //                         <img class='image-product' src='" . asset('frontend/images/products/' . $image[0]) . "'  />
        //                             <h2 class='price-product' data-price-product=' $product->price '>$ $product->price </h2>
        //                             <p class='name-product'> $product->name </p>
        //                             <a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
        //                         </div>
        //                         <div class='product-overlay'>
        //                             <div class='overlay-content'>
        //                                 <h2>$ $product->price </h2>
        //                                 <p> $product->name </p>
        //                                 <a id='btn-add-to-cart' data-id-product =' $product->id ' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
        //                             </div>
        //                         </div>
        //                     </div>
        //                     <div class='choose'>
        //                         <ul class='nav nav-pills nav-justified'>
        //                             <li><a href='product-details/ $product->id '><i class='fa fa-plus-square'></i>Product Detail</a></li>
        //                             <li><a href='#'><i class='fa fa-plus-square'></i>Add to compare</a></li>
        //                         </ul>
        //                     </div>
        //                 </div>
        //             </div>";
        // }
        // return $html != '' ?  response($html) : response("Không tìm thấy sản phẩm");

    }

    

}
                        
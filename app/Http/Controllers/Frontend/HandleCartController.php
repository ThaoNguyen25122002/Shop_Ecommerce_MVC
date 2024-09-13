<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleCartController extends Controller
{
    //
    public function index(){
        $totalQTY = array_sum(array_column(session()->get('cart',[]),'qty'));
        // session()->forget('cart.$id_product');
        // session()->save();
        // dd(session()->get('cart'));
        
        return view('frontend.cart.cart');
    }
    public function handleCartAjax(Request $request){
        // dd($request->all());
        $id_product = $request->id;
        $newQty = $request->newQty;
        if($newQty > 0){
            if (session()->has("cart.$id_product")){
                session()->put("cart.$id_product.qty",$newQty);
                session()->save();
            }
        }else{
            if (session()->has("cart.$id_product")){
                session()->forget("cart.$id_product");
                session()->save();
            }
        }
        // toastr()->timeOut(1000)->success('Finshed Comment!!');
        // flash()->success('Đặt hàng thành công!');
        return response()->json(['success','Thanh cong']);
    }

    public function checkout(){
        // dd(count(session()->get("cart")));
        // dd(array_column(session()->get('cart',[]),'name'));
        // dd(Auth::user()->phone);
        if(!Auth::user()->phone){
            return redirect()->back()->with('message','Vui lòng nhập đầy đủ thông tin nhận hàng!');
        }else if(!session()->get("cart")){
            return redirect()->back()->with('message','Không có sản phẩm trong giỏ hàng!');
        }
        flash()->success('Đặt hàng thành công!');
        $products_name = [];
            $email = Auth::user()->email;
            $phone = Auth::user()->phone;
            $user_id = Auth::id();
            $totalPrice = 0;
            foreach(session()->get("cart") as $key => $product){
                $totalPrice+=$product['price']*$product['qty'];
                $name_qty = $product['name'] . ' ( QTY: ' . $product['qty'] . ')';
                array_push($products_name,$name_qty);
                // echo $product['qty'];
            }
            $products_name = json_encode($products_name);
            Order::create([
                'email' => $email,
                'name' => $products_name,
                'price' => $totalPrice,
                'phone' => $phone,
                'id_user' => $user_id,
            ]);
            session()->forget('cart');
            session()->save();
            // dd($products_name);
            // toastr()->success('Đặt hàng thành công!');
            

            return redirect()->back()->with('message','Đặt hàng thành công!!!');

        // for($i = 0; $i < $length; $i++){
        //     History::create([
        //         'email'=>  $email,

        //     ]);
        // }
    }
}

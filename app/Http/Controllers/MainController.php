<?php

namespace App\Http\Controllers;

use App\Product;
use App\StationaryType;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MainController extends Controller
{

    public function AuthRouteAPI(Request $request){
        return $request->user();
    }

    public function hpStationaryTypes(){
        // Get 4 most bought items
        $types = DB::table('stationary_types')->select('stationary_types.id', 'stationary_types.name', 'stationary_types.image')->join('products', 'stationary_types.id', '=', 'products.stationary_type_id')->join('transaction_details', 'transaction_details.product_id', '=', 'products.id')->groupBy('stationary_types.id')->orderByRaw('SUM(transaction_details.quantity) DESC')->limit(4)->get();

        return view('welcome', ['types' => $types]);
    }

    // Based on category click
    public function findProduct(StationaryType $types){
        // Specific product
        $products = DB::table('products')->where('products.stationary_type_id', '=', $types->id)->paginate(6);

        return view('allproducts', ['products' => $products]);
    }

    // Based on keyword search
    public function searchProduct(Request $request){

        $search = $request->search;

        if($search==null){
            // If the search field is empty, take all products
            $products = DB::table('products')->paginate(6);
        } else {
            $products = DB::table('products')->where('name', 'LIKE', "%".$search."%")->paginate(6);
        }

        return view('allproducts', ['products' => $products]);
    }

    public function viewProductDetails(Product $product){
        // Get product details
        $product_details = DB::table('products')->where('id', '=', $product->id)->first();

        // Get stationary type's name
        $stationary_type = DB::table('products')->select('stationary_types.name')->join('stationary_types', 'stationary_types.id', '=', 'products.stationary_type_id')->where('products.id', '=', $product->id)->first();

        return view('pdetails', ['product_details' => $product_details, 'stationary_type' => $stationary_type]);
    }

    public function mustLogin(){
        return view('mustlogin');
    }

    public function viewUpdate(Product $product){

        $stationary = DB::table('products')->where('id', '=', $product->id)->first();

        return view('update', ['stationary' => $stationary]);
    }

    public function updateProduct(Request $request){

        $validate = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
            'name' => 'required|unique:products|min:5',
            'stock' => 'required|integer|min:1',
            'price' => 'required|integer|min:5000',
            'description' => 'required|min:10'
        ]);


        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }

        DB::table('products')->where('id', $request->id)->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->action([MainController::class, 'viewProductDetails'], ['product' => $request->id]);
    }

    public function deleteProduct(Request $request){

        $validate = Validator::make($request->all(), [
            'id' => 'required|exists:products,id'
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }

        DB::table('products')->where('id', $request->id)->delete();
        
        return redirect('/product/search');
    }

    public function viewAddProduct(){
        $stationary_types = DB::table('stationary_types')->get();

        return view('addproduct', ['stationary_types' => $stationary_types]);
    }

    public function addProduct(Request $request){

        // Validation
        $validate = Validator::make($request->all(), [
            'name' => 'required|unique:products|min:5',
            'stationary_type_id' => 'required|not_in:0',
            'stock' => 'required|integer|min:1',
            'price' => 'required|integer|min:5000',
            'description' => 'required|min:10',
            'image' => 'required|mimes:jpeg,png,bmp,jpg'
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        } 

        // Save to storage
        $image_path = $request->file('image')->store('asset', 'public');
        

        // Save to database
        DB::table('products')->insert([
            [
                'name' => $request->name,
                'stationary_type_id' => $request->stationary_type_id,
                'stock' => $request->stock,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $image_path
            ]
        ]);

        // Get index to show the page the newly product is in
        $index = Product::count();
        $id = ceil($index / 6);

        return redirect()->action([MainController::class, 'searchProduct'], ['page' => $id])->with("message", "Product added!");
    }

    // Get update product type's view
    public function viewUpdateProductType(){

        $stationary_types = DB::table('stationary_types')->get();

        return view('updatedeletetype', ['stationary_types' => $stationary_types]);
    }

    // Update or product type
    public function updateDeleteProductType(Request $request){

        if ($_POST['action'] == 'Update') {
            // Update button is clicked

            $validate = Validator::make($request->all(), [
                'id' => 'required|exists:stationary_types,id',
                'name' => 'required|unique:stationary_types',
            ]);
    
            if($validate->fails()){
                // return redirect()->back()->withErrors($validate->errors());
                return redirect()->action([MainController::class, 'viewUpdateProductType'])->withErrors($validate->errors());
            }
    
            DB::table('stationary_types')->where('id', $request->id)->update([
                'name' => $request->name,
            ]);

        } else if ($_POST['action'] == 'Delete') {
            // Delete button is clicked
            $validate = Validator::make($request->all(), [
                'id' => 'required|exists:stationary_types,id'
            ]);
    
            if($validate->fails()){
                // return redirect()->back()->withErrors($validate->errors());
                return redirect()->action([MainController::class, 'viewUpdateProductType'])->withErrors($validate->errors());
            }
    
            DB::table('stationary_types')->where('id', $request->id)->delete();
            
        } 

        return redirect()->action([MainController::class, 'viewUpdateProductType']);
    }

    // Get add product type's view
    public function viewAddProductType(){
        
        $stationary_types = DB::table('stationary_types')->get();

        $id = StationaryType::count();

        return view('addstationarytype', ['stationary_types' => $stationary_types, 'id' => $id]);
    }

    // Update stationary type
    public function addStationaryType(Request $request){

        // Validation
        $validate = Validator::make($request->all(), [
            'name' => 'required|unique:stationary_types',
            'image' => 'required|mimes:jpeg,png,bmp,jpg'
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        } 

        // Save to storage
        $image_path = $request->file('image')->store('stationary-type', 'public');
        

        // Save to database
        DB::table('stationary_types')->insert([
            [
                'name' => $request->name,
                'image' => $image_path
            ]
        ]);

        return redirect()->action([MainController::class, 'viewAddProductType']);
    }
    //Add-to-Cart
    public function addToCart (Request $request){

        $product_stock = DB::table('products')->where('id','=',$request->id)->first();
        
        //get user id
        $user_id = Auth::user()->id;

        $product_id = DB::table('cart_details')->where('product_id','=',$request->id)->where('user_id','=',$user_id)->first();
        if($product_id==NULL)
        {
            $max_value = $product_stock->stock;
        }
        else
        {
            $max_value = $product_stock->stock - $product_id->quantity;
        }
        
        //Validation 
        $validate = Validator::make($request->all(),[
            'id' =>'required|exists:products,id',
            'quantity'=>"required|integer|gte:1|lte:$max_value"
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }
        if($product_id==NULL)
        {
            //save to database
            DB::table('cart_details')->insert([
            'product_id'=>$request->id,
            'user_id'=>$user_id,
            'quantity'=>$request->quantity
            ]);
        }
        else
        { 
            DB::table('cart_details')->where('product_id','=', $request->id)->where('user_id','=',$user_id)->update([
                'quantity' => $request->quantity + $product_id->quantity
            ]);
        }

        return redirect()->action([MainController::class,'searchProduct'])->with("message","Item added to cart successfully");

    }

    //View Cart
    public function viewCart(){

        $user_id = Auth::user()->id;

        $cart_details = DB::table('cart_details')->where('user_id','=',$user_id)->get();
        //dd($cart_details);
        $products = DB::table('products')->join('cart_details','cart_details.product_id','=','products.id')->where('user_id','=',$user_id)->get();
        return view('Cart',['cart_details'=>$cart_details,'products'=>$products]);
    }


    //View Update cart page (form)
    public function updateCartForm(Product $product){
        // Get product details
        $product_details = DB::table('products')->where('id', '=', $product->id)->first();

        $cart_details = DB::table('cart_details')->where('product_id','=',$product->id)->first();
        // Get stationary type's name
        $stationary_type = DB::table('products')->select('stationary_types.name')->join('stationary_types', 'stationary_types.id', '=', 'products.stationary_type_id')->where('products.id', '=', $product->id)->first();

        return view('UpdateCartView', ['product_details' => $product_details, 'stationary_type' => $stationary_type,'cart_details'=>$cart_details]);
    }

    //update cart
    public function updateCart (Request $request){

        $product_stock = DB::table('products')->where('id','=',$request->id)->first();
        
        //get user id
        $user_id = Auth::user()->id;

        $product_id = DB::table('cart_details')->where('product_id','=',$request->id)->where('user_id','=',$user_id)->first();
        if($product_id==NULL)
        {
            $max_value = $product_stock->stock;
        }
        else
        {
            $max_value = $product_stock->stock - $product_id->quantity;
        }
        
        //Validation 
        $validate = Validator::make($request->all(),[
            'id' =>'required|exists:products,id',
            'quantity'=>"required|integer|gte:1|lte:$max_value"
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }

        DB::table('cart_details')->where('product_id','=', $request->id)->where('user_id','=',$user_id)->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->action([MainController::class,'viewCart'])->with("message","Item updated successfully");

    }

    public function deleteCart(Product $product){
        DB::table('cart_details')->where('product_id','=',$product->id)->delete();
        return redirect()->action([MainController::class,'viewCart'])->with("message","Item deleted successfully");
    }

    public function checkout(){
        $user_id = Auth::user()->id;

        $mytime = Carbon::now(new \DateTimeZone('Asia/Jakarta'));
        DB::table('transactions')->insert([
            'user_id' => $user_id,
            'date'=>$mytime
        ]);

        $last_transaction = DB::table('transactions')->where('user_id','=',$user_id)->latest('date')->first();

        
        $cart_details = DB::table('cart_details')->where('user_id','=',$user_id)->get();
        foreach ($cart_details as $cart_details) {
            DB::table('transaction_details')->insert([
                'transaction_id' =>$last_transaction->id,
                'product_id'=>$cart_details->product_id,
                'quantity'=>$cart_details->quantity,
            ]);
            $product_stock = DB::table('products')->where('id','=',$cart_details->product_id)->first();
            DB::table('products')->where('id','=',$cart_details->product_id)->update([
                    'stock'=> $product_stock->stock - $cart_details->quantity
            ]);

            DB::table('cart_details')->where('product_id','=',$cart_details->product_id)->delete();
        }

        return redirect()->action([MainController::class,'searchProduct'])->with("message","checkout is successful");
    }

    public function viewtransactionhistory(){

        $user_id = Auth::user()->id;
        $datetime = DB::table('transactions')->select('date')->distinct('date')->where('user_id','=',$user_id)->get();
        $gabungan = DB::table('products')->join('transaction_details','transaction_details.product_id','=','products.id')->join('transactions','transactions.id','=','transaction_details.transaction_id')->where('transactions.user_id','=',$user_id)->get();
        return view('viewTransactionhist',['datetime'=>$datetime,'gabungan'=>$gabungan,'user_id'=>$user_id]);
    }

    


}
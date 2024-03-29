<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AdminController;

class OfferController extends Controller
{
    private function testPositiveNumber($number, $float){
        if($float){
            if(preg_match ("/^[0-9]*([\.][0-9]*)?$/", $number)){
                return true;
            }else{
                return false;
            }
                
        }
        elseif(preg_match ("/^[0-9]*$/", $number)){ 
            return true;
        }
        else{
            return false;
        }
    }

    private function getGoods(){
        $goods = DB::select(
            'select item.name as name, item.quantity as available,item.id as id ,item.price as price,item.description as description ,item.img_URL as img, item.img_alt as alt,category.name as category,
            product_type.name as product_type from item left join category on 
            (item.category = category.id) left join product_type on (category.product_type = product_type.id)'
        );
        // sorting goods by its product type
        $product_types = [];
        foreach ($goods as $entry) {
            if (!in_array($entry->product_type, $product_types)) {
                array_push($product_types, $entry->product_type);
            }
        }
        $product_type_arrays = [];
        foreach ($product_types as $type) {
            $product_type_arrays[$type] = [];
        }
        foreach ($goods as $entry) {
            array_push($product_type_arrays[$entry->product_type], $entry);
        }
        $sorted_goods = [];
        foreach ($product_type_arrays as $array) {
            if(isset($_GET[$array[0]->product_type]))
            {if($this->testPositiveNumber(intval($_GET[$array[0]->product_type]),false)){
                if(intval($_GET[$array[0]->product_type])>0){
                    $sliced_goods = array_slice($array,(intval($_GET[$array[0]->product_type])*4)-4,4);
                    $sorted_goods[$array[0]->product_type] = $sliced_goods;
                }
            }}
            else{
                $sliced_goods = array_slice($array,0,4);
                $sorted_goods[$array[0]->product_type] = $sliced_goods; #used to be array_merge
            }
        }
        return $sorted_goods;
    }

    public function getActiveOffer()
    {
        //dd($_GET);
        $sorted_goods = $this->getGoods();
        return view('goods', ['goods' => $sorted_goods]);
    }

    private function handleQuantityInput()
    {
        if ($_POST['quantity'] == '' || $_POST['quantity'] < 0) {
            return 1;
        } else {
            return $_POST['quantity'];
        }
    }

    public function addToCart()
    {
        session()->start();
        if (session()->exists('id')) {
            if (is_null(session('cart'))) {
                session()->put('cart', []);
            }
            $quantity = $this->handleQuantityInput();
            $db_quantity = DB::select("select quantity from item where id={$_POST['item_id']}");
            if ($quantity <= $db_quantity[0]->quantity) {
                $put[$_POST['item_id']] = $quantity;
                session()->push('cart', $put);
            } else {
                $put[$_POST['item_id']] = $db_quantity[0]->quantity;
                session()->push('cart', $put);
            }
            return $this->getActiveOffer();
        }else{
            $sorted_goods = $this->getGoods();
            return view('goods', ['goods' => $sorted_goods, 'message' => 'Please login first, before adding items into the cart.']);
        }
    }
}

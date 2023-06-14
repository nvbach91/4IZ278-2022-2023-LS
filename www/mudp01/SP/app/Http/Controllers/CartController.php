<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function displayCart(){
        if(!is_null(session('cart'))){
            $cart = [];
            foreach (session('cart') as $value){
                $key = key($value);
                $itemTmp = (DB::select("select id, name ,price,quantity from item where id=$key"));
                $item = [
                    'id'=>$itemTmp[0]->id,
                    'name'=>$itemTmp[0]->name,
                    'price'=>$itemTmp[0]->price,
                    'stock'=>$itemTmp[0]->quantity,
                    'quantity'=>current($value)
                ];
                array_push($cart,$item);                
            }
            return view('cart',['items'=>$cart]);
        }else{
                session()->start();
                session()->put('cart',[]);
                return view('cart',['items'=>[]]);
            }

    }

    public function cartAction(){
        if(isset($_POST['remove_id'])){
            foreach(session('cart') as $item){
                if(array_key_exists($_POST['remove_id'],$item)){
                    $index = array_search($item,session('cart'));
                    session()->forget("cart.$index");
                    break;
                }
            }
            return $this->displayCart();
        }if(isset($_POST['confirm-order'])){
            $order = [];
            for($i = 0;$i<count($_POST['name']);$i++){
                $item_id = $_POST['id'][$i];
                $db_quantity = DB::select("select quantity from item where id=$item_id");
                if($_POST['quantity'][$i]<=$db_quantity){
                    $order[$_POST['name'][$i]] = [$_POST['id'][$i] => $_POST['quantity'][$i]];
                }else{
                    $order[$_POST['name'][$i]] = [$_POST['id'][$i] => $db_quantity];
                }
            }
            date_default_timezone_set("Europe/Prague");
            $date = date("Y-m-d h:i:s");
            $user_id = session('id');
            DB::insert("INSERT INTO `order` (created, state, customer) VALUES ('{$date}','Waiting for payment',{$user_id})");
            $order_id = DB::select("select id from `order` where customer={$user_id} and created='{$date}'");

            foreach ($order as $key => $value) {
                $insert_item = key($value);
                $insert_quantity = current($value);
                $insert_order = $order_id[0]->id;
                
                DB::insert("INSERT INTO `contains` (item_id, order_id, quantity) VALUES ({$insert_item},{$insert_order},{$insert_quantity})");
            }
            
            $id = session('id');
            session()->forget('cart');
            $db = DB::select("select first_name, last_name, email from user where id=$id");
            return view('confirmOrder',['name'=> $db[0]->first_name.' '.$db[0]->last_name, 'email'=>$db[0]->email, 'price'=>$_POST['totalPrice']]);
        }     
        else{
            return $this->displayCart();
        }
    }
}

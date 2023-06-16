<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{   
    private function validateCategory($category){
        $valid_categories = DB::select('select id from category');
        if($this->testPositiveNumber($category,false)){
            foreach($valid_categories as $entry){
                if(intval($category)===$entry->id){
                    return true;
                }
            }
            return false;
        }
        return false;
    }

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

    private function pullCategories()
    {
        $response = DB::select("SELECT name, id FROM category");
        return $response;
    }


    private function pullOrders($state)
    {
        $response = DB::select("SELECT `order`.*, `user`.email FROM `order` JOIN `user` ON (`order`.customer = `user`.id) where `order`.state='{$state}'");
        if(isset($_GET['orders']))
        {if($this->testPositiveNumber(intval($_GET['orders']),false)){
            if(intval($_GET['orders'])>0){
                $sliced_responce = array_slice($response,(intval($_GET['orders'])*3)-3,3);
            return $sliced_responce;
            }
        }}
        else{
            $sliced_responce = array_slice($response,0,3);
            return $sliced_responce;
        }
    }

    public function handleGet()
    {
        if (session()->exists('id') && session()->exists('role')) {
            if (session('role') == 'admin') {
                $orders = $this->pullOrders('paid');
                $categories = $this->pullCategories();
                return view('adminPanel', ['orders' => $orders, 'categories' => $categories]);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function handlePost()
    {
        if (session()->exists('id') && session()->exists('role')) {
            if (session('role') == 'admin') {
                $orders = $this->pullOrders('paid');
                $categories = $this->pullCategories();
                if (isset($_POST['orderPaid'])) {
                    $order_state = DB::select("select state from `order` where id={$_POST['id']}");
                    if ($order_state[0]->state === 'paid') {
                        $orders = $this->pullOrders('paid');
                        return view('adminPanel', ['message' => "Error, order (id: {$_POST['id']}) is already paid.", 'orders' => $orders, 'categories' => $categories]);
                    }
                    if ($order_state[0]->state != 'paid') {
                        //Remove items from db
                        $order_items = DB::select("select item_id, quantity from contains where order_id={$_POST['id']}");
                        foreach ($order_items as $item_entry) {
                            $db_quantity = DB::select("select quantity from item where id={$item_entry->item_id}");
                            $db_new_quantity = intval($db_quantity[0]->quantity) - intval($item_entry->item_id);
                            if ($db_new_quantity < 0) {
                                $orders = $this->pullOrders('paid');
                                return view('adminPanel', ['message' => 'Not enought items in stock.', 'orders' => $orders, 'categories' => $categories]);
                            } else {
                                $result = DB::update("update `item` set quantity={$db_new_quantity} where id={$item_entry->item_id}");
                                //Set order as paid
                                DB::update("update `order` set state='paid' where id={$_POST['id']}");
                                if ($result != 0) {
                                    $orders = $this->pullOrders('paid');
                                    return view('adminPanel', ['message' => "Order (id: {$_POST['id']}) state set to paid.", 'orders' => $orders, 'categories' => $categories]);
                                } else {
                                    $orders = $this->pullOrders('paid');
                                    return view('adminPanel', ['message' => "Error, order (id: {$_POST['id']}) state was not changed.", 'orders' => $orders, 'categories' => $categories]);
                                }
                            }
                        }
                    }
                }

                if (isset($_POST['editItem'])) {
                    if ($_POST['option'] == 'id') {
                        $id = $_POST['item'];
                        $item = DB::select("select * from item where id='$id'");
                        if (count($item) == 1) {
                            return view('adminPanel', ['editItem' => $item, 'message' => "Item found: {$item[0]->name}.", 'orders' => $orders, 'categories' => $categories]);
                        } else {
                            return view('adminPanel', ['message' => 'Item not found.', 'orders' => $orders, 'categories' => $categories]);
                        }
                    } else {
                        $name = $_POST['item'];
                        $item = DB::select("select * from item where name='$name'");
                        if (count($item) == 1) {
                            return view('adminPanel', ['editItem' => $item, 'message' => "Item found: {$item[0]->name}.", 'orders' => $orders, 'categories' => $categories]);
                        } else {
                            return view('adminPanel', ['message' => 'Item not found.', 'orders' => $orders, 'categories' => $categories]);
                        }
                    }
                }
                if (isset($_POST['editedItem'])) {
                    if(!($this->testPositiveNumber($_POST['price'],true))){
                        return view('adminPanel', ['message' => 'Price must be a number.', 'orders' => $orders, 'categories' => $categories]);
                    }
                    if(!($this->testPositiveNumber($_POST['quantity'],false))){
                        return view('adminPanel', ['message' => 'Quantity must be a number.', 'orders' => $orders, 'categories' => $categories]);
                    }
                    if(!($this->validateCategory($_POST['category']))){
                        return view('adminPanel', ['message' => 'Category is not known/valid.', 'orders' => $orders, 'categories' => $categories]);
                    }
                    try{
                    $result = DB::update("update item set 
            name='{$_POST['name']}',
            description='{$_POST['description']}',
            img_URL='{$_POST['imgUrl']}',
            img_alt='{$_POST['imgAlt']}',
            price={$_POST['price']},
            quantity={$_POST['quantity']},
            category='{$_POST['category']}'
             where id={$_POST['id']}");
                    if ($result == 1) {
                        return view('adminPanel', ['message' => 'Item edited.', 'orders' => $orders, 'categories' => $categories]);
                    } else {
                        return view('adminPanel', ['orders' => $orders, 'message' => 'Item edited, but initial values were not changed.', 'categories' => $categories]);
                    }
                }catch(Exception){
                    return view('adminPanel', ['message' => 'Database error.', 'orders' => $orders, 'categories' => $categories]);
                }
                }
                if (isset($_POST['addItem'])) {
                    if(!($this->testPositiveNumber($_POST['price'],true))){
                        return view('adminPanel', ['message' => 'Price must be a number.', 'orders' => $orders, 'categories' => $categories]);
                    }
                    if(!($this->testPositiveNumber($_POST['quantity'],false))){
                        return view('adminPanel', ['message' => 'Quantity must be a number.', 'orders' => $orders, 'categories' => $categories]);
                    }
                    if(!($this->validateCategory($_POST['category']))){
                        return view('adminPanel', ['message' => 'Category is not known/valid.', 'orders' => $orders, 'categories' => $categories]);
                    }
                    try{
                    $result = DB::insert("INSERT INTO `item` 
            (name,description,img_URL,img_alt,price,quantity,category) values (
                '{$_POST['name']}',
                '{$_POST['description']}',
                '{$_POST['imgUrl']}',
                '{$_POST['imgAlt']}',
                {$_POST['price']},
                {$_POST['quantity']},
                '{$_POST['category']}'
            )");
                    if ($result == 1) {
                        return view('adminPanel', ['message' => 'Item added.', 'orders' => $orders, 'categories' => $categories]);
                    } else {
                        return view('adminPanel', ['message' => 'Error, Item was not added.', 'orders' => $orders, 'categories' => $categories]);
                    }
                }catch(Exception){
                    return view('adminPanel', ['message' => 'Database error.', 'orders' => $orders, 'categories' => $categories]);
                }
                }
                if (isset($_POST['removeItem'])) {
                    if ($_POST['option'] == 'id') {
                        $id = $_POST['item'];
                        $item = DB::select("select * from item where id='$id'");
                        if (count($item) == 1) {
                            return view('adminPanel', ['removeItem' => $item, 'message' => "Item to be removed: {$item[0]->name}.", 'orders' => $orders, 'categories' => $categories]);
                        } else {
                            return view('adminPanel', ['message' => 'Item not found.', 'orders' => $orders, 'categories' => $categories]);
                        }
                    } else {
                        $name = $_POST['item'];
                        $item = DB::select("select * from item where name='$name'");
                        if (count($item) == 1) {
                            return view('adminPanel', ['removeItem' => $item, 'message' => "Item to be removed: {$item[0]->name}.", 'orders' => $orders, 'categories' => $categories]);
                        }
                        if (count($item) == 0) {
                            return view('adminPanel', ['message' => 'Item not found.', 'orders' => $orders, 'categories' => $categories]);
                        }
                        if (count($item) > 1) {
                            $ids = '';
                            foreach ($item as $entry) {
                                if ($ids == '') {
                                    $ids = $ids . ' ' . $entry->id;
                                } else {
                                    $ids = $ids . ', ' . $entry->id;
                                }
                            }
                            return view('adminPanel', ['message' => "Multiple items found, please search by ID. Item ID´s found:{$ids}.", 'orders' => $orders, 'categories' => $categories]);
                        }
                    }
                }
                if (isset($_POST['removeItemConfirm'])) {
                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];
                        $result = DB::delete("DELETE FROM item where id={$id}");
                        if ($result == 1) {
                            return view('adminPanel', ['message' => 'Item successfully deleted.', 'orders' => $orders, 'categories' => $categories]);
                        } else {
                            return view('adminPanel', ['message' => 'Error, delete failed.', 'orders' => $orders, 'categories' => $categories]);
                        }
                    }
                }
                if(isset($_POST['filterOrders'])){
                    $filter = $_POST['filter'];
                    $orders = $this->pullOrders($filter);
                    return view('adminPanel', ['orders' => $orders, 'categories' => $categories]);
                }
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}

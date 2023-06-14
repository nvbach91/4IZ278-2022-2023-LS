<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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



    private function pullOrders()
    {
        $response = DB::select('SELECT `order`.*, `user`.email FROM `order` JOIN `user` ON (`order`.customer = `user`.id)');
        return $response;
    }

    public function handleGet()
    {
        if (session()->exists('id') && session()->exists('role')) {
            if (session('role') == 'admin') {
                $orders = $this->pullOrders();
                return view('adminPanel', ['orders' => $orders]);
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
                $orders = $this->pullOrders();
                if (isset($_POST['orderPaid'])) {
                    $order_state = DB::select("select state from `order` where id={$_POST['id']}");
                    if ($order_state[0]->state === 'paid') {
                        $orders = $this->pullOrders();
                        return view('adminPanel', ['message' => "Error, order (id: {$_POST['id']}) is already paid.", 'orders' => $orders]);
                    }
                    if ($order_state[0]->state != 'paid') {
                        //Remove items from db
                        $order_items = DB::select("select item_id, quantity from contains where order_id={$_POST['id']}");
                        foreach ($order_items as $item_entry) {
                            $db_quantity = DB::select("select quantity from item where id={$item_entry->item_id}");
                            $db_new_quantity = intval($db_quantity[0]->quantity) - intval($item_entry->item_id);
                            if ($db_new_quantity < 0) {
                                $orders = $this->pullOrders();
                                return view('adminPanel', ['message' => 'Not enought items in stock.', 'orders' => $orders]);
                            } else {
                                $result = DB::update("update `item` set quantity={$db_new_quantity} where id={$item_entry->item_id}");
                                //Set order as paid
                                DB::update("update `order` set state='paid' where id={$_POST['id']}");
                                if ($result != 0) {
                                    $orders = $this->pullOrders();
                                    return view('adminPanel', ['message' => "Order (id: {$_POST['id']}) state set to paid.", 'orders' => $orders]);
                                } else {
                                    $orders = $this->pullOrders();
                                    return view('adminPanel', ['message' => "Error, order (id: {$_POST['id']}) state was not changed.", 'orders' => $orders]);
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
                            return view('adminPanel', ['editItem' => $item, 'message' => "Item found: {$item[0]->name}.", 'orders' => $orders]);
                        } else {
                            return view('adminPanel', ['message' => 'Item not found.', 'orders' => $orders]);
                        }
                    } else {
                        $name = $_POST['item'];
                        $item = DB::select("select * from item where name='$name'");
                        if (count($item) == 1) {
                            return view('adminPanel', ['editItem' => $item, 'message' => "Item found: {$item[0]->name}.", 'orders' => $orders]);
                        } else {
                            return view('adminPanel', ['message' => 'Item not found.', 'orders' => $orders]);
                        }
                    }
                }
                if (isset($_POST['editedItem'])) {
                    if(!($this->testPositiveNumber($_POST['price'],true))){
                        return view('adminPanel', ['message' => 'Price must be a number.', 'orders' => $orders]);
                    }
                    if(!($this->testPositiveNumber($_POST['quantity'],false))){
                        return view('adminPanel', ['message' => 'Quantity must be a number.', 'orders' => $orders]);
                    }
                    if(!($this->validateCategory($_POST['category']))){
                        return view('adminPanel', ['message' => 'Category is not known/valid.', 'orders' => $orders]);
                    }
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
                        return view('adminPanel', ['message' => 'Item edited.', 'orders' => $orders]);
                    } else {
                        return view('adminPanel', ['orders' => $orders, 'message' => 'Item edited, but initial values were not changed.']);
                    }
                }
                if (isset($_POST['addItem'])) {
                    if(!($this->testPositiveNumber($_POST['price'],true))){
                        return view('adminPanel', ['message' => 'Price must be a number.', 'orders' => $orders]);
                    }
                    if(!($this->testPositiveNumber($_POST['quantity'],false))){
                        return view('adminPanel', ['message' => 'Quantity must be a number.', 'orders' => $orders]);
                    }
                    if(!($this->validateCategory($_POST['category']))){
                        return view('adminPanel', ['message' => 'Category is not known/valid.', 'orders' => $orders]);
                    }
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
                        return view('adminPanel', ['message' => 'Item added.', 'orders' => $orders]);
                    } else {
                        return view('adminPanel', ['message' => 'Error, Item was not added.', 'orders' => $orders]);
                    }
                }
                if (isset($_POST['removeItem'])) {
                    if ($_POST['option'] == 'id') {
                        $id = $_POST['item'];
                        $item = DB::select("select * from item where id='$id'");
                        if (count($item) == 1) {
                            return view('adminPanel', ['removeItem' => $item, 'message' => "Item to be removed: {$item[0]->name}.", 'orders' => $orders]);
                        } else {
                            return view('adminPanel', ['message' => 'Item not found.', 'orders' => $orders]);
                        }
                    } else {
                        $name = $_POST['item'];
                        $item = DB::select("select * from item where name='$name'");
                        if (count($item) == 1) {
                            return view('adminPanel', ['removeItem' => $item, 'message' => "Item to be removed: {$item[0]->name}.", 'orders' => $orders]);
                        }
                        if (count($item) == 0) {
                            return view('adminPanel', ['message' => 'Item not found.', 'orders' => $orders]);
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
                            return view('adminPanel', ['message' => "Multiple items found, please search by ID. Item ID´s found:{$ids}.", 'orders' => $orders]);
                        }
                    }
                }
                if (isset($_POST['removeItemConfirm'])) {
                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];
                        $result = DB::delete("DELETE FROM item where id={$id}");
                        if ($result == 1) {
                            return view('adminPanel', ['message' => 'Item successfully deleted.', 'orders' => $orders]);
                        } else {
                            return view('adminPanel', ['message' => 'Error, delete failed.', 'orders' => $orders]);
                        }
                    }
                }
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}

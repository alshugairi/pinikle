<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = \Cart::getContent();
        return view('front.pages.cart', get_defined_vars());
    }

    public function add($id)
    {
        try {
            $item = Product::findOrFail($id);
            $rowId = uniqid();
            $userID = auth()->id();
            \Cart::add(array(
                'id' => $rowId,
                'name' => $item->name,
                'price' => $item->price,
                'photo' => '',
                'quantity' => 1,
                'attributes' => array(),
                'associatedModel' => $item
            ));
            flash(__('front.added_to_cart_success'))->success();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }
        return back();
    }

    public function delete($id)
    {
        try {
            \Cart::remove($id);
            flash(__('front.deleted_from_cart_success'))->success();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }
        return back();
    }
}

<?php

namespace App\Helpers;

use App\Product;

class Cart
{
    public function __construct()
    {
        if ($this->get() === null) {
            $this->set($this->empty());
        }
    }

    public function set($cart)
    {
        request()->session()->put('cart', $cart);
    }

    public function get()
    {
        return request()->session()->get('cart');
    }

    public function empty()
    {
        return ['products' => []];
    }

    public function add(Product $product)
    {
        $cart = $this->get();
        $cart['products'][] = $product; // Add the product to the cart
        $this->set($cart);
    }

    public function remove($productId)
    {
        $cart = $this->get();
        // Remove the product from the cart
        $cart['products'] = array_filter($cart['products'], function($item) use ($productId) {
            return $item->id !== $productId;
        });
        $this->set($cart);
    }

    public function clear()
    {
        $this->set($this->empty());
    }
}

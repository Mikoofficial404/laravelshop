<?php

namespace App\Http\Livewire\Shop;

use App\Facades\Cart;
use Livewire\Component;

class Cartnav extends Component
{
    public $cartTotal = 0;

    protected $listeners = ["addToCart"=> "updateCartTotal", "removeFormCart"=> "updateCartTotal" , "cartClear"=> "updateCartTotal"];
    public function render()
    {
        return view('livewire.shop.cartnav');
    }

    public function updateCartTotal(){
        $this->cartTotal = count(Cart::get()['products']);
    }

    
}

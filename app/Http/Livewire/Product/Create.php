<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $price;
    public $image;

    public function render()
    {
        return view('livewire.product.create');
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:180',
            'price' => 'required|numeric',
            'image' => 'image|max:1024'
        ]);


        $imageName = null;

        if ($this->image) {
            $imageName = Str::slug($this->title, '-')
                . '-'
                . uniqid()
                . '.' . $this->image->getClientOriginalExtension();

            // Store the image in the public directory
            $this->image->storeAs('public', $imageName, 'local');
        }

        // Create the product record
        $product = Product::create([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imageName
        ]);

        $this->emit('productStored');
    }
}

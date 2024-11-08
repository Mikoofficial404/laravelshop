<?php

namespace App\Http\Livewire\Product;


use App\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

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

    public function store(){

        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:180',
            'price' => 'required|numeric',
            'image' => 'image|max:1024',
        ]);

        $imageName = '';
        if ($this->image) {
            $imageName = \Illuminate\Support\Str::slug($this->title, '-')
                         . '-' . uniqid()
                         . '.' . $this->image->getClientOriginalExtension();

            $this->image->storeAs('public', $imageName);
            $this->image = $imageName;
        }

        Product::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
        ]);

        $this->emit('productStored');

    }
}

<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <input wire:model="search" type="text" class="form-control" placeholder="Search Product">
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card h-100">
                    <img
                        class="card-img-top img-fluid"
                        src="{{ $product->image ? asset('/storage/' . $product->image) : 'http://placehold.it/150x150' }}"
                        alt="Product Image"
                        style="height: 200px; object-fit: cover;">

                    <div class="card-body bg-dark text-white p-3" style="background-color: rgba(0,0,0,0.7);">
                        <h5 class="card-title text-center">
                            <strong>{{ $product->title }}</strong>
                        </h5>
                        <h6 class="text-center mb-3">Rp{{ number_format($product->price, 2, ",", ".") }}</h6>
                        <p class="card-text text-center" style="font-size: 0.9em;">
                            {{ Str::limit($product->description, 100) }}
                        </p>
                        <button wire:click="addToCart({{ $product->id }})" type="button" class="btn btn-sm btn-outline-light btn-block">
    Add to Cart
</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>

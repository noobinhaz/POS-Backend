<x-layout>
    
    <div class="container py-5">
        <h2 class="text-center mb-4">{{ $category->name }} Products</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            
            @unless($category->products->count() == 0)
            @foreach ($category->products as $product)
                <div class="col">
                    <div class="card h-100">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($product->images as $key => $image)
                                    <div class="carousel-item @if($key === 0) active @endif">
                                        
                                        <img src="{{ asset($image->location) }}" class="d-block w-100" style="height: 400px; width: 600px;" alt="{{ $product->productName }} Image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <ul class="list-unstyled mb-4">
                                <li>Quantity: {{ $product->quantity }} {{ $product->unit }}</li>
                                <li>Sold: {{ $product->sold }}</li>
                                <li>Price Code: {{ $product->price_code }}</li>
                            </ul>
                            <form action="/products/{{$product->id}}" method="get"><button class="btn btn-primary" type="submit">View Details</button></form>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <h2 class="text-center mb-4 col-md-12 text-warning">No Product found for this Category</h2>
            @endunless

        </div>
        <div class="row d-flex justify-content-center py-5">
            <a href="/category" class="btn btn-info">Back</a>
        </div>
    </div>

</x-layout>

<x-layout>
    
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->productName }}</h5>
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($product->images as $key => $image)
                                    <div class="carousel-item @if($key === 0) active @endif">
                                        
                                        <img src="{{ asset($image->location) }}" class="d-block w-100" style="height: 400px; width: 600px;" alt="{{ $product->productName }} Image">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Details</h5>
                        <p class="card-text"><strong>Categories:</strong> 
                            @foreach($product->categories as $category)
                                {{ $category->name }}{{ $loop->last ? '' : ', ' }}
                            @endforeach
                        </p>
                        <p class="card-text"><strong>Unit:</strong> {{ $product->unit }}</p>
                        <p class="card-text"><strong>Quantity:</strong> {{ $product->quantity }}</p>
                        <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                        <p class="card-text"><strong>Items Sold:</strong> {{ $product->sold }}</p>
                        <p class="card-text"><strong>Price Code:</strong> {{ $product->priceCode }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center pt-5">

            <a href="/products" class="btn btn-warning text-center w-25">Back</a>
        </div>
    </div>


</x-layout>
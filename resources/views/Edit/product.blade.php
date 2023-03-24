<x-layout>

    <script>
        $(document).ready(function() {
            $('.select2-multi').select2();
        });
    </script>
    
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>Edit Product</h2>
          <form method="POST" action="/products/{{$product->id}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="category">Category</label>
              
                <select class="form-control select2-multi" id="category" value="{{$product->categories}}" name="category[]" multiple>
                    @foreach($categories as $category)
                         <option value="{{$category->id}}" 
                                @if(in_array($category->id, $product->categories->pluck('id')->toArray())) 
                                    selected 
                                @endif>

                                {{$category->name}}
                        </option>
                    @endforeach
    
                </select>
            </div>
            
            <div class="form-group">
              <label for="productName">Product Name</label>
              <input type="text" class="form-control" id="productName" name="productName" value="{{$product->productName}}">
            </div>
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" id="quantity" name="quantity" value="{{$product->quantity}}">
            </div>
            <div class="form-group">
              <label for="unit">Unit</label>
              <select class="form-control" id="unit" name="unit" >
                @foreach($units as $unit)
                    <option value="{{$unit->id}}" 
                    @if($unit->id == $product->unitInfo->id) 
                                    selected 
                    @endif>
                                {{$unit->name}}
                    </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="priceCode">Price Code</label>
              <input type="text" class="form-control" id="priceCode" name="priceCode" value="{{$product->priceCode}}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3">{{$product->description}}</textarea>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control-file" id="image" name="image[]" multiple>
              <div class="row">
                @if(!empty($product->images)) 
                    @foreach($product->images as $image)
                        <img src="{{ asset($image->location) }}" class="d-block w-50" style="height: 200px; width: 300px;" alt="{{ $product->productName }} Image">
                    @endforeach
                    @endif
            </div>
            </div>
            <div class="row d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Update</button>
            
                <a href="/products" class="btn btn-warning">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</x-layout>

<x-layout>

    <script>
        $(document).ready(function() {
            $('.select2-multi').select2();
        });
    </script>

    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>Add Product</h2>
          <form method="POST" action="/products" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="category">Category</label>
              
                <select class="form-control select2-multi" id="category" name="category[]" multiple>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
    
                </select>
            </div>
            
            <div class="form-group">
              <label for="productName">Product Name</label>
              <input type="text" class="form-control" id="productName" name="productName">
            </div>
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <div class="form-group">
              <label for="unit">Unit</label>
              <select class="form-control" id="unit" name="unit">
                @foreach($units as $unit)
                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="priceCode">Price Code</label>
              <input type="text" class="form-control" id="priceCode" name="priceCode">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control-file" id="image" name="image[]" multiple>
            </div>
            <div class="row d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Add Product</button>
            
                <a href="/products" class="btn btn-warning">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</x-layout>

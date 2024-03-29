<x-layout>
    
    <div class="card">
        
        <div class="card-header text-center">
            <div class="row justify-content-around">
                <div>
                    <h2>Products</h2>
                </div>
                <div>
                    <a href="/products/create" class="btn btn-success mb-3">Add Product</a>
                </div>
            </div>
        </div>
        <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Name</th>
                    <th>Amount Sold</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index=>$product)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td class="col-md-2">
                        @foreach($product->categories as $category)
                           <a href="/viewProducts/{{$category->id}}" class="bg-info text-white rounded text-decoration-none mr-1">
                               {{$category->name}}
                           </a>
                        @endforeach
                    </td>
                    <td>{{ $product->productName }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->unitInfo->name }}</td>
                    <td class="col-md-1">{{ $product->sales_count }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        <form action="/products/{{$product->id}}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="pagination justify-content-center">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>

</x-layout>    


<x-layout>
    <div class="container">
        <div class="row d-flex justify-content-between">
            <h2>Sales</h2>
            <a href="/order/create" class="btn btn-success mb-3">Add Sales</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Client Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Sold By</th>
                    <th>Sold At</th>
                    <th>Action</th>
                </tr>
            </thead>
            @unless(empty($sales))
            <tbody>
                @foreach($sales as $index => $data)
                    <tr>
                    
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data['clientName'] ? $data['clientName'] : 'N/A' }}</td>
                        <td>{{ $data->product->productName }}</td>
                        <td>{{ $data['quantity'] }}</td>
                        <td>{{ $data->unit->name }}</td>
                        <td>{{ (int)$data['price'] }}</td>
                        <td>{{ $data->user ? $data->user->fullName : null }}</td>
                        <td>{{ date('Y-m-d', strtotime($data['created_at'])) }}</td>
                        <td>
                            <form action="/order/{{$data->id}}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
                <tfoot>No Data Found</tfoot> 
            @endunless
        </table>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="pagination justify-content-center">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>

</x-layout>
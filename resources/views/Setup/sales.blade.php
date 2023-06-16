<x-layout>
    <div class="card">
        
        <div class="card-header text-center">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <h2>Sales</h2>
                </div>
                <div class="col">
                    <a href="/order/create" class="btn btn-success ">Add Sales</a>
                </div>
                <div class="col-auto align-items-center">
                    <form action="/invoice" method="get" class="input-group">
                        <input type="text" class="form-control" placeholder="Invoice No" aria-label="Invoice No" name="invoice_id" id="invoice-input">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary text-dark bg-warning" type="submit" id="print-button">Print</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Client Name</th>
                    <th>Product Name</th>
                    <th>Invoice</th>
                    <th>Quantity</th>
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
                        <td>{{ $data->invoice_id ?? 'N/A' }}</td>
                        <td>{{ $data['quantity'] . " ". $data->unit->name }}</td>
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

    <script>
        // Get the input and button elements
        const input = document.getElementById('invoice-input');
        const button = document.getElementById('print-button');
        
        // Disable the button initially
        button.disabled = true;
        
        // Enable or disable the button based on input value
        input.addEventListener('input', function() {
            button.disabled = !input.value;
        });
    </script>

</x-layout>
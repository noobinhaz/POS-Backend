<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container" id="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
                <h2 class="text-center mb-4">Invoice</h2>
                <div class="card">
                    <div class="card-header">
                        <h5>Haque Auto</h5>
                        <p>Address</p>
                        <div class="row justify-content-end mr-5">
                                <label for="date">Date: {{now()->toDateString()}}</label>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5>Client Details</h5>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <label for="client-name">Name:</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control-plaintext" id="client-name" name="client_name" style="border-bottom: 1px solid #ccc;" value="{{$sales[0]['clientName'] ? $sales[0]['clientName'] : ''}}">
                            </div>
                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="client-address">Address: </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control-plaintext" id="client-address" style="border-bottom: 1px solid #ccc;" name="client_name">
                            </div>
                        </div>
                        
                        <hr>
                        <h5>Product List</h5>
                        @php 
                            $total = 0; 
                        @endphp
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @unless(empty($sales))
                                @foreach($sales as $sale)
                                <tr>
                                    <td>{{$sale->product ? $sale->product->productName : ''}}</td>
                                    <td>{{$sale->quantity}}</td>
                                    <td>{{$sale->unit ? $sale->unit->name : 'N/A'}}</td>
                                    <td>{{$sale->price}}</td>
                                    @php 
                                        $total = $total + $sale->price;
                                    @endphp
                                </tr>
                                @endforeach
                                @endunless
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <div class="row">
                            <label for="Total Price" class="col">Total Amount: {{$total}}</label>
                            
                            <label for="Paid Amount" class="col-md-3">Paid Amount: </label>
                            <input type="number" id="paid_amount" class="col-md-2 pr-2 mr-5">
                            
                        </div>
                        <hr>
                        <div class="row justify-content-around">
                            <a href="/order" class="btn btn-warning">Back</a>
                            <button type="button" class="btn btn-primary"  id="print" onclick="printInvoice()">Print Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function printInvoice(){
            button = document.getElementById('print');
            container = document.getElementById('container');
            paid = document.getElementById('paid_amount');

            paid.classList.add('form-control-plaintext');
            paid.style.borderBottom = "1px solid #ccc";
            button.style.display = 'none';
            container.classList.remove('container');
            
            window.print();
            container.classList.add('container');
        }
    </script>
</body>
</html>

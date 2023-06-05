<x-layout>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Make a Sale</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form action="/order/create" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary">Search</button>
                        </div>
                    </div>
                </form>

                <div class="list-group" id="searchResults">
                    <!-- Search results will be added dynamically here --> 
                    
                    @unless(empty($data))
                    <table>
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th hidden>Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index=>$product)
                            <tr 
                            onclick="addProductRow(this)">
                            <!-- onclick = "clickOnTr(this)" -->
                                <td>{{$product->id}} </td>
                                <td><img src="{{ $product->image ? asset($product->image->location) : 'https://placehold.co/100'}}" alt="{{$product->image ? $product->image->name: null}}" style="height: 100px; width:100px;"></td>
                                <td>{{$product->productName}}</td>
                                <td>{{$product->quantity}}</td>
                                <td hidden>{{$product->id}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <span>No Product Found</span>
                    @endunless
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Selected Products</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <th>Available</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="selectedProducts">
                               
                                <!-- Selected products will be added dynamically here -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" align="right">Subtotal:</td>
                                    <td colspan="2" align="right" id="subtotal">$0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="discount">Discount (%)</label>
                            <input type="number" class="form-control" id="discount" value="0">
                        </div>
                        <div class="form-group">
                            <label for="paymentMethod">Payment Method</label>
                            <select class="form-control" id="paymentMethod">
                                <option value="cash">Cash</option>
                                <option value="credit">Credit Card</option>
                                <option value="debit">Debit Card</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amountReceived">Amount Received</label>
                            <input type="number" class="form-control" id="amountReceived" value="0">
                        </div>
                        <button class="btn btn-success btn-lg btn-block" id="checkoutBtn" onclick="checkout()">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
    const price = [];
    const quantity = [];

    function clickOnTr(e){
        const cells = e.cells;
        const productName = cells[2].textContent;
        const quantity = cells[3].textContent;
        const id = cells[4].textContent;
        let price = 0;

        const targetTable = document.getElementById('selectedProducts');

        const newRow = '<tr><td>' + productName + '</td><td>' + quantity + '</td><td><input type="number"/></td><td><input type=number' + price + '/></td><td>' + (quantity * price) + '</td><td><button class="btn btn-success btn-sm" onclick = "updateSale(this)">Ok</button></td><td><button class="btn btn-danger btn-sm removeBtn">Remove</button></td></tr>';
        console.log(targetTable);

        console.log(productName, quantity, id);

        insertInto = document.getElementById('selectedProducts');
        insertInto.innerHTML += newRow;

    }

    const tbody = document.getElementById('selectedProducts');

    // Function to add a product row to the table
    function addProductRow(e) {
        const cells = e.cells;
        const newRow = document.createElement('tr');
        
        // const idCell = document.createElement('td');
        // idCell.textContent = cells[0].textContent;
        // idCell.setAttribute('hidden', 'true');
        // newRow.appendChild(idCell);

        const nameCell = document.createElement('td');
        nameCell.textContent = cells[2].textContent;
        newRow.appendChild(nameCell);

        const quantity = document.createElement('td');
        quantity.textContent = cells[3].textContent;
        newRow.appendChild(quantity);

        const quantityCell = document.createElement('td');
        const quantityInput = document.createElement('input');
        quantityInput.setAttribute('type', 'number');
        quantityInput.setAttribute('min', 1);
        quantityInput.setAttribute('value', 1);
        quantityInput.addEventListener('input', calculateSubtotal);
        quantityInput.setAttribute('name', 'quantity[]'); // Add name attribute for quantity input
        quantityCell.appendChild(quantityInput);
        newRow.appendChild(quantityCell);

        const priceCell = document.createElement('td');
        const priceInput = document.createElement('input');
        priceInput.setAttribute('type', 'number');
        priceInput.setAttribute('min', 0);
        priceInput.setAttribute('value', 0);
        priceInput.addEventListener('input', calculateSubtotal);
        priceInput.setAttribute('name', 'price[]'); // Add name attribute for price input
        priceCell.appendChild(priceInput);
        newRow.appendChild(priceCell);

        const totalCell = document.createElement('td');
        totalCell.textContent = '$0.00';
        newRow.appendChild(totalCell);

        const deleteCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Remove';
        deleteButton.addEventListener('click', function() {
            tbody.removeChild(newRow);
            calculateSubtotal();
        });
        deleteCell.appendChild(deleteButton);
        newRow.appendChild(deleteCell);

        tbody.appendChild(newRow);
        calculateSubtotal();
    }

    function calculateSubtotal() {
        let subtotal = 0;

        const rows = document.querySelectorAll('#selectedProducts tbody tr');
        rows.forEach(row => {
            const quantityInput = row.querySelector('input[type="number"]');
            const priceInput = row.querySelectorAll('input[type="number"]')[1];
            const totalCell = row.querySelector('td:last-child');

            const quantity = parseInt(quantityInput.value);
            const price = parseFloat(priceInput.value);
            const total = quantity * price || 0;

            subtotal += total;

            totalCell.textContent = '$' + total.toFixed(2);
        });

        const subtotalCell = document.querySelector('#selectedProducts tfoot #subtotal');
        subtotalCell.textContent = '$' + subtotal.toFixed(2);
    }

    function checkout() {
        const discount = parseInt(document.getElementById('discount').value);
        const paymentMethod = document.getElementById('paymentMethod').value;
        const amountReceived = parseFloat(document.getElementById('amountReceived').value);

        const rows = document.querySelectorAll('#selectedProducts tbody tr');
        console.log('rows'.rows);
        const productData = [];

        rows.forEach(row => {
            const idCelll = row.querySelector('td:first-child');
            const quantityInput = row.querySelector('input[name="quantity[]"]');
            const priceInput = row.querySelector('input[name="price[]"]');

            const product = {
            id: idCelll.textContent,
            quantity: parseInt(quantityInput.value),
            price: parseFloat(priceInput.value)
            };
            console.log(row);
            productData.push(product);
        });



        const data = {
            discount: discount,
            paymentMethod: paymentMethod,
            amountReceived: amountReceived,
            products: productData
        };

        // Perform the POST request to the /order endpoint with the data
        fetch('/order', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(responseData => {
            // Handle the response data
            console.log(responseData);
            })
            .catch(error => {
            // Handle any errors that occurred during the request
            console.error(error);
            });
    }



    $(document).ready(function() {
        $('table#productsTable tr').click(function() {
            console.log($(this).find('td:eq(1)'))
            var productName = $(this).find('td:eq(1)').text();
            var quantity = $(this).find('td:eq(2)').text();
            var price = $(this).find('td:eq(3)').text();

            var newRow = '<tr><td>' + productName + '</td><td>' + quantity + '</td><td>' + price + '</td><td>' + (quantity * price) + '</td><td><button class="btn btn-danger btn-sm removeBtn">Remove</button></td></tr>';

            $('table#selectedProducts tbody').append(newRow);

            updateTotal();
        });

        $(document).on('click', '.removeBtn', function() {
            $(this).closest('tr').remove();

            updateTotal();
        });

        function updateTotal() {
            var subtotal = 0;

            $('table#selectedProducts tbody tr').each(function() {
                var total = parseFloat($(this).find('td:eq(3)').text());

                subtotal += total;
            });

            var tax = subtotal * {{ $taxRate }} / 100;
            var total = subtotal + tax;

            $('table#selectedProducts tfoot #subtotal').text('$' + subtotal.toFixed(2));
            $('table#selectedProducts tfoot #tax').text('$' + tax.toFixed(2));
            $('table#selectedProducts tfoot #total').text('$' + total.toFixed(2));
        }
    });
</script>


</x-layout>


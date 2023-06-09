<x-layout>
    <div class="container ml-2">
        <div class="row">
            <div class="col-md-6 justify-content-start">
                <h2>Product Sales</h2>
            </div>
            <div class="col-md-6 justify-content-end">
                <a href="/order" class="btn btn-warning">Back</a>
            </div>
            <hr>
        </div>

        <div class="row">
            <div class="col col-md-4 pr-1">
                <div class="row">

                    <form action="/order/create" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary bg-success text-white">Search</button>
                            </div>
                        </div>
                    </form>
                    <form action="/order/create" method="GET">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary bg-danger text-white">X</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="list-group" id="searchResults">
                    <!-- Product search results will be added dynamically here -->
                    <!-- Use JavaScript/jQuery to handle adding products to the order table -->

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
                            <tr onclick="addProductRow(this)">
                                <td>{{$index+1}} </td>
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
            <hr>
            <div class="col col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h4>Selected Products</h4>
                        </div>
                        <form action="/order" method="post" id="productForm">
                            @csrf

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>In Store</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="selectedProducts">
                                    <!-- Selected products will be added dynamically here -->
                                    <!-- Use JavaScript/jQuery to handle removing products from the order table -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" align="right">Total:</td>
                                        <td colspan="2" align="right" id="total">&#2547;0.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="row justify-content-between align-items-center">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 pt-2">
                                        <label for="clientName">Client Name:</label>
                                    </div>
                                    <div class="col-md-7 col-sm-6">
                                        <input type="text" name="clientName" placeholder="Client Name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 pt-2">
                                        <label for="clientEmail">Client Email:</label>
                                    </div>
                                    <div class="col-md-7 col-sm-6">
                                        <input type="text" name="clientEmail" placeholder="Client Email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success btn-lg btn-block" id="checkoutBtn" type="submit">Checkout</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript/jQuery code for handling the dynamic addition and removal of products in the order table

        // Function to add a product row to the table
        function addProductRow(e) {
            const cells = e.cells;
            const productName = cells[2].textContent;
            const quantity = cells[3].textContent;
            const id = cells[4].textContent;
            
            const form = document.getElementById('productForm');

            // Create a new row
            const newRow = document.createElement('tr');

            const idCell = document.createElement('td');
            const idInput = document.createElement('input');
            idInput.setAttribute('hidden', true);
            idInput.setAttribute('value', id);
            idInput.setAttribute('name', 'products_id[]');
            idCell.setAttribute('hidden', true);
            idCell.appendChild(idInput);
            newRow.appendChild(idCell);

            // Create a cell for the product name
            const nameCell = document.createElement('td');
            nameCell.textContent = productName;
            newRow.appendChild(nameCell);

            const storeCell = document.createElement('td');
            storeCell.textContent = quantity;
            newRow.appendChild(storeCell);

            // const idInput = document.createElement('input');
            // idInput.setAttribute('hidden', true);
            // idInput.setAttribute('value', id);

            // Create a cell for the quantity input
            const quantityCell = document.createElement('td');
            const quantityInput = document.createElement('input');
            quantityInput.setAttribute('type', 'number');
            quantityInput.setAttribute('name', 'quantity[]');
            quantityInput.setAttribute('min', '1');
            quantityInput.setAttribute('max', quantity);
            quantityInput.setAttribute('value', '1');
            quantityInput.addEventListener('input', updateSubtotal);
            quantityCell.appendChild(quantityInput);
            newRow.appendChild(quantityCell);

            // Create a cell for the price input
            const priceCell = document.createElement('td');
            const priceInput = document.createElement('input');
            priceInput.setAttribute('type', 'number');
            priceInput.setAttribute('name', 'price[]');
            priceInput.setAttribute('min', 0);
            priceInput.setAttribute('value', '0');
            priceInput.addEventListener('input', updateSubtotal);
            priceCell.appendChild(priceInput);
            newRow.appendChild(priceCell);

            // Create a cell for the subtotal
            const subtotalCell = document.createElement('td');
            subtotalCell.classList.add('subtotal');
            subtotalCell.textContent = '0.00';
            newRow.appendChild(subtotalCell);

            // Create a cell for the remove button
            const removeCell = document.createElement('td');
            const removeButton = document.createElement('button');
            removeButton.textContent = 'Remove';
            removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
            removeButton.addEventListener('click', function () {
                newRow.remove();
                updateTotal();
            });
            removeCell.appendChild(removeButton);
            newRow.appendChild(removeCell);

            // Append the new row to the table body
            const tableBody = document.getElementById('selectedProducts');
            tableBody.appendChild(newRow);

            updateSubtotal();
        }

        function updateSubtotal() {
            const rows = document.querySelectorAll('#selectedProducts tr');

            rows.forEach(row => {
                const quantityInput = row.querySelector('input[name="quantity[]"]');
                const priceInput = row.querySelector('input[name="price[]"]');
                const subtotalCell = row.querySelector('.subtotal');

                const quantity = parseInt(quantityInput.value);
                const price = parseFloat(priceInput.value);
                const subtotal = quantity * price;

                subtotalCell.textContent = subtotal.toFixed(2);
            });

            updateTotal();
        }

        function updateTotal() {
            let total = 0;
            const subtotalCells = document.querySelectorAll('.subtotal');

            subtotalCells.forEach(cell => {
                total += parseFloat(cell.textContent);
            });

            const totalElement = document.getElementById('total');
            totalElement.textContent = '\u09F3' + total.toFixed(2);
        }
    </script>
</x-layout>

<x-layout>
  <div>
    <div class="card">
      <div class="card-header">
        Welcome to the POS Admin Dashboard
      </div>
      <div class="card-body">
        <h5 class="card-title">Quick Stats</h5>
        <div class="row">
          <div class="col-md-3">
            <div class="card text-white bg-primary">
              <div class="card-body">
                <h5 class="card-title">Total Sales</h5>
                <p class="card-text">{{$total_sales}}</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-secondary">
              <div class="card-body">
                <h5 class="card-title">Today Sales</h5>
                  <p class="card-text">{{$today_sales}}</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-success">
              <div class="card-body">
                <h5 class="card-title">Today Orders</h5>
                <p class="card-text">{{$today_orders}}</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-danger">
              <div class="card-body">
                <h5 class="card-title">Out of Stock</h5>
                <p class="card-text">{{$out_of_stock->count()}}</p>
              </div>
            </div>
          </div>
        </div>
	      <hr>
        <section id="out-of-stock">
          <div class="text-center">
            <h2>Out Of Stock Products</h2>
          </div>
          <table class="table">
              <thead>
                  <tr>
                      <th>Serial</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Unit Name</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($out_of_stock as $index => $product)
              
                  <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $product['productName'] }}</td>
                      <td>{{ $product['quantity'] }}</td>
                      <td>{{ $product->unitInfo ? $product->unitInfo->name : 'N/A' }}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="row justify-content-center">
              <div class="col-md-6">
                  <div class="pagination justify-content-center">
                      {{ $out_of_stock->links() }}
                  </div>
              </div>
          </div>        
      </section>
    <hr/>
        <section id="highest_running">
        <div class="text-center">
            <h2>Highest Sold Products</h2>
          </div>
          <table class="table">
              <thead>
                  <tr>
                      <th>Serial</th>
                      <th>Product Name</th>
                      <th>Sold</th>
                      <th>Unit</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($highest_sold as $index => $product)
              
                  <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $product['productName'] }}</td>
                      <td>{{ $product['quantity'] }}</td>
                      <td>{{ $product->unitInfo ? $product->unitInfo->name : 'N/A' }}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          
        </section>
        <hr>
	  </div>
	</div>
</x-layout>


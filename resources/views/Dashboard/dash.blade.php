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
                <p class="card-text">$50,000</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-secondary">
              <div class="card-body">
                <h5 class="card-title">Total Orders</h5>
                  <p class="card-text">500</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-success">
              <div class="card-body">
                <h5 class="card-title">Total Customers</h5>
                <p class="card-text">200</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-danger">
              <div class="card-body">
                <h5 class="card-title">Out of Stock</h5>
                <p class="card-text">10</p>
              </div>
            </div>
          </div>
        </div>
	      <hr>
	      <h5 class="card-title mt-3">Recent Orders</h5>
	      <table class="table">
	        <thead>
		        <tr>
	  	        <th>Order ID</th>
		          <th>Customer</th>
              <th>Total</th>
  		        <th>Date</th>
		          <th>Status</th>
		          <th>Actions</th>
		        </tr>
	        </thead>
	        <tbody>
		        <tr>
		          <td>12345</td>
              <td>John Doe</td>
		          <td>$50</td>
		          <td>01/01/2021</td>
		          <td>Completed</td>
		          <td>
		            <a href="#" class="btn btn-primary btn-sm">View</a>
  		          <a href="#" class="btn btn-danger btn-sm">Cancel</a>
		          </td>
		        </tr>
            <tr>
              <td>12346</td>
              <td>Jane Smith</td>
              <td>$75</td>
              <td>01/02/2021</td>
              <td>Pending</td>
              <td>
                <a href="#" class="btn btn-primary btn-sm">View</a>
                <a href="#" class="btn btn-danger btn-sm">Cancel</a>
              </td>
            </tr>
	        </tbody>
	    </table>
	  </div>
	</div>
</x-layout>


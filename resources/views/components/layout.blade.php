<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>POS Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- select 2 related -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  </head>
  <body>
   
    <div class="container-fluid">
      <h1 class="text-center mb-3">POS Admin Dashboard</h1>
      <div class="row">
        <div class="col-md-2">
          <div class="list-group">
            <a href="/dashboard" class="list-group-item list-group-item-action">Dashboard</a>
            <div class="btn-group list-group-item list-group-item-action dropright">
                <button class="btn bg-white text-grey dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Setup
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/unit">Unit</a>
                    <a class="dropdown-item" href="/category">Category</a>
                </div>
            </div>
            <a href="/products" class="list-group-item list-group-item-action">Products</a>
            <a href="/order" class="list-group-item list-group-item-action">Order</a>
            <a href="/expense" class="list-group-item list-group-item-action">Expenses</a>
            <a href="/users" class="list-group-item list-group-item-action">Users</a>
            <a href="/settings" class="list-group-item list-group-item-action">Settings</a>
            
          </div>
        </div>
        <div class="col-md-10">
           <x-flash />
            {{$slot}}
        </div>
        </div>
	</div>
   
	</body>
	
  
</html>

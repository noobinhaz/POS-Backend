<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>POS Admin</title>
    <link rel="stylesheet" href="app.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- select 2 related -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <style>
        .sidebar {
            height: calc(100vh - 56px); /* Adjust the height as needed */
            overflow-y: auto;
        }

        .btn-as-text {
            background: none;
            border: none;
            padding: 0;
            font-size: 1rem;
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
        }

        .btn-as-text:hover {
            color: #0056b3;
        }

        .active {
            background-color: #f8f9fa;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.list-group-item-action').on('click', function() {
                $('.list-group-item-action').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <h2 class="mb-3">Haque POS Admin</h2>
    <div class="row">
        <div class="col-md-2 pl-0">
            <div class="list-group sidebar">
                <a href="/dashboard" class="list-group-item list-group-item-action">
                    <button type="button" class="btn btn-outline-success">
                        Dashboard
                    </button>
                </a>
                <div class="btn-group list-group-item list-group-item-action dropright">
                    <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Setup
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/unit">Unit</a>
                        <a class="dropdown-item" href="/category">Category</a>
                    </div>
                </div>
                <a href="/products" class="list-group-item list-group-item-action">
                    <button type="button" class="btn btn-outline-primary">
                        Products
                    </button>
                </a>
                <a href="/order" class="list-group-item list-group-item-action">
                    <button type="button" class="btn btn-outline-primary">
                        Orders
                    </button>
                </a>
                <a href="/expense" class="list-group-item list-group-item-action">
                    <button type="button" class="btn btn-outline-primary">
                        Expenses
                    </button>
                </a>
                <a href="/users" class="list-group-item list-group-item-action">
                    <button type="button" class="btn btn-outline-warning">
                        Users
                    </button>
                </a>
                <a href="/settings" class="list-group-item list-group-item-action">
                    <button type="button" class="btn btn-outline-warning">
                        Settings
                    </button>
                </a>
                <a href="/logout" class="list-group-item list-group-item-action">
                    <form method="POST" class="inline" action="/logout">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            Logout
                        </button>
                    </form>
                </a>
            </div>
        </div>
        <div class="col-md-10 justify-content-start pl-0 ml-0">
            <x-flash />
            {{$slot}}
        </div>
    </div>
</div>
</body>
</html>

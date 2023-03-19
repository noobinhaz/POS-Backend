@if (Session::has('success'))
    <div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        document.getElementById("alert").onclick = function() {
        document.getElementById("alert").style.display = "none";}

    </script>
@elseif(Session::has('error'))
<div class="alert alert-danger text-center alert-dismissible fade show" role="alert" id="alert">
        {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        document.getElementById("alert").onclick = function() {
        document.getElementById("alert").style.display = "none";}

    </script>
@endif

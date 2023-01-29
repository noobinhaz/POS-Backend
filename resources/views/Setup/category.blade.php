<x-layout>
    <div>
        <div class='d-flex justify-content-end'>

            <button> <a href="/addCat">Add New</a></button>
        </div>
        <table class='table'>
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
            @unless(count($categories) == 0)
            @foreach ($categories as $index=>$category)
            <tr>
                    <td>{{$index}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->status ? 'Active' : 'Inactive'}}</td>
                    <th class='d-flex justify-content-left '><button>View Products</button> 
                        <button><a href="/category/{{$category->id}}"></a> Edit</button>
                        <form method='POST' action="/category/{{$category->id}}">@method("delete") @csrf<button>Delete</button></form>
                    </th>
                </tr>
            @endforeach
            @else
            <h3>No Listings to show</h3>
            @endunless
                
            <tbody>
        </table>
    <div>
</x-layout>
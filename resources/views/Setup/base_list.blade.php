<x-layout>
    <div>
        <div class='d-flex justify-content-end'>

            <a href="{{$add_new}}" style="display:block; color:black"><button class="btn btn-success">Add New</button></a>
        </div>
        <table class='table'>
            @unless(count($data) == 0 )
            <thead>
                <tr>
                    @foreach($fields as $index=>$field)
                        <th>{{$field}}</th>
                    
                    @endforeach
                </tr>

            </thead>
                    @endunless
                    
            <tbody>
            @unless(count($data) == 0)
            @foreach ($data as $index=>$datam)
            <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$datam->name}}</td>
                    @unless(!empty($datam->description))
                    @else
                    <td>{{$datam->description}}</td>
                    @endunless
                    <td>{{$datam->status ? 'Active' : 'Inactive'}}</td>
                    <th class='d-flex justify-content-left '><button class="btn btn-info">View Products</button> 
                        <button class="btn btn-warning mx-2"><a href="{{$route}}/{{$datam->id}}" style="display:block; color:black">Edit</a></button>
                        <form method='POST' action="{{$route}}/{{$datam->id}}">@method("delete") @csrf<button type="submit" class="btn btn-danger">Delete</button></form>
                    </th>
                </tr>
            @endforeach
            @else
            <h3>No Listings to show</h3>
            @endunless
                
            <tbody>
        </table>
        <div class="row">
            {{ $data->links() }}
        </div>
    <div>
</x-layout>
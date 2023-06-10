<x-layout>
    <div class="card">
        <div class="card-header text-center">
            {{$title}}
        </div>
        <div class="card-body">
        <div class='d-flex justify-content-end pr-3'>

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
                    <th class='d-flex justify-content-left '>
                        @if($view == true)
                        <a href="/category/{{$datam->id}}" class="btn btn-info">View Products</a> 
                        @endif
                        <a href="{{$route}}/{{$datam->id}}/edit" class="btn btn-warning mx-2" style="display:block; color:black">Edit</a>
                        <form method='POST' action="{{$route}}/{{$datam->id}}">@method("delete") @csrf<button type="submit" class="btn btn-danger">Delete</button></form>
                    </th>
                </tr>
            @endforeach
            @else
            <h3>No Listings to show</h3>
            @endunless
                
            <tbody>
        </table>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="pagination justify-content-center">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    <div>
    </div>
</x-layout>
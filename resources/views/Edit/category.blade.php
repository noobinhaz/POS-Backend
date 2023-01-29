<x-layout>
    <div class="card"> 
        <div class="card-header">Create Category</div>
        
        <div class="card-body">
            @unless(empty($category))

            <form method="POST" action="/category/{{$category->id}}">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">User Name</label>
                    <div class="col-md-6">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}">
                    </div>
                </div>
                <div class="form-check">
                <div class="form-group row justify-content-center">
                    <div class='col-md-3'>             
                        <input class="form-check-input" type="radio" name="status" {{$category->status == 1 ? 'checked' : ''}} value=1>
                        <label class="form-check-label">
                            Active
                        </label>
                    </div>
                    <div class='col-md-3'>
                        <input class="form-check-input" type="radio" name="status" value=0 {{$category->status == 0 ? 'checked' : ''}}>
                        <label class="form-check-label">
                            Inactive
                        </label>
                    </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
            @else 
            <h3>No Category Found</h3>
            @endunless
        </div>
    </div>
</x-layout>
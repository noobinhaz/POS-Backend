<x-layout>
    <div class="card"> 
        <div class="card-header">Create Category</div>
        
        <div class="card-body">
            @unless(empty($data))

            <form method="POST" action="{{$route}}/{{$data->id}}">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    @foreach($fields as $index=>$field)

                    <label for="{{$field}}" class="col-md-4 col-form-label text-md-right">{{$index}}</label>
                    <div class="col-md-6">
                        <input id="{{$field}}" type="{{$field}}" class="form-control @error('$field') is-invalid @enderror" name="{{$field}}" value="{{ $data->$field }}">
                    </div>
                    @endforeach
                </div>
                <div class="form-check">
                <div class="form-group row justify-content-center">
                    <div class='col-md-3'>             
                        <input class="form-check-input" type="radio" name="status" {{$data->status == 1 ? 'checked' : ''}} value=1>
                        <label class="form-check-label">
                            Active
                        </label>
                    </div>
                    <div class='col-md-3'>
                        <input class="form-check-input" type="radio" name="status" value=0 {{$data->status == 0 ? 'checked' : ''}} value=0>
                        <label class="form-check-label">
                            Inactive
                        </label>
                    </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-4 offset-md-2">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>
                    <div class="col-md-4 offset-md-2">
                        <button type="submit" class="btn btn-warning">
                        <a href="{{$route}}">Back</a>
                        </button>
                    </div>
                </div>
            </form>
            @else 
            <h3>No Data Found</h3>
            @endunless
        </div>
    </div>
</x-layout>
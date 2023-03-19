<x-layout>
   

                <div class="card"> 
                    <div class="card-header">Create Category</div>
                    
                    <div class="card-body">
                        <form method="POST" action="{{$route}}">
                            @csrf
                            <div class="form-group row">
                                @unless(count($fields) == 0)
                                @foreach($fields as $index => $field)

                                <label for="{{$field}}" class="col-md-4 col-form-label text-md-right">{{$index}}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control 
                                    @error('{{$field}}') is-invalid @enderror" 
                                    name="{{$field}}" value="{{ old($field) }}" 
                                    required autofocus>
                                    @error('{{$field}}')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @endforeach
                                @endunless
                            </div>
                            <div class="form-check">
                            <div class="form-group row justify-content-center">
                                <div class='col-md-3'>
                                    
                                    <input class="form-check-input" type="radio" name="status" checked value=1>
                                    <label class="form-check-label">
                                        Active
                                    </label>
                                </div>
                                <div class='col-md-3'>
                                    
                                    <input class="form-check-input" type="radio" name="status" value=0>
                                    <label class="form-check-label">
                                        Inactive
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-2">
                                    <button type="submit" class="btn btn-success">
                                        Create
                                    </button>
                                </div>
                                <div class="col-md-4 offset-md-2">
                                    <a href="{{$route}}">
                                        <button type="button" class="btn btn-danger">
                                                Back
                                        </button>
                                    </a>    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
</x-layout>
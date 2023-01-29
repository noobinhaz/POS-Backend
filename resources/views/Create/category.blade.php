<x-layout>
   

                <div class="card"> 
                    <div class="card-header">Create Category</div>
                    
                    <div class="card-body">
                        <form method="POST" action="/category">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">User Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
</x-layout>
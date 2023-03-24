<x-layout>
    <div class="container">
          
            <form method="POST" action="{{$data->id}}">
                @method('PUT')
                @csrf
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input id="fullName" type="text" class="form-control" name="fullName" value="{{ $data->fullName }}" required autofocus>
                @error('fullName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="userName">User Name</label>
                <input id="userName" type="text" class="form-control" name="userName" value="{{ $data->userName }}" required>
                @error('userName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="userType">User Type</label>
                <select id="userType" class="form-control" name="userType" required>
                    <option value="" disabled selected>Select User Type</option>
                    <option value="1" {{ $data->userType == '1' ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ $data->userType == '2' ? 'selected' : '' }}>Management</option>
                </select>
                @error('userType')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" class="form-control" name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ $data->gender == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="mobileNumber">Mobile Number</label>
                <input id="mobileNumber" type="tel" class="form-control" name="mobileNumber" value="{{ $data->mobileNumber }}" required>
                @error('mobileNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input id="confirm_password" type="password" class="form-control" name="confirm_password" >
                @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-warning">
                    <a href="/users" class="text-reset text-decoration-none" style="color:black">Back</a>
                </button>
            </div>
        </form>
    </div>

</x-layout>    

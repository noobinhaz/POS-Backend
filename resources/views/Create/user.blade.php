<x-layout>
    <div class="container">

            <form method="POST" action="users">
            @csrf
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input id="fullName" type="text" class="form-control" name="fullName" value="{{ old('fullName') }}" required autofocus>
                @error('fullName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="userName">User Name</label>
                <input id="userName" type="text" class="form-control" name="userName" value="{{ old('userName') }}" required>
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
                    <option value="1" {{ old('userType') == '1' ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ old('userType') == '2' ? 'selected' : '' }}>Management</option>
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
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="mobileNumber">Mobile Number</label>
                <input id="mobileNumber" type="tel" class="form-control" name="mobileNumber" value="{{ old('mobileNumber') }}" required>
                @error('mobileNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>
                @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>

</x-layout>    

@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                    <div class="form-group">
                        <label for="merchant_name">Merchant Name</label>
                        <input id="merchant_name"
                            type="text"
                            class="form-control {{ $errors->has('merchant_name') ? 'is-invalid' : '' }}"
                            name="merchant_name"
                            autofocus>
                        @error('merchant_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input id="full_name"
                            type="text"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            name="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email"
                        type="email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        name="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                     @enderror
                    
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone"
                        type="number"
                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                        name="phone">
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                     @enderror
                    
                </div>

                    <div class="form-group">
                        <label for="password"
                            class="d-block">Password</label>
                        <input id="password"
                            type="password"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            name="password">

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            
                        @enderror
                        
                    </div>
                    <div class="form-group">
                        <label for="password2"
                            class="d-block">Password Confirmation</label>
                        <input id="password2"
                            type="password"
                            class="form-control"
                            name="password_confirmation">
                    </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush

@extends('layouts.app')

@section('title', 'Edit Category')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Category</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></div>
                </div>
            </div>

            <div class="section-body">
                        <div class="card">
                            <form action="{{ route('category.update', $category) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" value="{{ $category->name }}"
                                            class="form-control {{ $errors->has("name") ? "is-invalid" : "" }}" name="name" 
                                            required="">
                                        @error("name")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                
                                    <div class="form-group mb-0">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" 
                                            data-height="150">{{ $category->description }}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush

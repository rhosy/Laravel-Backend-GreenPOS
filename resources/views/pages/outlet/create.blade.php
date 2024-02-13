@extends('layouts.app')

@section('title', 'Add New Outlet')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    {{-- <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}"> --}}
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('outlet.index') }}"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Add New Outlet</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Posts</a></div>
                    <div class="breadcrumb-item">Create New Post</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Your Outlet</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('outlet.store') }}">
                                    @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Province</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control select2 @error('province_id')
                                            is-invalid
                                        @enderror" name="province_id">
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" 
                                                    {{old('province_id') == $province->id ? 'selected' : ''}}>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">City</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control select2 @error('city_id')
                                            is-invalid
                                        @enderror" name="city_id">                                           
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">District</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control select2 @error('district_id')
                                            is-invalid
                                        @enderror" name="district_id">
                                           
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Village</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control select2 @error('village_id')
                                            is-invalid
                                        @enderror" name="village_id">
                                           
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Full Address</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control" name="address"
                                            data-height="150"
                                            ></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Add Outlet</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    {{-- <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script> --}}
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    

    <!-- Page Specific JS File -->
    {{-- <script src="{{ asset('js/page/features-post-create.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('[name="province_id"]').on('change', function() { 
                var province_id = $(this).val();
                console.log(province_id);
                $.ajax({
                    'type': 'GET',
                    'url': '{{url('city')}}?province_id='+province_id,
                    'success': function(data) { 
                        console.log(data);
                        $('[name="city_id"]').html('');
                        $.each(data, function( key, value ) {
                            $('[name="city_id"]').append('<option value="'+value.id+'">'+value.name+'</option>');
                        })
                    }
                })
            });

            // $('[name="city_id"]').on('change', function() { 
            //     var regency_id = $(this).val();
            //     console.log(regency_id);
            //     $.ajax({
            //         'type': 'GET',
            //         'url': '{{url('district')}}?regency_id='+regency_id,
            //         'success': function(data) { 
            //             console.log(data);
            //             $('[name="district_id"]').html('');
            //             $.each(data, function( key, value ) {
            //                 $('[name="district_id"]').append('<option value="'+value.id+'">'+value.name+'</option>');
            //             })
            //         }
            //     })
            // });

            // $('[name="district_id"]').on('change', function() { 
            //     var district_id = $(this).val();
            //     console.log(district_id);
            //     $.ajax({
            //         'type': 'GET',
            //         'url': '{{url('village')}}?district_id='+district_id,
            //         'success': function(data) { 
            //             console.log(data);
            //             $('[name="village_id"]').html('');
            //             $.each(data, function( key, value ) {
            //                 $('[name="village_id"]').append('<option value="'+value.id+'">'+value.name+'</option>');
            //             })
            //         }
            //     })
            // });
        });
    </script>
@endpush

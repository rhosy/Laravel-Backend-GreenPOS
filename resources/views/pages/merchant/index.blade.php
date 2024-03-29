@extends('layouts.app')

@section('title', 'Merchants')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Merchants</h1>
                {{-- <div class="section-header-button">
                    <a href="{{ route('use') }}" class="btn btn-primary">Add New</a>
                </div> --}}
                {{-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">merchants</a></div>
                    <div class="breadcrumb-item">All Users</div>
                </div> --}}
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        {{-- @include('layouts.alert') --}}
                    </div>
                </div>
                {{-- <h2 class="section-title">Users</h2>
                <p class="section-lead">
                    You can manage all Users, such as editing, deleting and more.
                </p> --}}


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4>All Posts</h4>
                            </div> --}}
                            <div class="card-body">
                                {{-- <div class="float-left">  
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div> --}}
                                <div class="float-right">
                                    <form method="GET" action="{{ route('merchant.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($merchants as $merchant)
                                            <tr>
                                                <td>
                                                    <a href="#">
                                                        <img alt="image"
                                                            src="{{ asset('storage/images/merchant/' . $merchant->logo) }}"
                                                            onerror="this.onerror=null;this.src='{{ asset('img/avatar/avatar-1.png') }}'"
                                                            class="rounded-circle"
                                                            width="40"
                                                            height="40"
                                                            data-toggle="title"
                                                            title="">
                                                    </a>
                                                </td>
                                                <td>{{ $merchant->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($merchant->created_at)->format('d M y') }}</td>
                                                <td>
                                                    @if (Auth::user()->role == 'admin')
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('merchant.edit', $merchant->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                    </div>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- {{ $merchants->withQueryString()->links() }} --}}
                                </div>
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
   
@endpush
@extends('admin.layouts.app')

@section('title')
Dashboard
@endsection

@section('content')

<!-- Page title -->
<div class="d-flex align-items-center justify-content-between mb-4 mt-3">
    <h4 class="fw-semibold mb-0">Dashboard</h4>
</div>

<!-- Stats -->
<div class="row g-4 justify-content-center">

    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Today's Posts</p>
                <h3 class="fw-bold mb-0">{{ $todayPosts->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">Yesterday's Posts</p>
                <h3 class="fw-bold mb-0">{{ $yesterdayPosts->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">This Month Posts</p>
                <h3 class="fw-bold mb-0">{{ $monthPosts->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="text-muted small mb-1">This Year Posts</p>
                <h3 class="fw-bold mb-0">{{ $yearPosts->count() }}</h3>
            </div>
        </div>
    </div>

</div>

@endsection

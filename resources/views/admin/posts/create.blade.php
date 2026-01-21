@extends('admin.layouts.app')

@section('title')
Post
@endsection

@section("content")
<div>
    <!-- Page title -->
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <h4 class="fw-semibold mb-0">
            Create
        </h4>


    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-0">


                            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row g-4">
                                    <!-- User ID -->
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">User ID</label>
                                        <select class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                                            id="user_id">
                                            <option value="" selected disabled>Choose a User</option>
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if (old('user_id')==$user->id)
                                                selected
                                                @endif>
                                                {{ $user->id }}
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <!-- Image URL -->
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Image URL</label>
                                        <input type="file"
                                            name="image_url"
                                            id="image_url"
                                            class="form-control">
                                    </div>

                                    <!-- Content -->
                                    <div class="col-12">
                                        <label class="form-label text-muted small">Content</label>
                                        <textarea name="content"
                                            id="content"
                                            rows="4"
                                            class="form-control"
                                            placeholder="Write post content..."
                                            required>{{ old('content') }}</textarea>
                                    </div>

                                </div>

                                <!-- Action -->
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('admin.posts.index') }}"
                                        class="btn btn-light border">
                                        Cancel
                                    </a>

                                    <button type="submit"
                                        class="btn btn-dark">
                                        Create Post
                                    </button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
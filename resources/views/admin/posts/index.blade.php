@extends('admin.layouts.app')

@section('title')
Post
@endsection

@section("content")
<div>
    <!-- Page title -->
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <h4 class="fw-semibold mb-0">
            Posts ({{ $posts->count() }})
        </h4>

        <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> New Post
        </a>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-0">

                                <!-- Table -->
                                <table class="table table-hover table-borderless align-middle mb-0">
                                    <thead class="text-muted small text-uppercase border-bottom">
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Content</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($posts as $key => $post)
                                        <tr class="border-bottom">
                                            <!-- Index -->
                                            <td class="text-muted">{{ $key + 1 }}</td>

                                            <!-- post -->
                                            <td>
                                                <div class="fw-medium">{{ $post->user_id }}</div>

                                            </td>

                                            <!-- Content -->
                                            <td class="text-muted">{{ $post->content }}</td>

                                            <!-- Img -->
                                            <td class="fw-medium">
                                                @if ($post->image_url)
                                                <img src="{{asset($post->full_image_path)}}" alt="{{ $post->user_id }}"
                                                    class="img-fluid rounded mb-1" width="70" height="70">
                                                @endif
                                            </td>

                                            <!-- Images -->
                                            <td>
                                                {{ $post->created_at->diffForHumans() }}
                                            </td>



                                            <!-- Action -->
                                            <td class="text-end">
                                                <!-- <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                    class="text-muted me-3 text-decoration-none">
                                                    <i class="fas fa-pen"></i>
                                                </a> -->

                                                <a href="javascript:void(0);"
                                                    onclick="deleteItem('{{ $post->id }}')"
                                                    class="text-muted text-decoration-none">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                                <form id="{{ $post->id }}"
                                                    action="{{ route('admin.posts.destroy', $post->id) }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
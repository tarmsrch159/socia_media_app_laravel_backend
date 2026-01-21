@extends('admin.layouts.app')

@section('title')
User
@endsection

@section("content")
<div>
    <!-- Page title -->
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <h4 class="fw-semibold mb-0">
            Users ({{ $users->count() }})
        </h4>

       
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $key => $user)
                                        <tr class="border-bottom">
                                            <!-- Index -->
                                            <td class="text-muted">{{ $key + 1 }}</td>

                                            <!-- user -->
                                            <td>
                                                <div class="fw-medium">{{ $user->name }}</div>

                                            </td>

                                            <!-- Content -->
                                            <td class="text-muted">{{ $user->email }}</td>


                                            <!-- Created At -->
                                            <td>
                                                {{ $user->created_at->diffForHumans() }}
                                            </td>



                                            <!-- Action -->
                                            <td class="text-end">
                                                

                                                <a href="javascript:void(0);"
                                                    onclick="deleteItem('{{ $user->id }}')"
                                                    class="text-muted text-decoration-none">

                                                    
                                                    <i class="fas fa-trash"></i>


                                                    
                                                </a>

                                                <form id="{{ $user->id }}"
                                                    action="{{ route('admin.users.destroy', $user->id) }}"
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
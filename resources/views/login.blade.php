<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                @if (session('error'))
                <div class="alert alert-danger text-center small">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <h4 class="fw-semibold mb-1">Admin Panel</h4>
                            <p class="text-muted small mb-0">
                                เข้าสู่ระบบ
                            </p>
                        </div>

                        <form action="{{ route('admin.auth') }}" method="post">
                            @csrf

                            <div class="form-floating mb-3">
                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    placeholder="name@example.com"
                                >
                                <label for="email">Email address</label>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="รหัสผ่าน"
                                >
                                <label for="password">รหัสผ่าน</label>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark w-100 py-2">
                                เข้าสู่ระบบ
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

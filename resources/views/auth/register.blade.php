<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 0.75rem;
        }
    </style>
</head>

<body class="d-flex align-items-center min-vh-100">

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header text-center fs-4 fw-bold">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label fs-6">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Full Name --}}
                            <div class="mb-3">
                                <label for="full_name" class="form-label fs-6">{{ __('Full Name') }}</label>
                                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    name="full_name" value="{{ old('full_name') }}" required>
                                @error('full_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label fs-6">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Username --}}
                            <div class="mb-3">
                                <label for="username" class="form-label fs-6">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" required>
                                @error('username')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label fs-6">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required>
                                @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            {{-- <div class="mb-3">
                                <label for="password-confirm" class="form-label fs-6">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div> --}}

                            <div class="mb-3">
                                <label for="company" class="form-label fs-6">{{ __('Company') }}</label>
                                <select name="company" class="form-select @error('company') is-invalid @enderror" required>
                                    <option value="">-- เลือก Company --</option>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company') == $company->id ? 'selected' : '' }}>
                                        {{ $company->company_name_th }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('company')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-6">{{ __('Approved Company') }}</label>
                                <div>
                                    @foreach($companies as $company)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox"
                                            name="company_approver[]"
                                            value="{{ $company->id }}"
                                            {{ (collect(old('company_approver'))->contains($company->id)) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $company->company_name_th }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @error('company_approver')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Role --}}
                            <div class="mb-6">
                                <label for="role" class="form-label fs-6">{{ __('Role') }}</label>
                                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="">-- เลือก Role --</option>
                                    <option value="staff">Staff</option>
                                    <option value="audit">Audit</option>
                                    <option value="manager">Manager</option>
                                    <option value="md">MD</option>
                                </select>
                                @error('role')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary mb-3">{{ __('Register') }}</button>
                                <a href="{{ route('login') }}" class="btn btn-secondary text-center">ย้อนกลับ</a>
                            </div>

                            {{-- Link to login --}}
                            <!-- <div class="text-center mt-3">
                                <span>Already have an account? </span>
                                <a href="{{ route('login') }}">Login</a>
                            </div> -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                Swal.fire({
                    title: 'กำลังบันทึกข้อมูล...',
                    text: 'กรุณารอสักครู่',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });


            });
        });
    </script>

    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ!',
            text: 'สร้างบัญชีเรียบร้อยแล้ว',
            timer: 2000,
            showConfirmButton: true
        });
    </script>
    @endif

    @if(session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'ผิดพลาด!',
            text: '{{ session("error") }}',
            showConfirmButton: true
        });
    </script>
    @endif

</body>

</html>
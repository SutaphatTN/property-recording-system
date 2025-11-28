<div class="modal fade modalEditUser" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditUserLabel">แก้ไขข้อมูลผู้ใช้งาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $user->name }}" required>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="full_name"
                            class="col-md-4 col-form-label text-md-end">{{ __('Full Name') }}</label>

                        <div class="col-md-6">
                            <input id="full_name" type="text"
                                class="form-control @error('full_name') is-invalid @enderror"
                                name="full_name" value="{{ $user->full_name }}" required>

                            @error('full_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="email" value="{{ $user->email }}">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="username"
                            class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="username" value="{{ $user->username }}">

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password"
                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="password" value="{{ $user->password_plain }}">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="company"
                            class="col-md-4 col-form-label text-md-end">{{ __('Company') }}</label>

                        <div class="col-md-6">
                            <select name="company" class="form-control @error('name') is-invalid @enderror">
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ (old('company', $user->company) == $company->id) ? 'selected' : '' }}>
                                    {{ $company->company_name_th }}
                                </option>
                                @endforeach
                            </select>

                            @error('company')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Approved Company') }}</label>
                        <div class="col-md-6">
                            @php
                            $selectedCompanies = old('company_approver', explode(',', $user->company_approver ?? ''));
                            @endphp

                            @foreach($companies as $company)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox"
                                    name="company_approver[]"
                                    value="{{ $company->id }}"
                                    {{ in_array($company->id, $selectedCompanies) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $company->company_name_th }}</label>
                            </div>
                            @endforeach
                        </div>
                        @error('company_approver')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="role"
                            class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                        <div class="col-md-6">
                            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="audit" {{ $user->role == 'audit' ? 'selected' : '' }}>Audit</option>
                                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="md" {{ $user->role == 'md' ? 'selected' : '' }}>MD</option>
                            </select>

                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" id="btnUpdateUser" class="btn btn-primary">
                                แก้ไขข้อมูล
                            </button>

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modalEditUser .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modalEditUser .modal-title {
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
</style>
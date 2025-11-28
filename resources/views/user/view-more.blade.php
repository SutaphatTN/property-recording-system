<div class="modal fade modalViewMoreUser" tabindex="-1" aria-labelledby="modalViewMoreUserLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewMoreUserLabel">ข้อมูลผู้ใช้งาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="name"
                        class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text"
                            class="form-control readonly-field bg-light"
                            name="name" value="{{ $user->name }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="full_name"
                        class="col-md-4 col-form-label text-md-end">{{ __('Full Name') }}</label>

                    <div class="col-md-6">
                        <input id="full_name" type="text"
                            class="form-control readonly-field bg-light"
                            name="full_name" value="{{ $user->full_name }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email"
                        class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="text"
                            class="form-control readonly-field bg-light"
                            name="email" value="{{ $user->email }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="username"
                        class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text"
                            class="form-control readonly-field bg-light"
                            name="username" value="{{ $user->username }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password_plain"
                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password_plain" type="text"
                            class="form-control readonly-field bg-light"
                            name="password_plain" value="{{ $user->password_plain }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="company"
                        class="col-md-4 col-form-label text-md-end">{{ __('Company') }}</label>

                    <div class="col-md-6">
                        <input id="company" type="text"
                            class="form-control readonly-field bg-light"
                            name="company" value="{{ $user->companyRelation?->company_name_th ?? '-' }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="role"
                        class="col-md-4 col-form-label text-md-end">{{ __('Approved Company') }}</label>

                    <div class="col-md-6 d-flex flex-wrap">
                        @php
                        $approvedCompanies = explode(',', $user->company_approver ?? '');
                        @endphp

                        @foreach($companies as $company)
                        @if(in_array($company->id, $approvedCompanies))
                        <span class="badge bg-label-primary me-2 mb-2 d-inline-flex align-items-center">
                            {{ $company->company_name_th }}
                        </span>

                        @endif
                        @endforeach

                        @if(empty($approvedCompanies[0]))
                        <span>-</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="role"
                        class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                    <div class="col-md-6">
                        <input id="role" type="text"
                            class="form-control readonly-field bg-light"
                            name="role" value="{{ ucfirst($user->role) }}">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .modalViewMoreUser .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modalViewMoreUser .modal-title {
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
</style>
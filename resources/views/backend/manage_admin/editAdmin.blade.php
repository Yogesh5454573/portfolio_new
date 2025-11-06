@extends('backend.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Admin</h5>
                        <a href="{{ route('admin.adminList') }}">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="menu-icon tf-icons ti ti-user"></i>
                                <span>Manage Admins</span>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="custom-validation" method="POST"
                            action="{{ route('admin.addUpdateAdmin', $adminData->token) }}">
                            @method('PUT')
                            @csrf
                            <div class="mb-6">
                                <label class="form-label">Admin Type<font color="red"> *</font></label>
                                <select class="form-select" name="admin_type">
                                    <option selected value="">Choose Type</option>
                                    <option value="admin"
                                        {{ old('admin_type', $adminData->admin_type) == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                </select>
                                @error('admin_type')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="name">Name<font color="red"> *</font></label>
                                <input type="text" name="name" value="{{ old('name', $adminData->name) }}"
                                    class="form-control" id="name" placeholder="Name" />
                                @error('name')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">Email<font color="red"> *</font></label>
                                <input type="text" name="email" value="{{ old('email', $adminData->email) }}"
                                    class="form-control" id="description" placeholder="Email" />
                                @error('email')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="password">Password</font></label>
                                <input type="text" name="password" class="form-control" id="password"
                                    placeholder="Password" />
                                @error('password')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label mb-3 d-flex">Status&nbsp;<font color="red">*</font></label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="active" id="active"
                                        {{ old('status', $adminData->status) == 'active' ? 'checked' : '' }}
                                        class="form-check-input" checked>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" id="inactive"
                                        {{ old('status', $adminData->status) == 'inactive' ? 'checked' : '' }}
                                        value="inactive" class="form-check-input">
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                                @error('status')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Submit
                                    </button>
                                    <a href="{{ route('admin.adminList') }}" class="btn btn-danger waves-effect"> Cancel </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('backend.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Service</h5>
                        <a href="{{ route('admin.serviceList') }}">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="menu-icon tf-icons ti ti-user"></i>
                                <span>Manage Services</span>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="custom-validation" method="POST"
                            action="{{ route('admin.addUpdateService', $serviceData->token) }}">
                            @method('PUT')
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="name">Service Name<font color="red"> *</font></label>
                                <input type="text" name="ser_name" value="{{ old('ser_name', $serviceData->ser_name) }}"
                                    class="form-control" id="ser_name" placeholder="Service Name" />
                                @error('ser_name')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">Service Description<font color="red"> *</font></label>
                                <textarea name="ser_desc" class="form-control" id="ser_desc" placeholder="Service Description">{{ old('ser_desc', $serviceData->ser_desc) }}</textarea>
                                @error('ser_desc')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label mb-3 d-flex">Status&nbsp;<font color="red">*</font></label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="active"
                                        {{ old('status', $serviceData->status) == 'active' ? 'checked' : '' }}
                                        class="form-check-input" checked>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status"
                                        {{ old('status', $serviceData->status) == 'inactive' ? 'checked' : '' }}
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
                                    <a href="{{ route('admin.skillList') }}" class="btn btn-danger waves-effect"> Cancel </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

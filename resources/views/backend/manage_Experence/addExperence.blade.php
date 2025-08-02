@extends('backend.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Add Expericence</h5>
                        <a href="{{ route('admin.experienceList') }}">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="menu-icon tf-icons ti ti-user"></i>
                                <span>Manage Expericence</span>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="custom-validation" method="POST" action="{{ route('admin.addUpdateExperience') }}">
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="name">Expericence Name <font color="red"> *</font></label>
                                <input type="text" name="ex_name" value="{{ old('ex_name') }}" class="form-control"
                                    id="ex_name" placeholder="Expericence Name" />
                                @error('ex_name')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">Company Name<font color="red"> *</font></label>
                                <input type="text" name="com_name" value="{{ old('com_name') }}" class="form-control"
                                    id="com_name" placeholder="Company Name" />
                                @error('com_name')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">Start Date<font color="red"> *</font></label>
                                <input type="text" name="start_date" value="{{ old('start_date') }}" class="form-control"
                                    id="start_date" placeholder="Start Date" />
                                @error('start_date')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">End Date<font color="red"> *</font></label>
                                <input type="text" name="end_date" value="{{ old('end_date') }}" class="form-control"
                                    id="end_date" placeholder="End Date" />
                                @error('end_date')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">Company Description<font color="red"> *</font></label>
                               <textarea name="com_des" class="form-control" id="com_des" placeholder="Company Description ">{{ old('com_des') }}</textarea>
                                @error('com_des')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label mb-3 d-flex">Status&nbsp;<font color="red">*</font></label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="active" id="active"
                                        {{ old('status') == '1' ? 'checked' : '' }} class="form-check-input" checked>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" {{ old('status') == '0' ? 'checked' : '' }}
                                        value="inactive" class="form-check-input" id="inactive">
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
                                    <a href="{{ route('admin.experienceList') }}" class="btn btn-danger waves-effect"> Cancel </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

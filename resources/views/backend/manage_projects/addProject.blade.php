@extends('backend.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Add Skill</h5>
                        <a href="{{ route('admin.projectList') }}">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="menu-icon tf-icons ti ti-user"></i>
                                <span>Manage Skills</span>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="custom-validation" method="POST" action="{{ route('admin.addUpdateProject') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="name">Project Name <font color="red"> *</font></label>
                                <input type="text" name="proj_name" value="{{ old('proj_name') }}" class="form-control"
                                    id="proj_name" placeholder="Project Name " />
                                @error('proj_name')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">Project Link <font color="red"> *</font></label>
                                <input type="text" name="proj_link" value="{{ old('proj_link') }}" class="form-control"
                                    id="proj_link" placeholder="Project Link " />
                                @error('proj_link')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">Project Image <font color="red"> *</font></label>
                                <input type="file" name="proj_img" value="{{ old('proj_img', ) }}" class="form-control"
                                    id="proj_img"  />
                                @error('proj_img')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label mb-3 d-flex">Status&nbsp;<font color="red">*</font></label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="active" id="active"
                                        {{ old('status') == 'active' ? 'checked' : '' }} class="form-check-input" checked>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" {{ old('status') == 'inactive' ? 'checked' : '' }}
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
                                    <a href="{{ route('admin.projectList') }}" class="btn btn-danger waves-effect"> Cancel </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

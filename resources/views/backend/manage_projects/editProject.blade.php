@extends('backend.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Project</h5>
                        <a href="{{ route('admin.projectList') }}">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="menu-icon tf-icons ti ti-user"></i>
                                <span>Manage Projects</span>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="custom-validation" method="POST"
                            action="{{ route('admin.addUpdateProject', $projectData->token) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="name">Project Name<font color="red"> *</font></label>
                                <input type="text" name="proj_name"
                                    value="{{ old('proj_name', $projectData->proj_name) }}" class="form-control"
                                    id="proj_name" placeholder="Skill Name" />
                                @error('proj_name')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">Project Link<font color="red"> *</font>
                                    </label>
                                <input type="text" name="proj_link"
                                    value="{{ old('proj_link', $projectData->proj_link) }}" class="form-control"
                                    id="proj_link" placeholder="Skill Percenatage" />
                                @error('proj_link')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="mb-6">
                                    <label class="form-label" for="description">Project Image <font color="red"> *</font>
                                        </label>
                                    <input type="file" name="proj_img" class="form-control" id="proj_img" />
                                    @error('proj_img')
                                        <span class="messages">
                                            <p class="text-danger error">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    @if (!empty($projectData->proj_img))
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/proj_imgs/' . $projectData->proj_img) }}"
                                                alt="{{ $altText ?? 'Proj img' }}" width="80" height="80"
                                                style="object-fit: cover; border-radius: 8px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="form-label mb-3 d-flex">Status&nbsp;<font color="red">*</font></label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="1"
                                        {{ old('status', $projectData->status) == '1' ? 'checked' : '' }}
                                        class="form-check-input" checked>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status"
                                        {{ old('status', $projectData->status) == '0' ? 'checked' : '' }} value="0"
                                        class="form-check-input">
                                    <label class="form-check-label" for="in-active">Inactive</label>
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
                                    <a href="{{ route('admin.projectList') }}" class="btn btn-danger waves-effect"> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

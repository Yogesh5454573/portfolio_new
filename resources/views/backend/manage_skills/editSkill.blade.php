@extends('backend.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Skill</h5>
                        <a href="{{ route('admin.skillList') }}">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="menu-icon tf-icons ti ti-user"></i>
                                <span>Manage Skill</span>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="custom-validation" method="POST"
                            action="{{ route('admin.addUpdateSkill', $skillsData->token) }}">
                            @method('PUT')
                            @csrf
                            <div class="mb-6">
                                <label class="form-label">Skill Type <font color="red">*</font></label>
                                    <select class="form-select" name="skill_type" required>
                                        <option value="">Select Skill Type</option>
                                        <option value="languages" {{ old('skill_type', $skillsData->skill_type ?? '') == 'languages' ? 'selected' : '' }}>Languages</option>
                                        <option value="framework" {{ old('skill_type', $skillsData->skill_type ?? '') == 'framework' ? 'selected' : '' }}>Framework</option>
                                    </select>
                                @error('skill_type')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="name">Skill Name<font color="red"> *</font></label>
                                <input type="text" name="skill_name" value="{{ old('skill_name', $skillsData->skill_name) }}"
                                    class="form-control" id="skill_name" placeholder="Skill Name" />
                                @error('skill_name')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="description">Skill Percenatage<font color="red"> *</font></label>
                                <input type="text" name="skill_per" value="{{ old('skill_per', $skillsData->skill_per) }}"
                                    class="form-control" id="skill_per" placeholder="Skill Percenatage" />
                                @error('skill_per')
                                    <span class="messages">
                                        <p class="text-danger error">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label mb-3 d-flex">Status&nbsp;<font color="red">*</font></label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="1" id="active"
                                        {{ old('status', $skillsData->status) == 'active' ? 'checked' : '' }}
                                        class="form-check-input" checked>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" id="inactive"
                                        {{ old('status', $skillsData->status) == 'inactive' ? 'checked' : '' }}
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

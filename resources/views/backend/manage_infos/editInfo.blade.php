@extends('backend.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Information</h5>
                        <a href="{{ route('admin.infoList') }}">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="menu-icon tf-icons ti ti-user"></i>
                                <span>Manage Information</span>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="custom-validation" method="POST"
                            action="{{ route('admin.addUpdateInfo', $InfoData->token) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="description">Name<font color="red"> *</font>
                                        </label>
                                        <input type="text" name="name" value="{{ old('name', $InfoData->name) }}"
                                            class="form-control" id="name" placeholder="name" />
                                        @error('name')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="description">Date Of Birth<font color="red"> *
                                            </font>
                                        </label>
                                        <input type="date" name="dob" value="{{ old('dob', $InfoData->dob) }}"
                                            class="form-control" id="dob" />
                                        @error('dob')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="description">Degree<font color="red"> *</font>
                                        </label>
                                        <input type="text" name="degree" value="{{ old('degree', $InfoData->degree) }}"
                                            class="form-control" id="degree" placeholder="Degree" />
                                        @error('degree')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="description">Email<font color="red"> *</font>
                                        </label>
                                        <input type="text" name="email" value="{{ old('email', $InfoData->email) }}"
                                            class="form-control" id="email" placeholder="Email" />
                                        @error('email')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="description">Experience<font color="red"> *</font>
                                        </label>
                                        <input type="text" name="experience"
                                            value="{{ old('experience', $InfoData->experience) }}" class="form-control"
                                            id="experience" placeholder="Project Link " />
                                        @error('experience')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="name">Resume File<font color="red"> *</font>
                                        </label>
                                        <div class="input-group">
                                            <input type="file" name="resume_file" class="form-control" id="Resume File"
                                                placeholder="Resume File" />
                                            @if ($InfoData->resume_file)
                                                <a href="{{ route('admin.openResumeFile', ['folder' => 'resume_files', 'token' => $InfoData->token]) }}"
                                                    target="_blank" class="btn btn-primary waves-effect">View</a>
                                            @endif
                                        </div>
                                        @error('resume_file')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="description">About Me <font color="red"> *
                                            </font></label>
                                        <textarea name="about_me" class="form-control" id="about_me" placeholder="About Me">{{ old('about_me', $InfoData->about_me) }}</textarea>
                                        @error('about_me')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="description">Address <font color="red"> *
                                            </font></label>
                                        <textarea name="address" class="form-control" id="about_me" placeholder="address">{{ old('address', $InfoData->address) }}</textarea>
                                        @error('address')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="description">Freelance <font color="red"> *
                                            </font>
                                        </label>
                                        <input type="text" name="freelance"
                                            value="{{ old('freelance', $InfoData->freelance) }}" class="form-control"
                                            id="freelance" placeholder="Freelance " />
                                        @error('freelance')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="description">Photo<font color="red"> *</font>
                                        </label>
                                        <input type="file" name="photo" class="form-control" id="photo" />
                                        @error('photo')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="col-lg-6">
                                        @if (!empty($InfoData->photo))
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/photos/' . $InfoData->photo) }}"
                                                    alt="{{ $altText ?? 'Proj img' }}" width="80" height="80"
                                                    style="object-fit: cover; border-radius: 8px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-6">
                                        <label class="form-label" for="phone">Phone<font color="red"> *</font>
                                        </label>
                                        <input type="text" name="phone"
                                            value="{{ old('phone', $InfoData->phone) }}" class="form-control"
                                            id="phone" placeholder="Phone" />
                                        @error('phone')
                                            <span class="messages">
                                                <p class="text-danger error">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Submit
                                    </button>
                                    <a href="{{ route('admin.infoList') }}" class="btn btn-danger waves-effect">
                                        Cancel </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

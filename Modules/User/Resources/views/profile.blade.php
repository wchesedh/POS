@extends('layouts.app')

@section('title', 'User Profile')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('utils.alerts')
                <h3>Hello, <span class="text-primary">{{ auth()->user()->name }}</span></h3>
                <p class="font-italic">Change your profile information & password from here...</p>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="image">Profile Image</label>
                                <img style="width: 100px;height: 100px;" class="d-block mx-auto img-thumbnail img-fluid rounded-circle mb-2" src="{{ auth()->user()->getFirstMediaUrl('avatars') }}" alt="Profile Image">
                                <div class="dropzone d-flex flex-wrap align-items-center justify-content-center" id="profile-image-dropzone">
                                    <div class="dz-message" data-dz-message>
                                        <i class="bi bi-cloud-arrow-up"></i>
                                        <p>Drop image here or click to upload</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required value="{{ auth()->user()->name }}">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" required value="{{ auth()->user()->email }}">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Profile <i class="bi bi-check"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.update.password') }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="current_password">Current Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="current_password" required>
                                @error('current_password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">New Password <span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="password" required>
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="password_confirmation" required>
                                @error('password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Password <i class="bi bi-check"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')
    <script>
        var uploadedImageMap = {}
        Dropzone.options.profileImageDropzone = {
            url: '{{ route('dropzone.upload') }}',
            maxFilesize: 1,
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFiles: 1,
            addRemoveLinks: true,
            dictRemoveFile: "<i class='bi bi-x-circle text-danger'></i> remove",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">');
                uploadedImageMap[file.name] = response.name;
            },
            removedfile: function (file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedImageMap[file.name];
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('dropzone.delete') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'file_name': `${name}`
                    },
                });
                $('form').find('input[name="image"][value="' + name + '"]').remove();
            },
            init: function () {
                @if(auth()->user()->getFirstMedia('avatars'))
                var file = {
                    name: "{{ auth()->user()->getFirstMedia('avatars')->file_name }}",
                    size: {{ auth()->user()->getFirstMedia('avatars')->size }},
                };
                this.emit("addedfile", file);
                this.emit("thumbnail", file, "{{ auth()->user()->getFirstMediaUrl('avatars') }}");
                this.emit("complete", file);
                $('form').append('<input type="hidden" name="image" value="' + file.name + '">');
                @endif
            }
        }
    </script>
@endpush



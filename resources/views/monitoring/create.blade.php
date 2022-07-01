@extends('layouts')

@section('content')
    <div class="card">
        <div class="card-header">
            Create Project
        </div>
        <div class="card-body">
            <form action="{{ route('project.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Project Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="client">Client</label>
                    <input type="text" class="form-control" id="client" name="client" value="{{ old('client') }}">
                    @error('client')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="leader">Leader</label>
                    <input type="text" class="form-control" id="leader" name="leader" value="{{ old('leader') }}">
                    @error('leader')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <img src="" alt="" id="output" style="width: 300px;">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start">Start Date</label>
                            <input type="date" class="form-control" id="start" name="start" value="{{ old('start') }}">
                            @error('start')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end">End Date</label>
                            <input type="date" class="form-control" id="end" name="end" value="{{ old('end') }}">
                            @error('end')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="progress">Progress *%* <i>max 100</i></label>
                    <input type="number" class="form-control" id="progress" min="0" max="100" name="progress" value="{{ old('progress') }}">
                    @error('progress')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group text-center">
                   <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $("#image").change(function() {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#output').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <h2>User Profile</h2>

    <!-- Display user profile details -->
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="form-group mt-2">
            <label for="image">Profile Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
            <img id="image-preview" class="rounded mt-2 img-fluid" src="#" alt="Preview" style="display: none; height: 200px;">
        </div>

        <script>
            function previewImage(input) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('image-preview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }

            document.getElementById('image').addEventListener('change', function () {
                previewImage(this);
            });
        </script>

        <button type="submit" class="btn mt-2 text-white" style="background-color: rgb(46,64,108)">Update Profile</button>
    </form>

    <!-- Display rented books -->
    <h2>Rented Books</h2>
    @if ($rentals->isEmpty())
        <p>No books rented yet.</p>
    @else
        <ul>
            @foreach ($rentals as $rental)
                <li>{{ $rental->book->title }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

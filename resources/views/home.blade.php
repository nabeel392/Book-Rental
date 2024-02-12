@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('success'))
    <div id="statusMessage" class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light rounded" style="background-color: rgb(46,64,108)">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <h3 class="text-white">Book rental</h3>
                        <ul class="navbar-nav ml-auto ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(Auth::user()->image)
                                    <img src="{{ asset('images/' . Auth::user()->image) }}" class="rounded-circle mr-2 me-2" style="height: 50px;width:50px" alt="User Image">
                                    @else
                                    <img src="{{ asset('images/dummyimage.jpg') }}" class="rounded-circle mr-2 me-2" style="height: 50px;width:50px" alt="Dummy Image">
                                @endif
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>
        </div>
    </div>


    <div class="mb-3 mt-3">
        <form action="{{ route('home') }}" method="GET" id="filter-form">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Search by Book Title" value="{{ request('title') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="published_date" id="published_date" placeholder="Search by Publishing Date" value="{{ request('published_date') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="category" name="category" placeholder="Search Category" value="{{ request('category') }}">
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn text-white" style="background-color:rgb(64, 46, 108)">Apply Filters</button>
                <a href="{{ route('home') }}" class="btn btn-secondary">Clear Filters</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Function to submit the form
            function submitForm() {
                $('#filter-form').submit();
            }

            // Event listeners for filter inputs
            $('#title, #published_date, #category').on('change', function() {
                submitForm();
            });
        });
    </script>





    <div class="card-body mt-5">
        <div class="row">
            @foreach ($books as $book)

            <div class="col-md-6 mb-4">
                <a href="{{ route('books.show', $book) }}" style="text-decoration:none;">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="{{ $book->image }}" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">{{ Str::limit($book->title, 30) }}</h5>
                          <p class="card-text">Author: {{ $book->author }}</p>
                        <p class="card-text">Published Date: {{ $book->published_date }}</p>
                        <p class="card-text">Publisher: {{ $book->publisher }}</p>
                        <p class="card-text">Pages: {{ $book->pages }}</p>
                        <p class="card-text">Category: {{ $book->category }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
                @if ($book->is_available)
                <div class="d-flex align-items-center justify-content-center">
                <p class="text-white mt-3 bg-success p-2 rounded d-inline">Available</p>
                <form action="{{ route('books.rent', $book) }}" method="POST" class="ms-3">
                    @csrf
                    <button type="submit" class="btn btn-primary ">+ Rent</button>
                </form>
            </div>
                @else
                <p class="text-white mt-3 bg-danger p-2 rounded">Not Available</p>
                @endif

            </div>

            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>

</div>
@endsection

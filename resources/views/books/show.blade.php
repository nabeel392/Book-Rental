@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center d-flex mb-2">
    <img src="{{ $book->image }}" class="img-fluid rounded-5" style="height:400px;width:100%" alt="...">
    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $book->title }}</h3>
            <p class="card-text">Author: {{ $book->author }}</p>
            <p class="card-text">Published Date: {{ $book->published_date }}</p>
            <p class="card-text">Publisher: {{ $book->publisher }}</p>
            <p class="card-text">Pages: {{ $book->pages }}</p>
            <p class="card-text">Category: {{ $book->category }}</p>

        </div>
    </div>
</div>
@endsection

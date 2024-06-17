@section('title', "Movie Details: $movie->title ")
@extends('layouts.admin')

@section('content')
    <section class="container py-5">

        <div class="container rounded-2 hype-shadow-white p-5 container-table mb-5">
            <h1 class="text-center hype-text-shadow text-white fw-bolder mb-2">{{ $movie->title }} </h1>
            <h4 class="text-center mb-5">{!! \App\Functions\Helpers::getStars(floor($movie->avarage_rating)) !!}
            </h4>
            <div class="container">
                <div class="row mb-4">
                    <div class="col-4">
                        <img class="img-fluid w-100"
                            src="{{ strpos($movie->poster_path, 'http') !== false ? $movie->poster_path : asset('storage/' . $movie->poster_path) }}"
                            alt="{{ $movie->title }}">
                    </div>
                    <div class="col-8 d-flex flex-column text-white">
                        <h4>Lingua</h4>
                        <h6>{{ $movie->original_language }}</h6>
                        <h4 class="mt-3">Movie db Id</h4>
                        <h6>{{ $movie->theMovieDb_id }}</h6>
                        <h4 class="mt-3">Trama</h4>
                        <p style="max-height: 200px" class="overflow-auto">{{ $movie->overview }}</p>
                        <h4 class="mt-3">Immagine di Backdrop</h4>
                        <div class=" w-50 ">
                            <img class="img-fluid w-100"
                                src="{{ strpos($movie->backdrop_path, 'http') !== false
                                    ? $movie->backdrop_path
                                    : asset('storage/' . $movie->backdrop_path) }}"
                                alt="{{ $movie->title }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-5 mt-auto">
                    <a href="{{ route('admin.movies.index') }}">
                        <i role="button" type="submit"
                            class="fa-solid fa-arrow-left fs-1 text-white hype-text-shadow hype-hover-size"></i>
                    </a>
                    <a href="{{ route('admin.movies.edit', $movie->slug) }}">
                        <i role="button" type="submit"
                            class="fa-solid fa-pen-to-square fs-1 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                    </a>
                    <form id="delete-form" action="{{ route('admin.movies.destroy', $movie->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="element-delete default-button text-active-primary hype-text-shadow fs-1"
                            type="submit" data-element-id="{{ $movie->id }}" data-element-title="{{ $movie->name }}">
                            <i class="fa-solid fa-trash-can "></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if ($movie->reviews)
            @foreach ($movie->reviews as $review)
                <a href="{{ route('admin.reviews.show', $review->id) }}" class="text-decoration-none text-white">
                    <div class="container rounded-2 hype-shadow-white p-5 container-table text-white mb-2">
                        <h4>{{ $review->author }}</h4>
                        <p>{!! $review->content !!}</p>
                        <h6>{!! \App\Functions\Helpers::getStars($review->rating) !!}</h6>
                        <h6>{{ \Carbon\Carbon::parse($review->date)->format('d/m/Y') }}</h6>
                    </div>

                </a>
            @endforeach
        @endif

    </section>
@endsection

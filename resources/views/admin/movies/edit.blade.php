@section('title', 'Edit Movie {{ $movie->title }}')
@extends('layouts.admin')

@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5 container-table">
            <h1 class="text-center hype-text-shadow text-white fw-bolder">Modifica Film: {{ $movie->title }}</h1>

            <form id="comic-form" action="{{ route('admin.movies.update', $movie->slug) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                @method('PUT')
                <div class="mb-3 @error('title') err-animation @enderror">
                    <label for="title" class="form-label text-white">Titolo</label>
                    <input type="text" class="form-control @error('title') is-invalid err-animation @enderror"
                        id="title" name="title" value="{{ old('title', $movie->title) }}" required maxlength="255"
                        minlength="3">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('avarage_rating') err-animation @enderror">
                    <label for="avarage_rating" class="form-label  text-white">Valutazione Utenti</label>
                    <input type="number" class="form-control @error('avarage_rating') is-invalid err-animation @enderror"
                        id="avarage_rating" name="avarage_rating"
                        value="{{ old('avarage_rating', $movie->avarage_rating) }}" required min="0" max="10"
                        step="0.01">
                    @error('avarage_rating')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('theMovieDb_id') err-animation @enderror">
                    <label for="theMovieDb_id" class="form-label  text-white">theMovieDb id</label>
                    <input type="number" class="form-control @error('theMovieDb_id') is-invalid err-animation @enderror"
                        id="theMovieDb_id" name="theMovieDb_id" value="{{ old('theMovieDb_id', $movie->theMovieDb_id) }}">
                    @error('theMovieDb_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('original_language') err-animation @enderror">
                    <label for="original_language" class="form-label text-white">Lingua Originale</label>
                    <input type="text"
                        class="form-control @error('original_language') is-invalid err-animation @enderror"
                        id="original_language" name="original_language"
                        value="{{ old('original_language', $movie->original_language) }}" required maxlength="255"
                        minlength="3">
                    @error('original_language')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('overview') err-animation @enderror">
                    <label for="overview" class="form-label text-white">Trama</label>
                    <textarea class="form-control @error('overview') is-invalid err-animation @enderror" id="overview" name="overview"
                        style="min-height: 300px">{{ old('overview', $movie->overview) }}</textarea>
                    @error('overview')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3 @error('poster_path') err-animation @enderror d-flex gap-5 align-items-center">
                    <div class="w-25">
                        @if ($movie->poster_path && strpos($movie->poster_path, 'http') !== false)
                            <img id="uploadPreview" class="w-100 uploadPreview" width="100"
                                src="{{ $movie->poster_path }}" alt="preview">
                        @elseif ($movie->poster_path)
                            <img id="uploadPreview" class="w-100 uploadPreview" width="100"
                                src="{{ asset('storage/' . $movie->poster_path) }}" alt="preview">
                        @else
                            <img id="uploadPreview" class="w-100 uploadPreview" width="100" src="/images/placeholder.png"
                                alt="preview">
                        @endif
                    </div>
                    <div class="w-75">
                        <label for="image" class="form-label text-white">Immagine Verticale (URL)</label>
                        <input type="file" accept="image/*" class="form-control upload_image" name="poster_path"
                            value="{{ old('poster_path', $movie->poster_path) }}">
                        @error('poster_path')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="mb-3 @error('backdrop_path') err-animation @enderror d-flex gap-5 align-items-center">
                    <div class="w-25">
                        @if ($movie->backdrop_path && strpos($movie->backdrop_path, 'http') !== false)
                            <img id="uploadPreview" class="w-100 uploadPreview" width="100"
                                src="{{ $movie->backdrop_path }}" alt="preview">
                        @elseif ($movie->backdrop_path)
                            <img id="uploadPreview" class="w-100 uploadPreview" width="100"
                                src="{{ asset('storage/' . $movie->backdrop_path) }}" alt="preview">
                        @else
                            <img id="uploadPreview" class="w-100 uploadPreview" width="100" src="/images/placeholder.png"
                                alt="preview">
                        @endif
                    </div>
                    <div class="w-75">
                        <label for="image" class="form-label text-white">Immagine Orizzontale (URL)</label>
                        <input type="file" accept="image/*" class="form-control upload_image" name="backdrop_path"
                            value="{{ old('backdrop_path', $movie->backdrop_path) }}">
                        @error('backdrop_path')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <br>
                <div class="text-center w-50 mx-auto d-flex gap-2">
                    <button type="submit" class="mine-custom-btn mt-3 w-100">Salva</button>
                    <a href="{{ route('admin.movies.index') }}"
                        class="mine-custom-btn min-custom-btn-grey mt-3 w-100">Indietro</a>
                </div>
            </form>
        </div>

    </section>
@endsection

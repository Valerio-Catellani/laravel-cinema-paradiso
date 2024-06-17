@section('title', 'Modifica una Recensione')
@extends('layouts.admin')

@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5 container-table">
            <h1 class="text-center hype-text-shadow text-white fw-bolder">Modifica Recensione - {{ $review->id }}</h1>

            <form id="comic-form" action="{{ route('admin.reviews.update', $review->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                @method('PUT')

                <div class="mb-3 @error('author') err-animation @enderror">
                    <label for="author" class="form-label text-white">Autore</label>
                    <input type="text" class="form-control @error('author') is-invalid err-animation @enderror"
                        id="author" name="author" value="{{ old('author', $review->author) }}" required maxlength="200"
                        minlength="3">
                    @error('author')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="movie_id" class="form-label text-white">Seleziona un Film</label>
                    <select name="movie_id" id="movie_id" class="form-control @error('movie_id') is-invalid @enderror">
                        <option value="">Nessun Film Selezionato</option>
                        @foreach ($movies as $movie)
                            <option value="{{ $movie->id }}"
                                {{ $movie->id == old('movie_id', $review->movie_id) ? 'selected' : '' }}>
                                {{ $movie->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('movie_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('date') err-animation @enderror">
                    <label for="date" class="form-label text-white">Data</label>
                    <input type="date" class="form-control @error('date') is-invalid err-animation @enderror"
                        id="date" name="date" value="{{ old('date', $review->date) }}" required>
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('content') err-animation @enderror">
                    <label for="content" class="form-label text-white">Contenuto Recensione</label>
                    <textarea class="form-control p-2 @error('content') is-invalid err-animation @enderror" id="content" name="content"
                        required style="min-height: 300px">{{ old('content', $review->content) }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('rating') err-animation @enderror">
                    <label for="rating" class="form-label  text-white">Valutazione Finale</label>
                    <input type="number" class="form-control @error('rating') is-invalid err-animation @enderror"
                        id="rating" name="rating" value="{{ old('rating', $review->rating) }}" min="0"
                        max="10" step="0.01">
                    @error('rating')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                <div class="text-center w-50 mx-auto d-flex gap-2">
                    <button type="submit" class="mine-custom-btn mt-3 w-100">Salva</button>
                    <a href="{{ route('admin.reviews.index') }}"
                        class="mine-custom-btn min-custom-btn-grey mt-3 w-100">Indietro</a>
                </div>
            </form>
        </div>

    </section>
@endsection

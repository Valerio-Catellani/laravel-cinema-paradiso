@section('title', 'Crea una Recensione')
@extends('layouts.admin')

@section('content')
    <section class="container py-5">

        <div class="container rounded-2 hype-shadow-white p-5 container-table">
            <h1 class="text-center hype-text-shadow text-white fw-bolder">Aggiungi una Recensione</h1>


            <form id="" action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 @error('author') err-animation @enderror">
                    <label for="author" class="form-label text-white">Autore</label>
                    <input type="text" class="form-control @error('author') is-invalid err-animation @enderror"
                        id="author" name="author" value="{{ old('author') }}" required maxlength="200" minlength="3">
                    @error('author')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="movie_id" class="form-label text-white">Seleziona un Film</label>
                    <select name="movie_id" id="movie_id" class="form-control @error('movie_id') is-invalid @enderror"
                        required>
                        <option value="">Nessun Film Selezionato</option>
                        @foreach ($movies as $movie)
                            <option value="{{ $movie->id }}" {{ $movie->id == old('movie_id') ? 'selected' : '' }}>
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
                        id="date" name="date" value="{{ old('date') }}" required>
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3 @error('content') err-animation @enderror">
                    <label for="content" class="form-label text-white">Contenuto Recensione</label>
                    <textarea class="form-control p-2 @error('content') is-invalid err-animation @enderror" id="content" name="content"
                        style="min-height: 300px">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('rating') err-animation @enderror">
                    <label for="rating" class="form-label  text-white">Valutazione Finale</label>
                    <input type="number" class="form-control @error('rating') is-invalid err-animation @enderror"
                        id="rating" name="rating" value="{{ old('rating') }}" min="0" max="10"
                        step="0.01">
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

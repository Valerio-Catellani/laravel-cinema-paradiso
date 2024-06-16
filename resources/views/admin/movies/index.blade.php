@section('title', 'Film')
@extends('layouts.admin')

@section('content')
    <section class="hype-w-85x100 mx-auto py-5">
        <h1 class="mb-3 hype-text-shadow display-1 fw-bold text-center text-white">Tutti i Film</h1>
        <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.movies.create') }}">Aggiungi un film</a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @include('partials.table-movies', $movies)
        {{ $movies->links('vendor.pagination.bootstrap-5') }}
    </section>
@endsection

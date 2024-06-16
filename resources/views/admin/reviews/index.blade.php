@section('title', 'Recensioni')
@extends('layouts.admin')

@section('content')
    <section class="hype-w-85x100 mx-auto py-5">
        <h1 class="mb-3 hype-text-shadow display-1 fw-bold text-white text-center">Tutte le Recensioni</h1>
        <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.reviews.create') }}">Aggiungi una Recensione</a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <table id="rooms-table"
            class="table custom-table table-hover table-striped shadow mb-5 mt-3 hype-unselectable hype-table-clickable">
            <thead>
                <tr>
                    <th scope="col">#id Recensione</th>
                    <th scope="col">Autore</th>
                    <th scope="col">Film</th>
                    <th scope="col" class="d-none d-xl-table-cell">Creata il</th>
                    <th scope="col" class="d-none d-lg-table-cell">Valutazione</th>
                    <th scope="col" class="text-center">
                        Azioni di Amministrazione</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td><a>{{ $review->id }} </a></td>
                        <td><a>{{ $review->author }}</a></td>
                        <td><a>{{ $review->movie->title }}</a></td>
                        <td class="d-none d-xl-table-cell">
                            <a>{{ \Carbon\Carbon::parse($review->date)->format('d/m/Y') }}</a>
                        </td>
                        <td class="d-none d-lg-table-cell"><a>{{ $review->rating }}</a></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admin.reviews.show', $review->id) }}" class="table-icon m-1">
                                    <div class="icon-container">
                                        <i
                                            class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                    </div>
                                </a>
                                <a href="{{ route('admin.reviews.edit', $review->id) }}" class="table-icon m-1">
                                    <div class="icon-container">
                                        <i
                                            class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                    </div>
                                </a>
                                <form id="delete-form" action="{{ route('admin.reviews.destroy', $review->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="element-delete  default-button text-active-primary hype-text-shadow fs-3 m-1"
                                        type="submit" data-element-id="{{ $review->id }}"
                                        data-element-title="{{ $review->author }}">
                                        <div class="icon-container">
                                            <i class="fa-solid fa-trash-can "></i>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reviews->links('vendor.pagination.bootstrap-5') }}
    </section>
@endsection

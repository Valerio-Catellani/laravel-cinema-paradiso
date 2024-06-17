@section('title', "Review Details: $review->author : $review->date ")
@extends('layouts.admin')

@section('content')
    <section class="container py-5">
        <h2 class="text-center hype-text-shadow text-white fw-bolder mb-2 display-3">Tutte le recensioni
            di: {{ $review->author }}</h2>
        <div class="container rounded-2 hype-shadow-white p-0 container-table mb-5 overflow-hidden">
            <div style="height: 300px" class="overflow-hidden position-relative">
                <img class="img-fluid w-100"
                    src="{{ strpos($review->movie->backdrop_path, 'http') !== false
                        ? $review->movie->backdrop_path
                        : asset('storage/' . $review->movie->backdrop_path) }}"
                    alt="{{ $review->movie->title }}">
                <div class="position-absolute bottom-0 w-100 h-25 background-gradient-from-bottom-black-to-transparent"
                    style=" ">

                </div>
            </div>
            <div class="p-5">
                <h2 class="text-center hype-text-shadow text-white fw-bolder mb-2">
                    {{ \Carbon\Carbon::parse($review->date)->format('d/m/Y') }}
                </h2>
                <h2 class="text-center mb-5 text-white hype-text-shadow">{{ $review->movie->title }}
                </h2>
                <h4 class="text-center hype-text-shadow text-white fw-bolder mb-2">Id Recensione -
                    {{ $review->id }}
                </h4>

                <div class="container">
                    <div class="row mb-4">
                        <div class="col-12 d-flex flex-column text-white">
                            <h4>Recensione</h4>
                            <p>{{ $review->content }}</p>
                            <h4>Valutazione: {!! \App\Functions\Helpers::getStars(floor($review->rating)) !!}</h4>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center gap-5 mt-auto
                my-3">
                        <a href="{{ route('admin.reviews.index') }}">
                            <i role="button" type="submit"
                                class="fa-solid fa-arrow-left fs-1 text-white hype-text-shadow hype-hover-size"></i>
                        </a>
                        <a href="{{ route('admin.reviews.edit', $review->id) }}">
                            <i role="button" type="submit"
                                class="fa-solid fa-pen-to-square fs-1 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                        </a>
                        <form id="delete-form" action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="element-delete default-button text-active-primary hype-text-shadow fs-1"
                                type="submit" data-element-id="{{ $review->id }}"
                                data-element-title="{{ $review->date }}">
                                <i class="fa-solid fa-trash-can "></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <h4 class="hype-text-shadow text-white fw-bolder mb-2">
                @if ($other_reviews->count() == 0)
                    Nessuna altra recensione per: {{ $review->author }}
                @else
                    Altre recensioni di {{ $review->author }}
                @endif
            </h4>
            @foreach ($other_reviews as $o_review)
                <a href="{{ route('admin.reviews.show', $o_review->id) }}" class="text-decoration-none">
                    <div class="container rounded-2 hype-shadow-white p-5 container-table text-white mb-2">
                        <h4>{{ $o_review->movie->title }}</h4>
                        <p>{{ $o_review->content }}</p>
                        <h6>{!! \App\Functions\Helpers::getStars($o_review->rating) !!}</h6>
                        <h6>{{ \Carbon\Carbon::parse($o_review->date)->format('d/m/Y') }}</h6>
                    </div>
                </a>
            @endforeach
            {{ $other_reviews->links('vendor.pagination.bootstrap-5') }}
        </div>
    </section>
@endsection

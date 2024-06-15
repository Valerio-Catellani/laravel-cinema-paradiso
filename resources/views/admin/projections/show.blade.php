@section('title', "Dettagli Proiezione: $projection->id ")
@extends('layouts.admin')

@section('content')
    <section class="container py-5">

        <div class="container rounded-2 hype-shadow-white p-0 mb-5 overflow-hidden"
            style="background: linear-gradient(45deg,{{ $projection->room->hex_color }} 54%, rgba(0, 0, 0, 0.88) 99%)">
            <div style="height: 300px" class="overflow-hidden position-relative">
                <img class="img-fluid w-100" style="transform: translateY(-50%)"
                    src="{{ asset('storage/' . $projection->room->room_image) }}" alt="{{ $projection->room->name }}">
                <div class="position-absolute bottom-0 w-100 h-25 background-gradient-from-bottom-black-to-transparent"
                    style=" ">
                </div>
            </div>
            <h1 class="text-center hype-text-shadow text-white fw-bolder my-2">Proieizione con id: {{ $projection->id }}
            </h1>
            <h4 class="text-center text-white mb-5">Proiezione del {{ $projection->date }}, Facscia Oraria
                {{ $projection->slot->name }}
            </h4>
            <div class="container">
                <div class="row mb-4 justify-content-center p-2">
                    <div class="col-5 rounded-5 overflow-hidden p-0 shadow">
                        <img class="img-fluid w-100 h-100"
                            src="{{ strpos($projection->movie->backdrop_path, 'http') !== false
                                ? $projection->movie->backdrop_path
                                : asset('storage/' . $projection->movie->backdrop_path) }}"
                            alt="{{ $projection->movie->title }}">
                    </div>
                    <div class="col-6 d-flex flex-column text-white">
                        <h3>Data:</h3>
                        <h4>{{ $projection->date }}</h4>
                        <h3 class="mt-3">Fascia Oraria:</h3>
                        <h4><a class="text-decoration-none text-white hype-hover-bg-light py-2 rounded-2"
                                href="{{ route('admin.slots.show', $projection->slot->slug) }}">{{ $projection->slot->name }}:
                                {{ $projection->slot->start_time }} -
                                {{ $projection->slot->end_time }}</a></h4>
                        <h3 class="mt-3">Sala Prenotata:</h3>
                        <h4><a class="text-decoration-none text-white hype-hover-bg-light py-2 rounded-2"
                                href="{{ route('admin.rooms.show', $projection->room->slug) }}">{{ $projection->room->name }}
                                ({{ $projection->room->alias }})</a></h4>
                        <h3 class="mt-3">Film Programmato:</h3>
                        <h4><a class="text-decoration-none text-white hype-hover-bg-light py-2 rounded-2"
                                href="{{ route('admin.movies.show', $projection->movie->slug) }}">{{ $projection->movie->title }}</a>
                        </h4>

                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-5 mt-auto mb-3">
                    <a href="{{ route('admin.projections.index') }}">
                        <i role="button" type="submit"
                            class="fa-solid fa-arrow-left fs-1 text-white hype-text-shadow hype-hover-size"></i>
                    </a>
                    <a href="{{ route('admin.projections.edit', $projection->id) }}">
                        <i role="button" type="submit"
                            class="fa-solid fa-pen-to-square fs-1 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                    </a>
                    <form id="delete-form" action="{{ route('admin.projections.destroy', $projection->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="element-delete default-button text-active-primary hype-text-shadow fs-1"
                            type="submit" data-element-id="{{ $projection->id }}"
                            data-element-title="{{ '' }}">
                            <i class="fa-solid fa-trash-can "></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- 
        @if ($movie->reviews)
            @foreach ($movie->reviews as $review)
                <div class="container rounded-2 hype-shadow-white p-5 background-gradient-color-black text-white mb-2">
                    <h4>{{ $review->author }}</h4>
                    <p>{{ $review->content }}</p>
                    <h6>{!! \App\Functions\Helpers::getStars($review->rating) !!}</h6>
                    <h6>{{ $review->date }}</h6>
                </div>
            @endforeach
        @endif --}}

    </section>
@endsection

@section('title', 'Room Details')
@extends('layouts.admin')



@section('content')
    <section class="container py-5">

        <div class="container rounded-2 hype-shadow-white p-0 overflow-hidden"
            style="background: linear-gradient(45deg,{{ $room->hex_color }} 54%, rgba(0, 0, 0, 0.88) 99%)">
            <div style="height: 300px" class="overflow-hidden position-relative">
                <img class="img-fluid w-100" style="transform: translateY(-50%)"
                    src="{{ asset('storage/' . $room->room_image) }}" alt="{{ $room->name }}">
                <div class="position-absolute bottom-0 w-100 h-25 background-gradient-from-bottom-black-to-transparent"
                    style=" ">
                </div>
            </div>
            <h1 class="text-center hype-text-shadow text-white fw-bolder my-3">Dettagli Stanza: {{ $room->name }}</h1>
            <div class="container">
                <div class="row gap-3 p-3">
                    <div class="col-5 p-0 hype-shadow-white">
                        <img class="img-fluid w-100 h-100" src="{{ asset('storage/' . $room->room_image) }}"
                            alt="{{ $room->name }}">
                    </div>
                    <div class="col-6 d-flex flex-column text-white">
                        <h3>Nome</h3>
                        <h5 class="mb-4">{{ $room->name }}</h5>
                        <h3>Alias</h3>
                        <h5 class="mb-4">{{ $room->alias }}</h5>
                        <h3>Posti a sedere massimi</h3>
                        <h5 class="mb-4">{{ $room->seats }}</h5>
                        <h3>Prezzo Biglietto Base</h3>
                        <h5 class="mb-4">{{ $room->base_price }} €</h5>
                        <h3>Tecnologia Isense</h3>
                        <h5 class="mb-4">
                            {{ $room->isense ? 'Sì' : 'No' }}
                        </h5>
                        <div class="d-flex justify-content-center align-items-center gap-5 mt-auto">
                            <a href="{{ route('admin.rooms.index') }}">
                                <i role="button" type="submit"
                                    class="fa-solid fa-arrow-left fs-1 text-white hype-text-shadow hype-hover-size"></i>
                            </a>
                            <a href="{{ route('admin.rooms.edit', $room->slug) }}">
                                <i role="button" type="submit"
                                    class="fa-solid fa-pen-to-square fs-1 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </a>
                            <form id="delete-form" action="{{ route('admin.rooms.destroy', $room->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="element-delete default-button text-active-primary hype-text-shadow fs-1"
                                    type="submit" data-element-id="{{ $room->id }}"
                                    data-element-title="{{ $room->name }}">
                                    <i class="fa-solid fa-trash-can "></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($groupedProjections as $day => $projections)
            <div id="{{ $day }}" class="date-section my-5">
                <h2 class="pt-5">Tutte le proiezioni per il giorno: {{ \Carbon\Carbon::parse($day)->format('d/m/Y') }}
                </h2>
                @foreach ($projections as $projection)
                    @include('partials.table-restricted-projection', $projections)
                @endforeach
                @if ($projections->count() < $slots->count())
                    <form method="get" action="{{ route('admin.projections.create') }}">
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="date" value="{{ $day }}">
                        <button type="submit" class="mine-custom-btn mb-3">Aggiungi una Proiezione per il giorno:
                            {{ \Carbon\Carbon::parse($day)->format('d/m/Y') }}</button>
                    </form>
                @endif
            </div>
        @endforeach

        {{-- @foreach ($projections as $projection)
            @include('partials.table-slot-room-projection-movie', ['projection' => $projection])
        @endforeach --}}

    </section>
@endsection

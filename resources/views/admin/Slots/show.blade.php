@section('title', 'Fascia Oraria ')
@extends('layouts.admin')

@php
    $formatted_date = \Carbon\Carbon::parse($date)->format('d/m/Y');
@endphp

@section('content')
    <section class="container py-5">
        <h2 class="text-center hype-text-shadow text-white fw-bolder mb-5 display-3">Dettaglio Fascia Oraria</h2>
        <div class="container rounded-2 hype-shadow-white p-0 container-table mb-5 overflow-hidden">
            <div class="p-5">
                <h2 class="text hype-text-shadow text-white fw-bolder mb-2 fs-1 text-center display-1">{{ $slot->name }}
                </h2>
                <div class=" d-flex text-white mx-auto justify-content-between my-5">
                    <div>
                        <h3 class="text-center hype-text-shadow">Orario di Inizio</h3>
                        <h2 class="text-center special-font-1 display-5 hype-text-shadow">{{ $slot->start_time }}
                        </h2>
                    </div>
                    <div>
                        <h3 class="text-center hype-text-shadow">Orario di Fine</h3>
                        <h2 class="text-center special-font-1  display-5 hype-text-shadow">{{ $slot->end_time }}
                        </h2>
                    </div>


                </div>

                <div class="container">
                    <div class="d-flex justify-content-center align-items-center gap-5 mt-auto
                my-3">
                        <a href="{{ route('admin.slots.index') }}">
                            <i role="button" type="submit"
                                class="fa-solid fa-arrow-left fs-1 text-white hype-text-shadow hype-hover-size"></i>
                        </a>
                        <a href="{{ route('admin.slots.edit', $slot->slug) }}">
                            <i role="button" type="submit"
                                class="fa-solid fa-pen-to-square fs-1 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                        </a>
                        <form id="delete-form" action="{{ route('admin.slots.destroy', $slot->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="element-delete default-button text-active-primary hype-text-shadow fs-1"
                                type="submit" data-element-id="{{ $slot->id }}"
                                data-element-title="{{ $slot->name }}">
                                <i class="fa-solid fa-trash-can "></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <h3 id="info-date" class="hype-text-shadow text-white fw-bolder mb-2">
            Tutte le proiezioni prenotate per la fascia oraria di: {{ $slot->name }}
            {{ $date ? " alla data di: $formatted_date" : 'Per tutte le date' }}
        </h3>

        <form action="{{ route('admin.slots.show', $slot->slug) }}" method="GET" id="search-form-date-slot">
            <div class="mb-5 text-center d-flex flex-column">
                <label for="select-date">Seleziona una data</label>
                <input class="input-select-date px-3 py-2 rounded-4 shadow fs-4 hype-unselectable align-self-center"
                    type="date" id="select-date" name="date" min="{{ $AllProjections->min('date') }}"
                    max="{{ $AllProjections->max('date') }}" value="{{ $date ? $date : '' }}">
            </div>
        </form>

        <div>
            @foreach ($projections->sortBy('date') as $projection)
                <div class="projection-container my-1" data-element-date="{{ $projection->date }}">
                    @include('partials.table-slot-room-projection-movie', ['projection' => $projection])
                </div>
            @endforeach
            {{ $projections->links('vendor.pagination.bootstrap-5') }}
            @if ($date && $projections->count() < $rooms->count())
                <form method="get" action="{{ route('admin.projections.create') }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="slot_id" value="{{ $slot->id }}">
                    <button type="submit" class="mine-custom-btn mb-3">Aggiungi una Proiezione per il giorno:
                        {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</button>
                </form>
            @endif
        </div>


    </section>
@endsection

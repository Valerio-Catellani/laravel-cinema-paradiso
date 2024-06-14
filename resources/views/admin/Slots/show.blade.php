@section('title', 'Fascia Oraria ')
@extends('layouts.admin')

@section('content')
    <section class="container py-5">
        <h2 class="text-center hype-text-shadow text-white fw-bolder mb-5 display-3">Dettaglio Fascia Oraria</h2>
        <div class="container rounded-2 hype-shadow-white p-0 background-gradient-color-black mb-5 overflow-hidden">
            <div class="p-5">
                <h2 class="text hype-text-shadow text-white fw-bolder mb-2 fs-1 text-center">{{ $slot->name }}
                </h2>
                <div class=" d-flex text-white mx-auto justify-content-between my-5">
                    <div>
                        <h3 class="text-center">Orario di Inizio</h3>
                        <h2 class="text-center special-font-1 display-5">{{ $slot->start_time }}
                        </h2>
                    </div>
                    <div>
                        <h3 class="text-center">Orario di Fine</h3>
                        <h2 class="text-center special-font-1  display-5">{{ $slot->end_time }}
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
        {{-- <div>

            <select name="" id="select-date">
                <option value="all">Seleziona una data</option>
                @foreach ($projections as $projection)
                    <option value="{{ $projection->date }}">
                        {{ $projection->date }}
                    </option>
                @endforeach
            </select> --}}
        <h3 id="info-date" class="hype-text-shadow text-white fw-bolder mb-2">
            Tutte le proiezioni prenotate
        </h3>

        <div class="mb-3">
            <input type="date" id="select-date" name="date" min="{{ $projections->min('date') }}"
                max="{{ $projections->max('date') }}">
        </div>

        @foreach ($projections as $projection)
            <div class="projection-container my-1" data-element-date="{{ $projection->date }}">
                @include('partials.table-slot-room-projection-movie', ['projection' => $projection])
            </div>
        @endforeach
        </div>
    </section>
@endsection

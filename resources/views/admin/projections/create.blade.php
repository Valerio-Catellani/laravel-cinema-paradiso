@section('title', 'Aggiungi Proiezione')
@extends('layouts.admin')

@section('content')
    <section class="container py-5">
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="container rounded-2 hype-shadow-white p-5 container-table">
            <h1 class="text-center hype-text-shadow text-white fw-bolder">Aggiungi Proiezione</h1>

            <form id="projections-form-create" action="{{ route('admin.projections.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="mb-3 @error('date') err-animation @enderror">
                    <label for="date" class="form-label text-white">Data Proiezione</label>
                    <input type="date" class="form-control @error('date') is-invalid err-animation @enderror"
                        id="date" name="date" data-day-of-today="{{ $date }}"
                        value="{{ old('date', $date) }}" required>
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div id="sub-controll">
                    <div class="mb-3">
                        <label for="movie_id" class="form-label text-white">Seleziona un Film</label>
                        <select name="movie_id" id="movie_id" class="form-control @error('movie_id') is-invalid @enderror">
                            <option id="main-movie-info" value="">Seleziona un Film</option>
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

                    <div class="mb-3">
                        <label for="room_id" class="form-label text-white">Seleziona una Stanza</label>
                        <select name="room_id" id="room_id" class="form-control @error('room_id') is-invalid @enderror">
                            <option id="main-room-info" value="">Seleziona Una Stanza</option>
                            @foreach ($rooms as $room)
                                <option class="option-room" id="room-{{ $room->id }}" value="{{ $room->id }}"
                                    {{ $room->id == old('room_id') || $room->id == $room_from_show ? 'selected' : '' }}>
                                    {{ $room->name }} - {{ $room->alias }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="slot_id" class="form-label text-white">Seleziona una Fascia Oraria</label>
                        <select name="slot_id" id="slot_id" class="form-control @error('slot_id') is-invalid @enderror">
                            <option id="main-slot-info" value="" default>Seleziona una Fascia Oraria</option>
                            @foreach ($slots as $slot)
                                <option class="option-slot" id="slot-{{ $slot->id }}" value="{{ $slot->id }}"
                                    {{ $slot->id == old('slot_id') || $slot->id == $slot_from_show ? 'selected' : '' }}>
                                    {{ $slot->name }} : {{ $slot->start_time }} - {{ $slot->end_time }}
                                </option>
                            @endforeach
                        </select>
                        @error('slot_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div id='sub-message' class="d-none bg-danger-subtle p-3 rounded-2">Nessuna Proiezione Disponibile per
                    questa data</div>



                <br>
                <div class="text-center w-25 mx-auto d-flex gap-2">
                    <button type="submit" class="mine-custom-btn mt-3 w-100">Salva</button>
                    <a href="{{ route('admin.projections.index') }}"
                        class="mine-custom-btn min-custom-btn-grey mt-3 w-100">Indietro</a>
                </div>
            </form>
        </div>

    </section>
@endsection

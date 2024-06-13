@section('title', 'Aggiungi Proiezione')
@extends('layouts.admin')

@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5 background-gradient-color-black">
            <h1 class="text-center hype-text-shadow text-white fw-bolder">Aggiungi Proiezione</h1>

            <form id="projections-form" action="{{ route('admin.projections.store') }}" method="POST" novalidate
                enctype="multipart/form-data">
                @csrf

                <div class="mb-3 @error('date') err-animation @enderror">
                    <label for="date" class="form-label text-white">Data Proiezione</label>
                    <input type="date" class="form-control @error('date') is-invalid err-animation @enderror"
                        id="date" name="date" value="{{ old('date') }}" required>
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="movie_id" class="form-label text-white">Seleziona un Film</label>
                    <select name="movie_id" id="movie_id" class="form-control @error('movie_id') is-invalid @enderror"
                        disabled>
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

                <div class="mb-3">
                    <label for="room_id" class="form-label text-white">Seleziona una Stanza</label>
                    <select name="room_id" id="room_id" class="form-control @error('room_id') is-invalid @enderror">
                        <option value="">Nessuna Stanza Selezionata</option>
                        @foreach ($rooms as $room)
                            <option id="room-{{ $room->id }}" value="{{ $room->id }}"
                                {{ $room->id == old('room_id') ? 'selected' : '' }}
                                style="background-color: {{ $room->hex_color }}">
                                {{ $room->name }} - {{ $room->alias }}
                            </option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="slot_id" class="form-label text-white">Seleziona una Facia Oraria</label>
                    <select name="slot_id" id="slot_id" class="form-control @error('slot_id') is-invalid @enderror">
                        <option value="">Nessuna Facia Oraria Selezionata</option>
                        @foreach ($slots as $slot)
                            <option id="slot-{{ $slot->id }}" value="{{ $slot->id }}"
                                {{ $slot->id == old('slot_id') ? 'selected' : '' }}>
                                {{ $slot->name }} : {{ $slot->start_time }} - {{ $slot->end_time }}
                            </option>
                        @endforeach
                    </select>
                    @error('slot_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


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
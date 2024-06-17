@section('title', 'Modifica la Sala ' . $room->id)
@extends('layouts.admin')

@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5"
            style="background: linear-gradient(45deg,{{ $room->hex_color }} 54%, rgba(0, 0, 0, 0.88) 99%)">
            <h1 class="text-center hype-text-shadow text-white fw-bolder">Modifica dettagli {{ $room->name }}: con id
                ({{ $room->id }})</h1>

            <form id="room-form" action="{{ route('admin.rooms.update', $room->slug) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 @error('name') err-animation @enderror">
                    <label for="name" class="form-label text-white">Nome</label>
                    <input type="text" class="form-control @error('name') is-invalid err-animation @enderror"
                        id="name" name="name" value="{{ old('name', $room->name) }}" required maxlength="255"
                        minlength="3">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('alias') err-animation @enderror">
                    <label for="alias" class="form-label text-white">Alias</label>
                    <input type="text" class="form-control @error('alias') is-invalid err-animation @enderror"
                        id="alias" name="alias" value="{{ old('alias', $room->alias) }}" required maxlength="255"
                        minlength="3">
                    @error('alias')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('hex_color') err-animation @enderror">
                    <label for="hex_color" class="form-label text-white">Colore Esadecimale</label>
                    <input type="text" class="form-control @error('hex_color') is-invalid err-animation @enderror"
                        id="hex_color" name="hex_color" value="{{ old('hex_color', $room->hex_color) }}" required
                        maxlength="255" minlength="3">
                    @error('hex_color')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('seats') err-animation @enderror">
                    <label for="seats" class="form-label  text-white">Posti a sedere</label>
                    <input type="number" class="form-control @error('seats') is-invalid err-animation @enderror"
                        id="seats" name="seats" value="{{ old('seats', $room->seats) }}" required min="0">
                    @error('seats')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('base_price') err-animation @enderror">
                    <label for="base_price" class="form-label  text-white">Prezzo biglietto base (€)</label>
                    <input type="number" class="form-control @error('base_price') is-invalid err-animation @enderror"
                        id="base_price" name="base_price" value="{{ old('base_price', $room->base_price) }}" min="0"
                        step="0.01">
                    @error('base_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <h6 class="text-white">Isense:</h6>
                <div class="mb-3 d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input @error('isense') is-invalid err-animation @enderror" type="radio"
                            name="isense" id="isense-true" value="true"
                            {{ old('isense', $room->isense) == 1 ? 'checked' : '' }} required>
                        <label class="form-check-label text-white" for="isense-true">
                            Si
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('isense') is-invalid err-animation @enderror" type="radio"
                            name="isense" id="isense-false" value="false"
                            {{ old('isense', $room->isense) === 0 || old('isense', $room->isense) === null ? 'checked' : '' }}
                            required>
                        <label class="form-check-label text-white" for="isense-false">
                            No
                        </label>
                    </div>
                </div>
                @error('isense')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3 @error('room_image') err-animation @enderror d-flex gap-5 align-items-center">
                    <div class="w-25 text-center">
                        @if ($room->room_image)
                            <img id="uploadPreview" class="w-100" width="100"
                                src="{{ asset('storage/' . $room->room_image) }}" alt="preview">
                        @else
                            <img id="uploadPreview" class="w-100" width="100" src="/images/placeholder.png"
                                alt="preview">
                        @endif
                    </div>
                    <div class="w-75">
                        <label for="image" class="form-label text-white">Image (URL)</label>
                        <input type="file" accept="image/*" class="form-control upload_image" id="upload_image"
                            name="room_image" value="{{ old('room_image', $room->room_image) }}">
                        @error('room_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <br>
                <div class="text-center w-50 mx-auto d-flex gap-2">
                    <button type="submit" class="mine-custom-btn mt-3 w-100">Salva</button>
                    <a href="{{ route('admin.rooms.index') }}"
                        class="mine-custom-btn min-custom-btn-grey mt-3 w-100">Indietro</a>
                </div>
            </form>
        </div>

    </section>
@endsection

@section('title', 'Modifica una Fascia Oraria')
@extends('layouts.admin')

@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5 container-table">
            <h1 class="text-center hype-text-shadow text-white fw-bolder">Modifica Fascia Oraria - {{ $slot->id }}</h1>

            <form id="comic-form" action="{{ route('admin.slots.update', $slot->slug) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                @method('PUT')

                <div class="mb-3 @error('name') err-animation @enderror">
                    <label for="name" class="form-label text-white">Nome</label>
                    <input type="text" class="form-control @error('name') is-invalid err-animation @enderror"
                        id="name" name="name" value="{{ old('name', $slot->name) }}" required maxlength="200"
                        minlength="3">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3 @error('start_time') err-animation @enderror">
                    <label for="start_time" class="form-label text-white">Orario Inizio</label>
                    <input type="time" class="form-control @error('start_time') is-invalid err-animation @enderror"
                        id="start_time" name="start_time" value="{{ old('start_time', $slot->start_time) }}" required>
                    @error('start_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('end_time') err-animation @enderror">
                    <label for="end_time" class="form-label text-white">Orario Fine</label>
                    <input type="time" class="form-control @error('end_time') is-invalid err-animation @enderror"
                        id="end_time" name="end_time" value="{{ old('end_time', $slot->end_time) }}" required>
                    @error('end_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <br>
                <div class="text-center w-25 mx-auto d-flex gap-2">
                    <button type="submit" class="mine-custom-btn mt-3 w-100">Salva</button>
                    <a href="{{ route('admin.slots.index') }}"
                        class="mine-custom-btn min-custom-btn-grey mt-3 w-100">Indietro</a>
                </div>
            </form>
        </div>

    </section>
@endsection

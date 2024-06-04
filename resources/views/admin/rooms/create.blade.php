@section('title', 'Admin Dashboard / Rooms')
@extends('layouts.admin')

@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5 background-gradient-color">
            <h1 class="text-center hype-text-shadow text-white fw-bolder">Add a Room</h1>

            <form id="comic-form" action="{{ route('admin.rooms.store') }}" method="POST" novalidate
                enctype="multipart/form-data">
                @csrf

                <div class="mb-3 @error('name') err-animation @enderror">
                    <label for="name" class="form-label text-white">Room Name</label>
                    <input type="text" class="form-control @error('name') is-invalid err-animation @enderror"
                        id="name" name="name" value="{{ old('name') }}" required maxlength="255" minlength="3">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('alias') err-animation @enderror">
                    <label for="alias" class="form-label text-white">Room Alias</label>
                    <input type="text" class="form-control @error('alias') is-invalid err-animation @enderror"
                        id="alias" name="alias" value="{{ old('alias') }}" required maxlength="255" minlength="3">
                    @error('alias')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('hex_color') err-animation @enderror">
                    <label for="hex_color" class="form-label text-white">Room Hex Color</label>
                    <input type="text" class="form-control @error('hex_color') is-invalid err-animation @enderror"
                        id="hex_color" name="hex_color" value="{{ old('hex_color') }}" required maxlength="255"
                        minlength="3">
                    @error('hex_color')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('seats') err-animation @enderror">
                    <label for="seats" class="form-label  text-white">Seats</label>
                    <input type="number" class="form-control @error('seats') is-invalid err-animation @enderror"
                        id="seats" name="seats" value="{{ old('seats') }}" required min="0">
                    @error('seats')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('base_price') err-animation @enderror">
                    <label for="base_price" class="form-label  text-white">Base Ticket Price</label>
                    <input type="number" class="form-control @error('base_price') is-invalid err-animation @enderror"
                        id="base_price" name="base_price" value="{{ old('base_price') }}" min="0" max="5"
                        step="0.01">
                    @error('base_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('room_image') err-animation @enderror">
                    <img id="uploadPreview" width="100" src="https://picsum.photos/400/200">
                    <label for="image" class="form-label text-white">Image (URL)</label>
                    <input type="file" accept="image/*"
                        class="form-control @error('room_image') is-invalid err-animation @enderror" id="upload_image"
                        name="room_image" value="{{ old('room_image') }}" required maxlength="255">
                    @error('room_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 @error('isense') err-animation @enderror">
                    <label for="image" class="form-label text-white">Isense</label>
                    <input type="text" class="form-control @error('isense') is-invalid err-animation @enderror"
                        id="image" name="isense" value="{{ old('isense') }}" required maxlength="255">
                    @error('isense')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="text-center w-25 mx-auto d-flex gap-2">
                    <button type="submit" class="mine-custom-btn mt-3 w-100">Add a Room</button>
                    <a href="{{ route('admin.rooms.index') }}"
                        class="mine-custom-btn min-custom-btn-grey mt-3 w-100">Back</a>
                </div>
            </form>
        </div>

    </section>
@endsection

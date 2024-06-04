@section('title', 'Add a room')
@extends('layouts.admin')



@section('content')
    <section class="container py-5">


        <div class="container rounded-2 hype-shadow-white p-5"
            style="background: linear-gradient(45deg,{{ $room->hex_color }} 54%, rgba(0, 0, 0, 0.88) 99%)">
            <h1 class="text-center hype-text-shadow text-white fw-bolder mb-5">Room: {{ $room->name }} Details</h1>
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <img class="img-fluid w-100" src="{{ asset('storage/' . $room->room_image) }}"
                            alt="{{ $room->name }}">
                    </div>
                    <div class="col-8 d-flex flex-column text-white">
                        <h4 class="mb-1">Name</h4>
                        <h6>{{ $room->name }}</h6>
                        <h4 class="mb-1">Alias</h4>
                        <p>{{ $room->alias }}</p>
                        <h4 class="mb-1">Seats</h4>
                        <h6>{{ $room->seats }}</h6>
                        <h4 class="mb-1">Ticket Price</h4>
                        <h6>{{ $room->isense }}</h6>
                        <h4 class="mb-1">Isense</h4>
                        <h6>
                            {{ $room->isense }}
                        </h6>
                        <div class="d-flex justify-content-center align-items-center gap-5 mt-auto">
                            <a href="{{ route('admin.rooms.index') }}">
                                <i role="button" type="submit"
                                    class="fa-solid fa-arrow-left fs-1 text-white hype-text-shadow hype-hover-size"></i>
                            </a>
                            <a href="{{ route('admin.rooms.edit', $room->id) }}">
                                <i role="button" type="submit"
                                    class="fa-solid fa-pen-to-square fs-1 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </a>
                            <form id="delete-form" action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST">
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

    </section>
@endsection

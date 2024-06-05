@section('title', 'Rooms')
@extends('layouts.admin')

@section('content')
    <section class="hype-w-85x100 mx-auto py-5">
        <h1 class="mb-3 hype-text-shadow display-1 fw-bold text-white text-center">Tutte le sale</h1>
        <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.rooms.create') }}">Aggiungi una Sala</a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @foreach ($rooms as $room)
            @include('partials.table-rooms', $room)
        @endforeach
        {{-- {{ $projects->links('vendor.pagination.bootstrap-5') }} --}}
    </section>
@endsection

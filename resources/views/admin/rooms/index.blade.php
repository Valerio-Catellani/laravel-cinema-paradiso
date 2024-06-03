@section('title', 'Add a room')
@extends('layouts.admin')

@section('content')
    <div class="container">
        <section class="hype-w-85x100 mx-auto py-5">
            <h1 class="mb-3">Tutte le sale</h1>
            <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.rooms.create') }}">Add a Room</a>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @include('partials.table', ['elements' => $rooms])
            {{-- {{ $projects->links('vendor.pagination.bootstrap-5') }} --}}
        </section>
    </div>
@endsection

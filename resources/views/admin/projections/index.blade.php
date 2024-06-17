@section('title', 'Tutte le Proiezioni')
@extends('layouts.admin')

@section('content')
    <section class="hype-w-85x100 mx-auto py-5">
        <h1 class="mb-3 hype-text-shadow display-1 fw-bold text-white text-center">Tutte le Proiezioni</h1>
        <div class="d-flex justify-content-between align-items-center">
            <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.projections.create') }}">Aggiungi una
                Proiezione</a>
            <select id="projection-select-date" class="form-select w-auto position-sticky" aria-label="Seleziona Una data"
                onchange="window.location.href= `#${event.target.value}` ">
                <option selected>Seleziona Una data</option>
                @foreach ($groupedProjections as $day => $projections)
                    <option value="{{ $day }}">
                        {{ \Carbon\Carbon::parse($day)->format('d/m/Y') }}
                    </option>
                @endforeach
            </select>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @foreach ($groupedProjections as $day => $projections)
            <div id="{{ $day }}" class="date-section my-5">
                <h2 class="pt-5">Tutte le proiezioni per il giorno: {{ \Carbon\Carbon::parse($day)->format('d/m/Y') }}
                </h2>
                @include('partials.table-projections', $projections->sortBy('slot_id'))
            </div>
            @if ($projections->count() < $slots->count() * $rooms->count())
                <a role="button" class="mine-custom-btn mb-3"
                    href="{{ route('admin.projections.create', ['date' => $day]) }}">Aggiungi una
                    Proiezione per il giorno: {{ \Carbon\Carbon::parse($day)->format('d/m/Y') }}</a>
            @endif
        @endforeach



        @if ($projections->count() < $slots->count())
            <form method="get" action="{{ route('admin.projections.create') }}">
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="date" value="{{ $day }}">
                <button type="submit" class="mine-custom-btn mb-3">Aggiungi una Proiezione per il giorno:
                    {{ \Carbon\Carbon::parse($day)->format('d/m/Y') }}</button>
            </form>
        @endif

        {{-- Pagination Links --}}
        {{-- {{ $projections->links('vendor.pagination.bootstrap-5') }} --}}
    </section>
@endsection

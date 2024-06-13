@section('title', 'Slots')
@extends('layouts.admin')

@section('content')
    <section class="hype-w-85x100 mx-auto py-5">
        <h1 class="mb-3 hype-text-shadow display-1 fw-bold text-white text-center">Fasce Orarie</h1>
        <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.slots.create') }}">Aggiungi una Fascia Oraria</a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif




        <table id="rooms-table"
            class="table table-dark table-hover table-striped shadow mb-5 mt-3 hype-unselectable hype-table-clickable">
            <thead>
                <tr>
                    <th scope="col">#id fascia oraria</th>
                    <th scope="col">name</th>
                    <th scope="col">ora inizio</th>
                    <th scope="col">ora fine</th>
                    <th scope="col" class="text-center">
                        Azioni di Amministrazione</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slots as $slot)
                    <tr>
                        <form action="{{ route('admin.slots.update', $slot->id) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')
                            <!-- assegno ai p e agli input di ogni riga una classe 'slot->id' -->
                            <td>{{ $slot->id }}</td>
                            <td>
                                <p class="paragraph ">{{ $slot->name }} </p>
                                <input type="text" name="name" class="d-none edit-input  "
                                    value="{{ old('name', $slot->name) }}" required maxlength="255">
                            </td>
                            <td>
                                <p class="td paragraph ">
                                    {{ $slot->start_time }} </p>
                                <input type="time" name="start_time" class="d-none edit-input"
                                    value="{{ old('start_time', $slot->start_time) }}" required maxlength="255">
                            </td>
                            <td>
                                <p class="td paragraph">{{ $slot->end_time }} </p>
                                <input type="time" name="end_time" class="d-none edit-input"
                                    value="{{ old('end_time', $slot->end_time) }}" required maxlength="255">
                            </td>
                        </form>

                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admin.slots.show', $slot->slug) }}" class="table-icon m-1">
                                    <div class="icon-container">
                                        <i
                                            class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                    </div>
                                </a>
                                <a href="{{ route('admin.slots.edit', $slot->slug) }}" class="edit-button table-icon m-1 ">
                                    <div class="icon-container">
                                        <i
                                            class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                    </div>
                                </a>
                                <form id="delete-form" action="{{ route('admin.slots.destroy', $slot->slug) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="element-delete  default-button text-active-primary hype-text-shadow fs-3 m-1"
                                        type="submit" data-element-id="{{ $slot->id }}"
                                        data-element-title="{{ $slot->name }}">
                                        <div class="icon-container">
                                            <i class="fa-solid fa-trash-can "></i>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection

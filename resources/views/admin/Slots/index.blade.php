@section('title', 'Slots')
@extends('layouts.admin')

@section('content')
    <section class="hype-w-90x100 mx-auto py-5">
        <h1 class="mb-3 hype-text-shadow display-1 fw-bold text-white text-center">Fasce Orarie</h1>
        <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.slots.create') }}">Aggiungi una Fascia Oraria</a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <table id="rooms-table"
            class="table custom-table table-hover table-striped shadow mb-5 mt-3 hype-unselectable hype-table-clickable">
            <thead>
                <tr>
                    <th scope="col" class="d-none d-lg-table-cell">#id fascia oraria</th>
                    <th scope="col">Nome Fascia Oraria</th>
                    <th scope="col">Ora di Inizio</th>
                    <th scope="col">Ora di Fine</th>
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
                            <td class="d-none d-lg-table-cell">{{ $slot->id }}</td>
                            <td>
                                {{ $slot->name }}
                            </td>
                            <td>
                                {{ $slot->start_time }}
                            </td>
                            <td>
                                {{ $slot->end_time }}
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

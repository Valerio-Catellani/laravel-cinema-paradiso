@section('title', 'Slots')
@extends('layouts.admin')

@section('content')
    <section class="hype-w-85x100 mx-auto py-5">
        <h1 class="mb-3 hype-text-shadow display-1 fw-bold text-white text-center">Slots orari</h1>
        <a role="button" class="mine-custom-btn mb-3" href="{{ route('admin.slots.create') }}">Aggiungi uno slot</a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        {{-- @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
 @dd(request()->all())


        @endif --}}


        <table id="rooms-table"
            class="table table-dark table-hover table-striped shadow mb-5 mt-3 hype-unselectable hype-table-clickable">
            <thead>
                @dd(request()->all())
                <tr>
                    <th scope="col">#id slot</th>
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
                            <td class="hype-w-10x100">{{ $slot->id }}</td>
                            <td class="hype-w-20x100">
                                <p class="paragraph {{ $slot->id }} ">{{ $slot->name }} </p>
                                <input type="text" name="name" class="d-none edit-input {{ $slot->id }} "
                                    value="{{ old('name', $slot->name) }}" required maxlength="255">
                            </td>
                            <td class="hype-w-15x100">
                                <p class="td paragraph  {{ $slot->id }}">
                                    {{ $slot->start_time }} </p>
                                <input type="time" name="start_time" class="d-none edit-input {{ $slot->id }}"
                                    value="{{ old('start_time', $slot->start_time) }}" required maxlength="255">
                            </td>
                            <td class="hype-w-15x100">
                                <p class="td paragraph {{ $slot->id }}">{{ $slot->end_time }} </p>
                                <input type="time" name="end_time" class="d-none edit-input {{ $slot->id }}"
                                    value="{{ old('end_time', $slot->end_time) }}" required maxlength="255">
                            </td>
                            {{-- <td><button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button> --}}
                            {{-- </form> --}}
                            <td class="hype-w-40x100">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.slots.show', $slot->id) }}" class="table-icon m-1">
                                        <div class="icon-container">
                                            <i
                                                class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.slots.edit', $slot->id) }}"
                                        class="edit-button table-icon m-1 icon-{{ $slot->id }}"
                                        id="{{ $slot->id }}">
                                        <div class="icon-container">
                                            <i
                                                class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                        </div>
                                    </a>
                                    <button class="mine-custom-btn edit-a table-icon m-1 icon-{{ $slot->id }} d-none"
                                        type="submit" id="{{ $slot->id }}">
                                        <div class="icon-container">
                                            <i
                                                class=" fa-solid fa-floppy-disk fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                                        </div>
                                    </button>
                        </form>

                        <form id="delete-form" action="{{ route('admin.slots.destroy', $slot->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="element-delete  default-button text-active-primary hype-text-shadow fs-3 m-1"
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

@section('title', 'Admin Dashboard')
@extends('layouts.admin')


@section('content')
    <div class="container">
        <h2 class="mt-4 ms-3">Bentornato {{ Auth::user()->name }}!</h2>
        <div id="card-container" class="p-3 h-100  container-fluid ">
            <div class="row">
                <div id="todo" class="col-12 col-lg-6">

                    <div class="card mb-4 bg-transparent border-invisible border-0 shadow-none d-flex align-items-center">
                        <div id="clock">
                            <div class="wrap">
                                <span class="hour"></span>
                                <span class="minute"></span>
                                <span class="second"></span>
                                <span class="dot"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div id="active-users" class="card mb-4 bg-dark-subtle">
                        <div class="card m-3 container-table text-white">
                            {{-- <img src="resources/img/stats.jpeg" class="card-img-top" alt="graphic of active users"> --}}
                            <div class="card-body">
                                <h5 class="card-title">Visitatori Medi ultimi mesi</h5>
                                <p class="card-text">Lista dei visitatori medi</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-primary-subtle  border-black">marzo: 1200</li>
                                <li class="list-group-item bg-primary-subtle  border-black">aprile: 800</li>
                                <li class="list-group-item bg-primary-subtle  border-black">maggio: 1500</li>
                            </ul>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div id="next-classes" class="card mb-4 bg-dark container-table">
                        <div class="card-header fw-bold fs-3 background-gradient-color text-white">
                            Proiezioni di oggi
                        </div>
                        <table class="table custom-table table-hover m-3 w-auto">
                            <thead>
                                <tr>
                                    <th scope="col" class="hype-w-3x100">#</th>
                                    <th scope="col">Id Proiezione</th>
                                    <th scope="col" class="d-none d-md-table-cell">Stanza</th>
                                    <th scope="col" class="">Film</th>
                                    <th scope="col" class="d-none d-md-table-cell">Fascia Oraria</th>
                                    <th scope="col" class="d-none d-md-table-cell">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projections as $projection)
                                    <tr>
                                        <td class="hype-w-3x100"
                                            style="background-color:{{ $projection->room->hex_color }} !important"></td>
                                        <td>
                                            <div class="hype-class d-flex">
                                                <div
                                                    class="hype-icon-container rounded-circle hype-bg-code d-flex align-items-center justify-content-center ">

                                                </div>
                                                <a href="{{ route('admin.projections.show', $projection->id) }}"
                                                    class=" text-decoration-none"><span
                                                        class="ps-2">{{ $projection->id }}</span></a>
                                            </div>
                                        </td>
                                        <td class="d-none d-md-table-cell ">
                                            <a href="{{ route('admin.rooms.show', $projection->room->slug) }}"
                                                class=" text-decoration-none">{{ $projection->room->name }}</a>
                                        </td>
                                        <td class=""><a
                                                href="{{ route('admin.movies.show', $projection->movie->slug) }}"
                                                class=" text-decoration-none">{{ $projection->movie->title }}</a>
                                        </td>
                                        <td class="d-none d-md-table-cell "><span class="badge text-dark bg-dark-subtle "><a
                                                    href="{{ route('admin.slots.show', $projection->slot->slug) }}"
                                                    class="text-dark text-decoration-none">{{ $projection->slot->name }}</a></span>
                                        </td>
                                        @php
                                            $badgeClass =
                                                $projection->slot->name == 'Pomeriggio' ? 'bg-success' : 'bg-primary';
                                            $badgeText =
                                                $projection->slot->name == 'Pomeriggio'
                                                    ? 'in riproduzione...'
                                                    : 'programmata';
                                        @endphp
                                        <td class="d-none d-md-table-cell "><span
                                                class="badge text-dark {{ $badgeClass }}">{{ $badgeText }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    @endsection

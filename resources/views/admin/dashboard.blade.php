@section('title', 'Admin Dashboard')
@extends('layouts.admin')


@section('content')
    <div class="container">
        <h2 class="mt-4">Bentornato {{ Auth::user()->name }}!</h2>
        <div id="card-container" class="p-3 h-100  container-fluid ">
            <div class="row">
                <div class="col-12 col-xxl-8">
                    <div id="next-classes" class="card mb-4 bg-dark">
                        <div class="card-header fw-bold fs-3 background-gradient-color text-white">
                            Proiezioni di oggi
                        </div>
                        <table class="table table-dark table-hover m-3 w-auto">
                            <thead>
                                <tr>
                                    <th scope="col">Id Proiezione</th>
                                    <th scope="col" class="d-none d-md-table-cell">Stanza</th>
                                    <th scope="col" class="">Film</th>
                                    <th scope="col" class="d-none d-md-table-cell">Fascia Oraria</th>
                                    <th scope="col" class="d-none d-md-table-cell">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projections as $projection)
                                    <tr style="background-color:{{ $projection->room->hex_color }} !important">
                                        <td>
                                            <div class="hype-class d-flex">
                                                <div
                                                    class="hype-icon-container rounded-circle hype-bg-code d-flex align-items-center justify-content-center text-white ">

                                                </div>
                                                <a href="{{ route('admin.projections.show', $projection->id) }}"
                                                    class="text-white text-decoration-none"><span
                                                        class="ps-2">{{ $projection->id }}</span></a>
                                            </div>
                                        </td>
                                        <td class="d-none d-md-table-cell ">
                                            <a href="{{ route('admin.rooms.show', $projection->room->slug) }}"
                                                class="text-white text-decoration-none">{{ $projection->room->name }}</a>
                                        </td>
                                        <td class=""><a
                                                href="{{ route('admin.movies.show', $projection->movie->slug) }}"
                                                class="text-white text-decoration-none">{{ $projection->movie->title }}</a>
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
                    <div id="faq" class="card mb-4">
                        <div
                            class="card-header text-uppercase fw-bold fs-3  background-gradient-color-black text-white border-black">
                            f.a.q.
                        </div>
                        <div class="accordion background-gradient-modal border-black" id="accordionExample">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="accordion-item  text-white" style="border: 1px solid black">
                                    <h2 class="accordion-header  ">
                                        <button class="accordion-button collapsed background-gradient-modal text-white"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $i }}" aria-expanded="false"
                                            aria-controls="collapseOne">
                                            Come Centrare un Div?
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $i }}"
                                        class="accordion-collapse collapse  text-white background-gradient-modal"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default,
                                            until the
                                            collapse plugin adds the appropriate classes that we use to style each element.
                                            These classes
                                            control the overall appearance, as well as the showing and hiding via CSS
                                            transitions. You can
                                            modify any of this with custom CSS or overriding our default variables. It's
                                            also
                                            worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>, though
                                            the
                                            transition
                                            does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div id="todo" class="col-12 col-xxl-4">
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

                    <div id="active-users" class="card mb-4 bg-dark">
                        <div class="card m-3 background-gradient-color-black text-white">
                            {{-- <img src="resources/img/stats.jpeg" class="card-img-top" alt="graphic of active users"> --}}
                            <div class="card-body">
                                <h5 class="card-title">Visitatori Medi ultimi mesi</h5>
                                <p class="card-text">Lista dei visitatori medi</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-dark text-white border-black">marzo: 1200</li>
                                <li class="list-group-item bg-dark text-white border-black">aprile: 800</li>
                                <li class="list-group-item bg-dark text-white border-black">maggio: 1500</li>
                            </ul>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection

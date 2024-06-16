<table id="rooms-table" class="table custom-table table-hover shadow mb-5 mt-3 hype-unselectable hype-table-clickable"
    style="background: linear-gradient(45deg,{{ $room->hex_color }} 54%, rgba(0, 0, 0, 0.88) 99%)">
    <thead>
        <tr>
            <th scope="col">#id Stanza</th>
            <th scope="col">Nome Stanza</th>
            <th scope="col" class="d-none d-xl-table-cell">Alias</th>
            <th scope="col" class="d-none d-xl-table-cell">Posti a Sedere</th>
            <th scope="col" class="d-none d-lg-table-cell">Colore Esadecimale</th>
            <th scope="col" class="d-none d-lg-table-cell">Prezzo Biglietto</th>
            <th scope="col" class="d-none d-lg-table-cell">Tecnologia Isense</th>
            <th scope="col" class="text-center">
                Azioni di Amministrazione</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><a>{{ $room->id }} </a></td>
            <td><a>{{ $room->name }}</a></td>
            <td class="d-none d-xl-table-cell"><a>{{ $room->alias }}</a></td>
            <td class="d-none d-xl-table-cell"><a>{{ $room->seats }}</a></td>
            <td class="d-none d-lg-table-cell"><a>{{ $room->hex_color }}</a></td>
            <td class="d-none d-lg-table-cell"><a>{{ $room->base_price }}</a></td>
            <td class="d-none d-lg-table-cell"><a>{{ $room->isense ? 'Sì' : 'No' }}</a></td>

            <td>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('admin.rooms.show', $room->slug) }}" class="table-icon m-1">
                        <div class="icon-container">
                            <i class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                        </div>
                    </a>
                    <a href="{{ route('admin.rooms.edit', $room->slug) }}" class="table-icon m-1">
                        <div class="icon-container">
                            <i
                                class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                        </div>
                    </a>
                    <form id="delete-form" action="{{ route('admin.rooms.destroy', $room->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="element-delete  default-button text-active-primary hype-text-shadow fs-3 m-1"
                            type="submit" data-element-id="{{ $room->id }}"
                            data-element-title="{{ $room->name }}">
                            <div class="icon-container">
                                <i class="fa-solid fa-trash-can "></i>
                            </div>
                        </button>
                    </form>
                </div>

            </td>
        </tr>
    </tbody>
</table>

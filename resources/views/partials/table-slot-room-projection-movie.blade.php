<table id="rooms-table" class="table table-dark shadow hype-unselectable hype-table-clickable"
    style="background: linear-gradient(45deg,{{ $projection->room->hex_color }} 54%, rgba(0, 0, 0, 0.88) 99%)">
    <thead>
        <tr>
            <th scope="col hype-w-15x100">Nome Stanza</th>
            <th scope="col hype-w-15x100" class="d-none d-xl-table-cell">Alias</th>
            <th scope="col hype-w-15x100" class="d-none d-xl-table-cell">Posti a Sedere</th>
            <th scope="col hype-w-20x100">Nome Film</th>
            <th scope="col hype-w-15x100">Data Proiezione</th>
            <th scope="col hype-w-20x100">Id Proiezione</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td class="hype-hover-bg-light hype-w-15x100"><a
                    href="{{ route('admin.rooms.show', $projection->room->slug) }}">{{ $projection->room->name }}</a>
            </td>
            <td class="d-none d-xl-table-cell hype-hover-bg-light hype-w-15x100"><a
                    href="{{ route('admin.rooms.show', $projection->room->slug) }}">{{ $projection->room->alias }}</a>
            </td>
            <td class="d-none d-xl-table-cell hype-w-15x100"><a>{{ $projection->room->seats }}</a></td>
            <td class="hype-hover-bg-light hype-w-20x100"><a
                    href="{{ route('admin.movies.show', $projection->movie->slug) }}">{{ $projection->movie->title }}</a>
            </td>
            <td class="hype-hover-bg-light hype-w-15x100 hype-pointer"><a class="date-click"
                    data-element-date="{{ $projection->date }}">{{ $projection->date }}</a>
            </td>
            <td class="hype-hover-bg-light hype-w-20x100"><a
                    href="{{ route('admin.projections.show', $projection->id) }}">{{ $projection->id }}</a></td>
        </tr>
    </tbody>
</table>

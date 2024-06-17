<table id="rooms-table" class="table custom-table shadow hype-unselectable hype-table-clickable"
    style="background: linear-gradient(45deg,{{ $projection->room->hex_color }} 54%, rgba(0, 0, 0, 0.88) 99%)">
    <thead>
        <tr>
            <th scope="col hype-w-20x100">Id Proiezione</th>
            <th scope="col hype-w-40x100">Nome Film</th>
            <th scope="col hype-w-20x100">Data Proiezione</th>
            <th scope="col hype-w-20x100">Fascia Oraria</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td class="hype-hover-bg-light hype-w-20x100"><a
                    href="{{ route('admin.projections.show', $projection->id) }}">{{ $projection->id }}</a></td>
            <td class="hype-hover-bg-light hype-w-40x100 "><a
                    href="{{ route('admin.movies.show', $projection->movie->slug) }}">{{ $projection->movie->title }}</a>
            </td>
            <td class="hype-hover-bg-light hype-w-20x100 hype-pointer"><a class="date-click"
                    data-element-date="{{ $projection->date }}">{{ \Carbon\Carbon::parse($projection->date)->format('d/m/Y') }}</a>
            </td>
            <td class="hype-hover-bg-light hype-w-20x100"><a
                    href="{{ route('admin.slots.show', $projection->slot->slug) }}">{{ $projection->slot->name }}</a>
            </td>
        </tr>
    </tbody>
</table>

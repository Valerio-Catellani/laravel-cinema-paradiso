<table id="rooms-table" class="table custom-table table-hover shadow mb-5 mt-3 hype-unselectable hype-table-clickable">
    <thead>
        <tr>
            <th scope="col">#id Proiezione</th>
            <th scope="col">Sala</th>
            <th scope="col">Film</th>
            <th scope="col">Fascia Oraria</th>
            <th scope="col" class="d-none d-xl-table-cell">Costo complessivo Biglietto</th>
            <th scope="col" class="d-none d-lg-table-cell">Giorno</th>
            <th scope="col" class="text-center">
                Azioni di Amministrazione</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projections as $element)
            <tr class="hype-hover-bg-light"
                style="background: linear-gradient(45deg,{{ $element->room->hex_color }} 54%, rgba(0, 0, 0, 0.88) 99%)">

                <td>{{ $element->id }}</td>
                <td>{{ $element->room->name }}</td>
                <td>{{ $element->movie->title }}</td>
                <td>{{ $element->slot->name }}</td>
                <td class="d-none d-xl-table-cell">{{ $element->final_ticket_price }} €</td>
                <td class="d-none d-lg-table-cell"><a>{{ \Carbon\Carbon::parse($element->date)->format('d/m/Y') }}</a>
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.projections.show', $element->id) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.projections.edit', $element->id) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <form id="delete-form" action="{{ route('admin.projections.destroy', $element->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="element-delete  default-button text-active-primary hype-text-shadow fs-3 m-1"
                                type="submit" data-element-id="{{ $element->id }}"
                                data-element-title="{{ $element->id }}">
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

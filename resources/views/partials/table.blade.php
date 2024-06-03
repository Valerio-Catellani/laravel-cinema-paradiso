<table id="rooms-table" class="table table-dark table-hover shadow mb-2 mt-3 hype-unselectable hype-table-clickable">
    <thead>
        <tr>
            <th scope="col">#id Room</th>
            <th scope="col">Room Name</th>
            <th scope="col" class="d-none d-xl-table-cell">Alias</th>
            <th scope="col" class="d-none d-lg-table-cell">Seats</th>
            <th scope="col" class="d-none d-lg-table-cell">Room Image</th>
            <th scope="col" class="d-none d-lg-table-cell">Hex Color</th>
            <th scope="col" class="d-none d-lg-table-cell">Base Price</th>
            <th scope="col" class="d-none d-lg-table-cell">Isense</th>
            <th scope="col">
                Amministration Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($elements as $element)
            <tr>
                <td><a>{{ $element->id }} </a></td>
                <td><a>{{ $element->name }}</a></td>
                <td class="d-none d-xl-table-cell"><a>{{ $element->alias }}</a></td>
                <td class="d-none d-xl-table-cell"><a>{{ $element->seats }}</a></td>
                <td class="d-none d-xl-table-cell"><a>{{ $element->room_image }}</a></td>
                <td class="d-none d-lg-table-cell"><a>{{ $element->hex_color }}</a></td>
                <td class="d-none d-lg-table-cell"><a>{{ $element->base_price }}</a></td>
                <td class="d-none d-lg-table-cell"><a>{{ $element->isense ? 'Yes' : 'No' }}</a></td>

                <td>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.rooms.show', $element->id) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.rooms.edit', $element->id) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <form id="delete-form" action="{{ route('admin.rooms.destroy', $element->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="element-delete default-button text-active-primary hype-text-shadow fs-3 m-1"
                                type="submit" data-element-id="{{ $element->id }}"
                                data-element-title="{{ $element->title }}">
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

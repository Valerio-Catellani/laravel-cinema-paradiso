<table id="rooms-table"
    class="table custom-table table-hover table-striped shadow mb-5 mt-3 hype-unselectable hype-table-clickable">
    <thead>
        <tr>
            <th scope="col">#id Film</th>
            <th scope="col">Titolo</th>
            <th scope="col" class="d-none d-xl-table-cell">Id MovieDb</th>
            <th scope="col" class="d-none d-lg-table-cell">Valutazione Publico</th>
            <th scope="col" class="d-none d-lg-table-cell">Lingua Originale</th>
            <th scope="col" class="text-center">
                Azioni di Amministrazione</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
            <tr>
                <td><a>{{ $movie->id }} </a></td>
                <td><a>{{ $movie->title }}</a></td>
                <td class="d-none d-xl-table-cell"><a>{{ $movie->theMovieDb_id }}</a></td>
                <td class="d-none d-lg-table-cell"><a>{{ $movie->avarage_rating }}</a></td>
                <td class="d-none d-lg-table-cell"><a>{{ $movie->original_language }}</a></td>
                <td>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.movies.show', $movie->slug) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-eye fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.movies.edit', $movie->slug) }}" class="table-icon m-1">
                            <div class="icon-container">
                                <i
                                    class=" fa-solid fa-pen-to-square fs-3 text-active-tertiary hype-text-shadow hype-hover-size"></i>
                            </div>
                        </a>
                        <form id="delete-form" action="{{ route('admin.movies.destroy', $movie->slug) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="element-delete  default-button text-active-primary hype-text-shadow fs-3 m-1"
                                type="submit" data-element-id="{{ $movie->id }}"
                                data-element-title="{{ $movie->title }}">
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

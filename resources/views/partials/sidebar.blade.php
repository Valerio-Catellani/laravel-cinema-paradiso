<nav id='sidebar' class=" navbar-dark position-relative sidebar-risize">
    <button id="hype-sidebar-collapse" class="default-button text-white position-absolute"><i
            class="fa-solid fa-caret-left fs-1 hype-text-collapse"></i><i
            class="fa-solid fa-caret-right fs-1 d-none hype-text-collapse"></i></button>
    <a href="/" class="nav-link text-white d-flex p-3">
        <div class="logo-img-container d-flex align-items-center">
            <img class="img-fluid hype-color-invert py-3" src="" alt="logo">
        </div>
        <h2 class="p-3 hype-text-collapse">Cinema Paradiso</h2>
    </a>
    <ul class="nav flex-column">
        <li class="nav-item  {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">
            <a class="nav-link text-white " aria-current="page" href="{{ route('admin.dashboard') }}"><i
                    class="fa-solid fa-home fs-4 pe-3"></i><span class="hype-text-collapse">Homepage</span></a>
        </li>
        <li
            class="nav-item {{ Route::currentRouteName() === 'admin.rooms.index' || Route::currentRouteName() === 'admin.rooms.show' || Route::currentRouteName() === 'admin.rooms.edit' || Route::currentRouteName() === 'admin.rooms.create' ? 'active' : '' }}">
            <a class="nav-link text-white " aria-current="page" href="{{ route('admin.rooms.index') }}"><i
                    class="fa-solid fa-tv fs-4 pe-3"></i><span class="hype-text-collapse">Sale</span></a>
        </li>
        <li
            class="nav-item {{ Route::currentRouteName() === 'admin.movies.index' || Route::currentRouteName() === 'admin.movies.show' || Route::currentRouteName() === 'admin.movies.edit' || Route::currentRouteName() === 'admin.movies.create' ? 'active' : '' }}">
            <a class="nav-link text-white " aria-current="page" href="{{ route('admin.movies.index') }}"><i
                    class="fa-solid fa-film fs-4 pe-3"></i><span class="hype-text-collapse">Film</span></a>
        </li>
        <li
            class="nav-item {{ Route::currentRouteName() === 'admin.reviews.index' || Route::currentRouteName() === 'admin.reviews.show' || Route::currentRouteName() === 'admin.reviews.edit' || Route::currentRouteName() === 'admin.reviews.create' ? 'active' : '' }}">
            <a class="nav-link text-white " aria-current="page" href="{{ route('admin.reviews.index') }}"><i
                    class="fa-solid fa-comment fs-4 pe-3"></i><span class="hype-text-collapse">Recensioni</span></a>
        </li>
    </ul>
</nav>

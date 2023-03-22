<ul class="navbar-nav me-auto">
    <li class="nav-item">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Noticias
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{ route('category.index') }}">Categorias</a></li>
              <li><a class="dropdown-item" href="{{ route('news.index') }}">Notícias</a></li>
            </ul>
          </div>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link dropdown-toggle" aria-current="page" href="#">Teste2</a>
    </li> --}}
</ul>

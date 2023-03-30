@extends('layouts.app')

@section('content')
    <style>
        .img-thumbnail {
            max-width: 70px;
            width: 70px;
            max-height: 70px;
            height: 70px;
        }
    </style>
    <h2 class="text-center">
        Gerenciar Notícias
    </h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-3">
                    <div class="card-body">
                        <a class="btn btn-primary" type="button" href="{{ route('news.create') }}">
                            Cadastrar
                        </a>
                        <x-news-filter :route="route('news.index')" :filter="$filter" :categories="$categories" :filterCategories="$filterCategories" />
                        <ul class="list-group mt-1">
                            @foreach ($news as $new)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <img src="{{ asset($new->image_path) }}" id="img" class="img-thumbnail" />
                                        <span class="ms-3"
                                            title="{{ $new->title }}">{{ Str::limit($new->title, 30) }}</span>
                                    </div>
                                    <div class="d-flex gap-2 mt-3">
                                        <form method="GET" action="{{ route('news.edit', [$new->id]) }}">
                                            @csrf
                                            <button type="submit" title="Editar" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('news.destroy', [$new->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" title="Excluir" class="btn btn-danger"
                                                onclick="deleteConfirm(event)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3 justify-content-end">
                            {{ $news->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('js')
    <script type="module">
     $(document).ready(function() {

        @if (session('saved'))
            successSavedAlert();
        @endif

        @if (session('updated'))
            successSavedAlert('Registro editado com sucesso!');
        @endif

        @if (session('deleted'))
            successRemovedAlert();
        @endif
     })
    </script>
    @endpush

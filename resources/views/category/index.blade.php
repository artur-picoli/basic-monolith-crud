@extends('layouts.app')

@section('content')
    <h2 class="text-center">
        Categorias
    </h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-body">
                        <button class="btn btn-primary" type="button" onclick="categoryCreate()">
                            Cadastrar
                        </button>
                        <div class="row mt-3">
                            <div class="col-12">
                                <form method="GET" action="{{ route('category.index') }}">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input id="filter" type="text" placeholder="Filtre pelo nome da categoria"
                                            class="form-control @error('filter') is-invalid @enderror" name="filter"
                                            value="{{ old('filter', $filter) }}" autocomplete="filter">
                                        <button class="btn btn-primary" type="submit" id="button-addon2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button>
                                        @error('filter')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                        </div>
                        <ul class="list-group mt-1">
                            @foreach ($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <span title="{{ $category->name }}">{{ Str::limit($category->name,35) }}</span>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-primary"
                                            onclick="categoryEdit('{{ route('category.edit', $category->id) }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                              </svg>
                                        </button>
                                        <form method="POST" action="{{ route('category.destroy', [$category->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="deleteConfirm(event)">
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
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('category.modal-create')
    @endsection

    @push('js')
        <script type="module">
        @if (session('saved'))
            successSavedAlert();
        @endif

        @if (session('deleted'))
            successRemovedAlert();
        @endif

        const modalCreate = new bootstrap.Modal('#modal-create', {});

        @if($errors->has('name'))
            modalCreate.show()
        @endif

        window.categoryEdit =  function (route) {
            $('#modal-create .modal-body').load(route, function(){
                $('#modal-create .modal-title').html('Edição de Catergoria')
                modalCreate.show()
            })

        }

        window.categoryCreate =  function (id) {
            $('#modal-create .modal-body').load('{{ route('category.create') }}', function(){
                $('#modal-create .modal-title').html('Cadastro de Catergoria')
                modalCreate.show()
            })
        }

    </script>
    @endpush

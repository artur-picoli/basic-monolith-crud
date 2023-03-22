@extends('layouts.app')

@section('content')
    <h2 class="text-center">
        Cadastro de Notícias
    </h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Título</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                                <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Imagem</label>
                                <input class="form-control form-control-sm" id="file" name="file" type="file">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary me-2">Salvar</button>
                                <button type="button" class="btn btn-secondary">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

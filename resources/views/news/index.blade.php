@extends('layouts.app')

@section('content')
    <h2 class="text-center">
        Notícias
    </h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-body">
                        <a class="btn btn-primary" type="button" href="{{ route('news.create') }}">
                            Cadastrar
                        </a>
                        <div class="row mt-3">
                            <div class="col-12">

                            </div>
                        </div>

                        <div class="mt-3 justify-content-end">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

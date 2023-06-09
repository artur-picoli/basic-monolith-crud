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
                            @include('news.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection


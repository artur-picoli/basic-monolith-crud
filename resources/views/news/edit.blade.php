@extends('layouts.app')

@section('content')
    <h2 class="text-center">
        Editar Notícia
    </h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('news.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

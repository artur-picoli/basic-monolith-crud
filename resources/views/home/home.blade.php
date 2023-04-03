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
        Notícias
    </h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <x-news-filter :route="route('home')" :filter="$filter" :categories="$categories" :filterCategories="$filterCategories" />
                        <div class="px-3 pt-3">
                            @foreach ($news as $new)
                                <a href="#" class="text-dark" onclick="openNew('{{ route('home.show', $new->id) }}')">
                                    <div class="row mb-4 border-bottom pb-2">
                                        <div class="col-3">
                                            <img src="{{ asset($new->image_path) }}"
                                                class="img-fluid shadow-1-strong rounded"
                                                alt="Hollywood Sign on The Hill" />
                                        </div>

                                        <div class="col-9">
                                            <p class="mb-2"><strong>{{ $new->title }}</strong></p>
                                            <p>
                                                <u> {{ \Carbon\Carbon::parse($new->created_at)->format('d-m-Y') }}</u>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-3 justify-content-end">
                            {{ $news->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="show-news">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script type="module">

const showNews = new bootstrap.Modal('#show-news', {});

window.openNew =  function (route) {
    $('#show-news .modal-body').load(route, function(){
       showNews.show()
    })
}

</script>
@endpush

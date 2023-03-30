<div class="card px-3 pt-3">
    <div class="bg-image hover-overlay shadow-1-strong ripple rounded-5 mb-4" data-mdb-ripple-color="light">
        <img src="{{ asset($news->image_path) }}" class="img-fluid" width="100%" />
        <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
        </a>
    </div>
    <!-- Article data -->
    <div class="row mb-3">
        <div class="col-6">
            <i class="fas fa-plane"></i>
            @foreach ($news->categories as $category)
                <span class="badge text-bg-primary">
                    {{ $category->name }}
                </span>
            @endforeach

        </div>

        <div class="col-6 text-end">
            <u> {{ \Carbon\Carbon::parse($news->created_at)->format('d-m-Y') }}</u>
        </div>
    </div>
    <h2>{{ $news->title }}</h2>

    <p>
        {{ $news->body }}
    </p>

</div>

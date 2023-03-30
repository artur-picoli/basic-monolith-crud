<div class="row mt-3">
    <form method="GET" action="{{ $route }}">
        @csrf
        <div class="mb-3">
            <input id="filter" type="text" placeholder="Filtre pelo nome da notícia"
                class="form-control @error('filter') is-invalid @enderror" name="filter"
                value="{{ old('filter', $filter ?? '') }}" autocomplete="filter">
            @error('filter')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <select class="form-control @error('categories') is-invalid @enderror" id="categories" name="categories[]"
                multiple="multiple">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('categories') && in_array($category->id, old('categories')) || in_array($category->id, $filterCategories))>
                        {{ $category->name }}</option>
                @endforeach
            </select>
            @error('categories')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex justify-content-end mb-5">
            <button class="btn btn-primary" type="submit">
                Filtrar
            </button>
        </div>
    </form>
</div>

@push('js')
    <script type="module">
     $(document).ready(function() {
        $('#categories').select2({
            placeholder: "Filtre pela categoria",
        })
     })
    </script>
@endpush

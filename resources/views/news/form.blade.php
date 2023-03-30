<div class="row">
    <div class="col-12 mb-3">
        <label for="exampleFormControlInput1" class="form-label">Título</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            value="{{ old('title', $news->title ?? '') }}">
        @error('title')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="mb-3">
    <label for="categories" class="form-label">Categorias</label>
    <select class="form-select @error('categories') is-invalid @enderror  @error('categories.*') is-invalid @enderror"
        id="categories" name="categories[]" multiple="multiple">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('categories') && in_array($category->id, old('categories')) || in_array($category->id, $news_categories ?? []))>
                {{ $category->name }}</option>
        @endforeach
    </select>
    @error('categories')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    @error('categories.*')
        <span class="invalid-feedback d-block" role="alert">
            <li>{{ $message }}</li>
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Conteúdo</label>
    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3">{{ old('body', $news->body ?? '') }}</textarea>
    @error('body')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="mb-3" id="div-imagem">
    <label for="formFileSm" class="form-label">Imagem</label>
    <input class="form-control form-control-sm @error('file') is-invalid @enderror" id="file" name="file"
        type="file" value="{{ $news->image_name ?? '' }}">
    @error('file')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
@if (isset($news))
    <div id="div-imagem-atual"class="mb-3">
        Imagem atualmente salva:
        <a href="{{ asset($news->image_path) }}" target="_BLANK">
            <b> Visualizar </b>
        </a>
    </div>
    <div class="mb3">
        <button type="button" id="btn-alterar-imagem" class="btn btn-primary">Alterar imagem</button>
        <button type="button" id="btn-cancelar-alterar" class="btn btn-secondary" style="display:none">Cancelar
            troca</button>
    </div>
@endif
<div class="text-end">
    <button type="submit" class="btn btn-primary me-2">Salvar</button>
    <a href="{{ route('news.index') }}" class="btn btn-secondary">Cancelar</a>
</div>
@push('js')
    <script type="module">
     $(document).ready(function() {
        $('#categories').select2();

        @if(isset($news))
            $('#div-imagem').hide()
        @endif

        $('#btn-alterar-imagem').click(function(){
            $('#div-imagem').show()
            $('#div-imagem-atual').hide()
            $('#btn-alterar-imagem').hide()
            $('#btn-cancelar-alterar').show()
        })

        $('#btn-cancelar-alterar').click(function(){
            $('#div-imagem').hide()
            $('#div-imagem-atual').show()
            $('#btn-alterar-imagem').show()
            $('#btn-cancelar-alterar').hide()
        })
    })
</script>
@endpush

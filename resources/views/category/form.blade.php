@csrf
<div class="row mb-3 mt-3">
    <div class="col-12">
        <input id="name" type="text" placeholder="Digite uma categoria antes de salvar"
            class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}"
            autocomplete="name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<script type="module">
    $('#category-form').submit(function(event) {
        event.preventDefault()
        axios.post($(this).attr('action'), $(this).serialize()).catch(function(error){
            errorAlert(error.response.data.message)
        }).then(function(success){
            window.location = success.data.route
        })
    })
</script>

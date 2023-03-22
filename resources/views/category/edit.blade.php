<form method="POST" action="{{ route('category.update', $category) }}" id="category-form">
    @method('PUT')
    @include('category.form')
</form>

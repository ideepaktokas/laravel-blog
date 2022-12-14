@if ($errors->any())
<div class="mb-3">
    <ul class="list-group">
        @foreach ($errors->all() as $error)
        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{-- optional($post ?? null)->title --}}
<div class="form-group">
    <label for="title">Title</label>
    <input id="title" class="form-control" ype="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}">
</div>
<div class="form-group">
    <label for="content">Content</label>
    <textarea id="content" class="form-control" name="content" id="" cols="30" 
        rows="10">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>
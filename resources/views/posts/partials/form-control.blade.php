<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
        placeholder="Enter title..." autocomplete="off" value="{{ old('title') ?? $post->title }}">

    @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="body" class="form-label">Body</label>
    <textarea name="body" id="body" cols="30" rows="10" placeholder="Enter body..."
        class="form-control @error('body') is-invalid @enderror">{{ old('body') ?? $post->body }}</textarea>

    @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
        <option disabled selected>Choose one!</option>
        @foreach ($categories as $category)
            <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label d-block">Tag</label>

    @foreach ($post->tags as $tag)
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('tags') is-invalid @enderror" type="checkbox" value="{{ $tag->id }}"
                id="{{ $tag->id }}" name="tags[]" checked>
            <label class="form-check-label " for="{{ $tag->id }}">
                {{ $tag->name }}
            </label>
        </div>
    @endforeach

    @foreach ($tags as $tag)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="{{ $tag->id }}" name="tags[]">
            <label class="form-check-label" for="{{ $tag->id }}">
                {{ $tag->name }}
            </label>
        </div>
    @endforeach

    @error('tags')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>

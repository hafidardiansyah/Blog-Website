<div class="mb-3">
    <label for="thumbnail" class="form-label">Image</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" id="thumbnail"
            name="thumbnail" onchange="previewImg()">
        @error('thumbnail')
            <div class=" invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <label class="custom-file-label" for="thumbnail">Choose file</label>
    </div>

</div>

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
    <div class="form-group">
        <label class="form-label d-block">Tag</label>

        @error('tags')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        @foreach ($post->tags as $tag)
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('tags') is-invalid @enderror" type="checkbox"
                    value="{{ $tag->id }}" id="{{ $tag->id }}" name="tags[]" checked>
                <label class="form-check-label " for="{{ $tag->id }}">
                    {{ $tag->name }}
                </label>
            </div>
        @endforeach

        @foreach ($tags as $tag)
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('tags') is-invalid @enderror" type="checkbox"
                    value="{{ $tag->id }}" id="{{ $tag->id }}" name="tags[]">
                <label class="form-check-label" for="{{ $tag->id }}">
                    {{ $tag->name }}
                </label>
            </div>
        @endforeach
    </div>
</div>


<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>

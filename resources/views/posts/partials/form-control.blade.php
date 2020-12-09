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
<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>

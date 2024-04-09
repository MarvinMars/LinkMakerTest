<form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" action="{{ route('links.store') }}">
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control @error('original_link') is-invalid @enderror" id="original_link" name="original_link" value="{{ old('original_link') }}">
        <label for="original_link">Original Link</label>
        @error('original_link')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @include('partials.inputs.range', [
        'name' => 'life_seconds',
        'title' => 'Life Time',
        'min' => 0,
        'max' => 60 * 60 * 24,
        'value' => 60 * 3
    ])
    <div class="form-floating mb-3">
        <input type="number" class="form-control @error('redirects_count') is-invalid @enderror" id="redirects_count" name="redirects_count" value="{{ old('redirects_count') }}">
        <label for="redirects_count">Redirects Count</label>
        @error('redirects_count')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Create</button>
</form>

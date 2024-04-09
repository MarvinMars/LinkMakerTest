@php use App\Models\Link; @endphp

<form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" action="{{ route('links.store') }}">
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control @error('original_link') is-invalid @enderror" id="original_link"
               name="original_link" value="{{ old('original_link') }}">
        <label for="original_link">Original Link</label>
        @error('original_link')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @include('partials.inputs.range', [
        'name' => 'life_seconds',
        'title' => 'Life Time',
        'min' => 0,
        'max' => Link::MAX_LIFE_TIME,
        'value' => old('life_seconds')
    ])
    @include('partials.inputs.counter', [
      'name' => 'redirects_count',
      'title' => 'Redirects Count',
      'min' => 0,
      'value' => old('redirects_count')
  ])
    <button class="w-100 btn btn-lg btn-primary" type="submit">Create</button>
</form>

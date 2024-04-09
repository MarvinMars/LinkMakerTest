<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Link creator test task</h1>
                <p class="col-lg-10 fs-4">
                    @php($link = session()->get('link'))
                    @if($link ?? false)
                        <div class="alert alert-success" role="alert">
                            Your link:
                            <a href="{{ route('links.redirect', ['short_link' => $link->short_link]) }}" target="_blank">
                               {{ route('links.redirect', ['short_link' => $link->short_link]) }}
                            </a>
                        </div>
                    @else
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed elementum tempus egestas sed sed risus pretium quam vulputate.
                    @endif
                </p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" action="{{ route('links.store') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('original_link') is-invalid @enderror" id="original_link" name="original_link" value="{{ old('original_link') }}">
                        <label for="original_link">Original Link</label>
                        @error('original_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('life_seconds') is-invalid @enderror" id="life_seconds" name="life_seconds" value="{{ old('life_seconds') }}">
                        <label for="life_seconds">Life Time (seconds)</label>
                        @error('life_seconds')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('redirects_count') is-invalid @enderror" id="redirects_count" name="redirects_count" value="{{ old('redirects_count') }}">
                        <label for="redirects_count">Redirects Count</label>
                        @error('redirects_count')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
    </body>
</html>

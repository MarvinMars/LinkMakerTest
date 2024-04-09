@extends('layouts.base')

@section('title', 'Create Link')

@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Link creator test task</h1>
                <div class="col-lg-10">
                    @session('link')
                    <div class="alert alert-success" role="alert">
                        Your link:
                        <a href="{{ route('links.redirect', ['short_link' => $value->short_link]) }}" target="_blank">
                            {{ route('links.redirect', ['short_link' => $value->short_link]) }}
                        </a>
                    </div>
                    @endsession
                </div>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                @include('partials.forms.createLink')
            </div>
        </div>
    </div>
@endsection
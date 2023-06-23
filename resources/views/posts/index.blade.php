@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-6">
                    @foreach ($posts as $index => $post)
                        @include('partials.post-card')
                    @endforeach

                </div>
                <div class="col-3">
                </div>
            </div>
        </div>
    </div>

@endsection


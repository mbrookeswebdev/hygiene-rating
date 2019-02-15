@extends('layouts.main')

@section ('title')
    Food Hygiene Rating App
@endsection

@section ('content')

    @if ($rating != null)

        <div class="text-center col-sm-6 col-md-8 col-lg-12  mt-5">

            The hygiene rating of {{ $name }} located at {{ $addressL1 }} {{ $addressL2 }} {{ $postcode }} is

            <div class="mt-4 mb-4"><img src="/images/{{$rating}}.jpg"></div>

            <h6 class="mt-3 mb-5 mx-auto"><a href="/">Search Again</a></h6>
        </div>

    @else
        <div class="text-center col-sm-4 col-md-4 col-lg-6 mx-auto mt-5">
            <h5>{{ $message }}</h5>

            <h6 class="mt-3 mb-5 mx-auto"><a href="/">Search Again</a></h6>
        </div>
    @endif

@endsection



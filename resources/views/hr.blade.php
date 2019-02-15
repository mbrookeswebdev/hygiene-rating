@extends('layouts.main')

@section ('title')
    Food Hygiene Rating App
@endsection

@section('content')

    <div class="col-sm-4 col-md-4 col-lg-4 mx-auto mt-5">

        <h2 class="mt-4 mb-4">Food Hygiene Ratings</h2>

        <form method="get" action={{action('QueryController@query')}}>
            <div class="form-group">
                <label for="restaurant-name">Restaurant name:</label>
                <input type="text" class="form-control" name="name" aria-describedby="restaurant-name"
                       placeholder="Enter restaurant name">
            </div>
            <div class="form-group">
                <label for="restaurant-name">Address:</label>
                <input type="text" class="form-control" name="address" aria-describedby="restaurant-address"
                       placeholder="Enter full or partial address">
            </div>
            <button type="submit" class="btn btn-success">View</button>
        </form>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mx-auto mt-5 mt-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
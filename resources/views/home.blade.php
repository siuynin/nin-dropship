@extends('layouts.frontend')

@section('content')
    <div class="container mt-5">
        <h1>Welcome to {{ config('app.name', 'Laravel') }}</h1>
        <p>This is the homepage of your Laravel application.</p>
    </div>
@endsection
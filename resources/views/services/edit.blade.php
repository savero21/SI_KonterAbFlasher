@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Data Servis</h3>
    <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
        @method('PUT')
        @include('services.form')
    </form>
</div>
@endsection

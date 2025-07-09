@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Data Servis</h3>
    @php $formAction = route('services.update', $service->id); @endphp
    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('services.form')
    </form>
</div>
@endsection

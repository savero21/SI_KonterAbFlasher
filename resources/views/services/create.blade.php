@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Data Servis</h3>
    <form action="{{ route('services.store') }}" method="POST">
        @include('services.form')
    </form>
</div>
@endsection

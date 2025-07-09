@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Data Servis</h3>
    @php $formAction = route('services.store'); @endphp
    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @include('services.form')
    </form>
</div>
@endsection

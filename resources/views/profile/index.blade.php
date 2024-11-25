@extends('layouts.app')

@section('content')
<div class="container p-5">
    <img src="{{ asset("assets/img/user/" . Auth::user()->image) }}" alt="" width="200px" height="200px" style="object-fit: cover; border-radius: 50%;" class="shadow">
    <h1 class="my-5">{{ Auth::user()->name }}</h1>
    <div class="row">
        <div class="col">
            <label for="">Email Kandidat</label>
            <input type="text" name="" value="{{ Auth::user()->email }}" id="" class="form-control mt-3" readonly>
        </div>
        <div class="col">
            <label for="">Posisi Kandidat</label>
            <input type="text" name="" value="{{ Auth::user()->posisi }}" id="" class="form-control mt-3" readonly>
        </div>
    </div>
</div>
@endsection
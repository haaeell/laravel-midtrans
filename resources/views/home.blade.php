@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center gap-3">
        @foreach ($products as $item)
            <div class="col-md-3 card p-3">
                <p>{{ $item->name }}</p>
                <p>{{ $item->price }}</p>
                <form action="{{ route('checkOut', $item->id) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">CheckOut</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection


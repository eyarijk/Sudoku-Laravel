@extends('layouts.main')
@section('content')
    <div class="container">
        <form onsubmit="if (!$('input[name=lvl]:checked').val()){alert('Виберіть рівень!');return false;}" id="submit" action="{{ route('start.game') }}" method="get">
            <p>РІВЕНЬ СКЛАДНОСТІ:</p>
            <p>20% <input type="radio" name="lvl" value="0.2"></p>
            <p>40% <input type="radio" name="lvl" value="0.4"></p>
            <p>60% <input type="radio" name="lvl" value="0.6"></p>
            <p><input type="submit" value="Start" class="start"></p>
        </form>
    </div>
@endsection

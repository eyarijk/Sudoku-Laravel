@extends('layouts.main')
@section('content')
    <div class="container" id="main-div">
        <h1 id="title">Sudoku</h1>
        <table id="grid">
            @foreach($arrays as $column => $array)
                <tr>
                    @foreach($array as $key => $value)
                        <td><input id="{{$column}}-{{$key}}"  type="text" value="{{ $value }}" @if($value != "") disabled @else class="search" @endif></td>
                    @endforeach
                </tr>
            @endforeach

        </table>
    </div>
    <form id="validCell">
        {{ csrf_field() }}
        <input type="hidden" name="value" id="value">
        <input type="hidden" name="id" id="id">
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var start = new Date().getTime();
            var error = 0;
            $('input').change(function () {
                $('#id').val(this.id);
                $('#value').val(this.value);
                $.ajax({
                    type: 'POST',
                    url: '/validCell',
                    data: $('#validCell').serialize(),
                    success: function(result){
                        var json = JSON.parse(result);
                        if (json.status == 'success'){
                            $($('#'+json.id)).prop('disabled',true);
                            $($('#'+json.id)).removeClass('search');
                            solution();
                        } else {
                            $($('#'+json.id)).addClass('danger');
                            error++;
                        }

                    }
                });
            });
            $('input').keypress(function (e) {
                if (e.which > 47 &&  e.which < 58)
                    return true;
                else
                    return false;
            });

            function solution() {
                if ($('.search').length < 1){
                    $('#grid').remove();
                    $('#title').text('Перемога!');
                    $('#main-div').append('<h2><a href="/" class="start">Головна!</a></h2><h2><a href="#" onclick="location.reload();" class="start">Ще раз!</a></h2>');
                    var finish = new Date().getTime();
                    var time = (finish - start) / 1000;
                    $('#main-div').append('<p>Ви знайшли розв\'язок за ' + time + ' сек.</p><p>Рівень складності: {{ Request::get('lvl') * 100 }}%</p>');
                    $('#main-div').append('<p>Кількість помилок : ' + error + '</p>');
                }
            }
        });

    </script>
@endsection
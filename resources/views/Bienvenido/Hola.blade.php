@extends('layout.app')
@section('header')
    this is header
@endsection

@section('content')
<br><br>
Hola estoy saludndo desde la vista. 
<br><br>
{{$data}}

    @foreach($user as $item)
        <h2>{{$item}}</h2>
    @endforeach

    @if($user[0] == 'abc@gmail.com')
        <br>La id coincide
    @else
        <br>La id no coincide
    @endif

@endsection

@section('script') 
<script>
    alert('Hola');
</script>
@endsection
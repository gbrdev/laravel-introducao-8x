@extends('base')

@section('content')

<form action="{{ route('client.update', $client->id) }}" method="post">
    @csrf
    @method('PUT')
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" required value="{{ $client->name }}">
    <br>
    <label for="age">Idade:</label>
    <input type="number" name="age" id="age" required value="{{ $client->age }}">
    <br>
    <input type="submit" name="command" value="Salvar">
    <input type="reset" name="command" value="Limpar">
    </form>
    
@endsection
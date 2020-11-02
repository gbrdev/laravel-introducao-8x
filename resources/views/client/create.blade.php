@extends('base')

@section('content')

<form action="{{ route('client.store') }}" method="post">
@csrf
<label for="name">Nome:</label>
<input type="text" name="name" id="name">
<br>
<label for="age">Idade:</label>
<input type="number" name="age" id="age">
<br>
<input type="submit" name="command" value="Salvar">
<input type="reset" name="command" value="Limpar">
</form>

@if ($errors->any())
    <h2>Erros</h2>
    <ul>
    @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
    @endforeach
    </ul>
@endif

@endsection


@extends('base');

@section('content')

<h1>Visualizando o Cliente</h1>

<p><strong>ID:</strong>{{ $client->id }}</p>
<p><strong>Nome:</strong>{{ $client->name }}</p>
<p><strong>Idade:</strong>{{ $client->age }}</p>
<hr>

<a href="{{ route('client.index') }}">Voltar</a>
    
@endsection
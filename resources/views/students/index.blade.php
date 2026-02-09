@extends('layouts.app')

@section('content')

<p>Redovni: {{ $redovni }} | Izvanredni: {{ $izvanredni }}</p>

<a href="{{ route('students.create') }}">Novi student</a>

<table border="1">
@foreach($students as $s)
<tr>
<td>{{ $s->ime }}</td>
<td>{{ $s->prezime }}</td>
<td>{{ $s->status }}</td>
<td>{{ $s->godiste }}</td>
<td>{{ $s->prosjek }}</td>
<td>
<a href="{{ route('students.edit',$s) }}">Uredi</a>
<form method="POST" action="{{ route('students.destroy',$s) }}">
@csrf @method('DELETE')
<button>Obriši</button>
</form>
</td>
</tr>
@endforeach
</table>

@endsection
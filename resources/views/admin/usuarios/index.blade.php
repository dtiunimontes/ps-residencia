@extends('layouts.app')

@section('title', 'Usuários Administradores')
@section('content')

<a href="{{ route('admin.usuarios.create') }}" class="btn bg-green-jungle bg-font-green-jungle">Adicionar novo Administrador</a>
<div class="portlet-body">
	<table class="table table-striped table-bordered table-hover order-column">
		<thead>
			<tr>
				<th> Nome </th>
				<th> CPF </th>
				<th> E-mail </th>
				<th> Ações </th>
			</tr>
		</thead>
		<tbody>
			@foreach($usuarios as $usuario)
			<tr>
				<td>{{ $usuario->nome }}</td>
				<td>{{ $usuario->cpf }}</td>
				<td>{{ $usuario->email }}</td>
				<td>
                    <a href="{{ route('admin.usuarios.destroy', $usuario->id)}}" class="btn red btn-xs" onclick="return confirm('Deseja realmente excluir este administrador?')">Excluir</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection

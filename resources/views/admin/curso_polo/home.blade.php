@extends('layouts.app')

@section('title', 'Relação de Campus, Cursos e Vagas')
@section('content')
@push('scripts')
<script>
	function Confirma(id){
		var resposta = confirm("Tem Certeza de que deseja excluir?");
		if (resposta == true){
			document.forms['excluir'].submit();
		}
	}
</script>
@endpush
<a href="{{ route('admin.curso_polo.create') }}" class="btn bg-green-jungle bg-font-green-jungle">Vincular Curso a um Campus</a>
<div class="portlet-body">
	{{$cursos_polos->links()}}
	<table class="table table-striped table-bordered table-hover order-column" id="polos">
		<thead>
			<tr>
				<th> Código </th>
				<th> Campus </th>
				<th> Curso </th>
				<th> Período </th>
				<th> Vagas </th>
				<th> Turno </th>
				<th> Ações </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cursos_polos as $curso_polo)
			<tr>
				<td>{{$curso_polo->codigo}}</td>
				<td>{{$curso_polo->polo}}</td>
				<td>{{$curso_polo->curso}}</td>
				<td>{{$curso_polo->periodo}}º</td>
				<td>{{$curso_polo->vagas}}</td>
				<td>{{$curso_polo->turno}}</td>
				<td>
					<form class="presenca hidden-print" method="get" action="{{route('admin.curso_polo.show', $curso_polo->codigo)}}" style="float:left;">{{csrf_field()}}<button type="submit" class="btn blue btn-xs" style="margin-top: -1px;">Ver</button></form>
					<form class="presenca hidden-print" method="get" action="{{route('admin.curso_polo.edit', $curso_polo->codigo)}}" style="float:left;">{{csrf_field()}}<button type="submit" class="btn green btn-xs" style="margin-top: -1px;">Editar</button></form>
					<form class="presenca hidden-print" method="post" action="{{route('admin.curso_polo.destroy', $curso_polo->codigo)}}" style="float:left;" id="excluir">{{csrf_field()}}<button type="button" class="btn red btn-xs" onclick="Confirma({{ $curso_polo->codigo }})" style="margin-top: -1px;">Excluir</button></form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$cursos_polos->links()}}
</div>

@endsection

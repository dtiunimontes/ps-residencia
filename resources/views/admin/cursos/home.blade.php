@extends('layouts.app')

@section('title', 'Todos os Cursos')
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
<a href="{{ route('admin.cursos.create') }}" class="btn bg-green-jungle bg-font-green-jungle">Adicionar novo Curso</a>
<div class="portlet-body">
	{{$cursos->links()}}
	<table class="table table-striped table-bordered table-hover order-column" id="cursos">
		<thead>
			<tr>
				<th> ID </th>
				<th> Curso </th>
				<th> Ações </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cursos as $curso)
			<tr>
				<td>{{$curso->id}}</td>
				<td>{{$curso->nome}}</td>
				<td>
					<form class="presenca hidden-print" method="get" action="{{route('admin.cursos.show', $curso->id)}}" style="float:left;">{{csrf_field()}}<button type="submit" class="btn blue btn-xs" style="margin-top: -1px;">Ver</button></form>
					<form class="presenca hidden-print" method="get" action="{{route('admin.cursos.edit', $curso->id)}}" style="float:left;">{{csrf_field()}}<button type="submit" class="btn green btn-xs" style="margin-top: -1px;">Editar</button></form>
					{{-- <form id="excluir" class="presenca hidden-print" method="post" action="{{route('admin.cursos.destroy', $curso->id)}}" style="float:left;">{{csrf_field()}}<button type="button" class="btn red btn-xs" onclick="Confirma({{$curso->id}})" style="margin-top: -1px;">Excluir</button></form> --}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$cursos->links()}}
</div>

@endsection

@extends('layouts.app')

@section('title', 'Todos os Campus')
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
<a href="{{ route('admin.polos.create') }}" class="btn bg-green-jungle bg-font-green-jungle">Adicionar novo Campus</a>
<div class="portlet-body">
	{{$polos->links()}}
	<table class="table table-striped table-bordered table-hover order-column" id="polos">
		<thead>
			<tr>
				<th> ID </th>
				<th> Campus </th>
				<th> Ações </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($polos as $polo)
			<tr>
				<td>{{$polo->id}}</td>
				<td>{{$polo->nome}}</td>
				<td>
					<form class="presenca hidden-print" method="get" action="{{route('admin.polos.show', $polo->id)}}" style="float:left;">{{csrf_field()}}<button type="submit" class="btn blue btn-xs" style="margin-top: -1px;">Ver</button></form>
					<form class="presenca hidden-print" method="get" action="{{route('admin.polos.edit', $polo->id)}}" style="float:left;">{{csrf_field()}}<button type="submit" class="btn green btn-xs" style="margin-top: -1px;">Editar</button></form>
					{{-- <form id="excluir" class="presenca hidden-print" method="post" action="{{route('admin.polos.destroy', $polo->id)}}" style="float:left;">{{csrf_field()}}<button type="button" class="btn red btn-xs" onclick="Confirma({{$polo->id}})" style="margin-top: -1px;">Excluir</button></form> --}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$polos->links()}}
</div>

@endsection

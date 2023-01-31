<x-base title="Contas">	
	@isset($msgSucesso)
	<div class="alert alert-success">
		{{$msgSucesso}}
	</div>
	@endisset
	@isset($msgErro)
	<div class="alert alert-danger">
		{{$msgErro}}
	</div>
	@endisset
	<h1>{{$titulo}}</h1>
	@if(isset($editaConta))
		<x-contas.form :conta="$editaConta" :pessoas="$pessoas"/>
	@else
		<x-contas.form :pessoas="$pessoas"/>
	@endif
	<table class="table-bordered table-reponsive mt-5">
		<thead>
			<tr>
				<th scope="col" style="width:15vw">Nome</th>
				<th scope="col" style="width:12vw">CPF</th>
				<th scope="col" style="width:53vw">Número da Conta</th>
				<th scope="col" style="width:10vw">Editar</th>
				<th scope="col" style="width:10vw">Remover</th>
			</tr>
		</thead>
		<tbody>
		@foreach($contas as $conta)
			<tr>
				<th scope="col">{{$conta->nome}}</th>
				<th scope="col">{{$conta->cpf}}</th>
				<th scope="col">{{$conta->numero}}</th>
				<th scope="col">
					<a href="{{route('contas.edit', $conta->id)}}" class="btn btn-primary btn">
						E
					</a>
				</th>
				<th scope="col">
					<form action="{{route('contas.destroy', $conta->id)}}" method="post"> 
						@csrf
						@method('DELETE')
						<button class="btn btn-danger">
							X
						</button>
					</form>
				</th>
			</tr>
		@endforeach
		</tbody>
	</table>
</x-base>

<x-base title="Pessoas">
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
	@if(isset($editaPessoa))
		<x-pessoas.form :pessoa="$editaPessoa"/>
	@else
		<x-pessoas.form/>
	@endif
	<table class="table-bordered table-reponsive mt-5">
		<thead>
			<tr>
				<th scope="col" style="width:15vw">Nome</th>
				<th scope="col" style="width:12vw">CPF</th>
				<th scope="col" style="width:53vw">Endereço</th>
				<th scope="col" style="width:10vw">Editar</th>
				<th scope="col" style="width:10vw">Remover</th>
			</tr>
		</thead>
		<tbody>
		@foreach($pessoas as $pessoa)
			<tr>
				<th scope="col">{{$pessoa->nome}}</th>
				<th scope="col">{{$pessoa->cpf}}</th>
				<th scope="col">{{$pessoa->endereco}}</th>
				<th scope="col">
					<a href="{{route('pessoas.edit', $pessoa)}}" class="btn btn-primary btn">
						E
					</a>
				</th>
				<th scope="col">
					<form action="{{route('pessoas.destroy', $pessoa->id)}}" method="post"> 
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

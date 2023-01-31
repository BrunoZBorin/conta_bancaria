@if(isset($conta))
	<form action="{{route('contas.update', $conta->id)}}" method="post" >
		@csrf
		@method('PUT')
@else
	<form action="{{route('contas.store')}}" method="post" >
		@csrf
		@method('POST')
@endif
		<div class="mb-3">
				<label class="form-label" for="pessoas">Pessoas</label>
				<select class="form-control" name="pessoa_id">
					<option value="" selected></option>
					@foreach($pessoas as $pessoa)
						<option value="{{$pessoa->id}}">{{$pessoa->nome}} - {{$pessoa->cpf}}</option>
					@endforeach
				</select>
		</div>
		<div class="mb-3">
				<label class="form-label" for="usuario">Número da conta</label>
				<input name="numero" class="form-control" required
						placeholder="Digite o número da conta" id='numero'
						@isset($conta)
							value="{{$conta->numero}}"
						@endisset
						 />
		</div>
		<input class="btn btn-primary" type="submit" value="Cadastrar" />
	</form>

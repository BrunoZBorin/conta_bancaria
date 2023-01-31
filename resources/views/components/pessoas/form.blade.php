@if(isset($pessoa))

	<form action="{{route('pessoas.update', $pessoa)}}" method="post" >
		@csrf
		@method('PUT')
@else
	<form action="{{route('pessoas.store')}}" method="post" >
		@csrf
		@method('POST')
@endif
		
		<div class="mb-3">
				<label class="form-label" for="usuario">Nome</label>
				<input name="nome" class="form-control" required
						placeholder="Digite seu nome" id='nome'
						@isset($pessoa)
							value="{{$pessoa->nome}}"
						@endisset
						 />
		</div>
		<div class="mb-3">
				<label class="form-label" for="usuario">CPF</label>
				<input oninput="mascara(this)" name="cpf" class="form-control" required
						placeholder="Digite seu cpf" id='cpf'
						@isset($pessoa)
							value="{{$pessoa->cpf}}"
						@endisset />
		</div>
		<div class="mb-3">
				<label class="form-label" for="usuario">Endereço</label>
				<input name="endereco" class="form-control" required
						placeholder="Digite seu endereço" id='endereco'
						@isset($pessoa)
							value="{{$pessoa->endereco}}"
						@endisset />
		</div>
		<input class="btn btn-primary" type="submit" value="Cadastrar" />
	</form>

<script>

function mascara(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "14");
   if (v.length == 3 || v.length == 7) 
	 	i.value += ".";
   if (v.length == 11) 
	 	i.value += "-";

}

</script>
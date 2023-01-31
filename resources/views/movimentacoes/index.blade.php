<x-base title="Contas">
	<h1>Movimentação de Conta</h1>	
	<form action="{{route('movimentacoes.store')}}" method="post" >
		@csrf
		@method('POST')
		<div class="mb-3">
			<label class="form-label" for="pessoas" onchange="getContas(this)">Pessoas</label>
			<select class="form-control" id="pessoa_id" name="pessoa_id">
			<option value="" selected></option>
				@foreach($pessoas as $pessoa)
					<option value="{{$pessoa->id}}">{{$pessoa->nome}} - {{$pessoa->cpf}}</option>
				@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label class="form-label" for="contas">Conta</label>
			<select class="form-control" name="conta_id" id="conta_id">
				<option value="" selected></option>
			</select>
		</div>
		<div class="mb-3">
				<label class="form-label" for="valor">Valor</label>
				<input name="valor" class="form-control" required
						placeholder="Digite o valor" id='numero'
						 />
		</div>
		<div class="mb-3">
			<label class="form-label" for="operacao">Depositar/Retirar</label>
			<select class="form-control" name="operacao">
					<option value=1>Depositar</option>
					<option value=-1>Retirar</option>
			</select>
		</div>
		<input class="btn btn-primary" type="submit" value="Salvar" />
	</form>
</x-base>

<script>
	function getContas(elemento)
	{
		var pessoaId = elemento.value;
		console.log(pessoaId)
	}

	document.getElementById("pessoa_id").addEventListener("change", function(){
    var pessoa_id = this.value;
		var arrayConta = <?php echo $contas; ?>;	
    var conta_id = document.getElementById("conta_id");
		conta_id.innerHTML = "";
		for (var i = 0; i < arrayConta.length; i++) {
			console.log(arrayConta[i]['pessoa_id'])
			console.log(pessoa_id)
			if(arrayConta[i]['pessoa_id']==pessoa_id)
			{
				var option = document.createElement("option");
				option.value = arrayConta[i]['id'];
				option.text = arrayConta[i]['numero'] +" - "+arrayConta[i]['saldo'];
				conta_id.appendChild(option);
			}
		}
  
  });
</script>
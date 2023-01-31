<x-base title="Pessoas">
<form action="/pessoas/salvar" method="post" >
	@csrf
	<h2>Cadastro de Pessoa</h3>
	<div class="mb-3">
			<label class="form-label" for="usuario">Nome</label>
			<input name="nome" class="form-control" required
					placeholder="Digite seu nome" id='nome' />
	</div>
	<div class="mb-3">
			<label class="form-label" for="usuario">CPF</label>
			<input oninput="mascara(this)" name="cpf" class="form-control" required
					placeholder="Digite seu cpf" id='cpf' />
	</div>
	<div class="mb-3">
			<label class="form-label" for="usuario">Endereço</label>
			<input name="endereco" class="form-control" required
					placeholder="Digite seu endereço" id='endereco' />
	</div>
	<input class="btn btn-primary" type="submit" value="Cadastrar" />
</form>
</x-base>
<script>

function mascara(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "14");
   if (v.length == 3 || v.length == 7) i.value += ".";
   if (v.length == 11) i.value += "-";

}

</script>
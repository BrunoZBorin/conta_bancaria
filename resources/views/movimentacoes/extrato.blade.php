<x-base title="Contas">
	@isset($msg)
		<div class="alert alert-danger">
			{{$msg}}
		</div>
	@endif
	<div>
		<h1>Extrato de Contas</h1>	
		<table class="table-bordered table-reponsive mt-5">
		<thead>
			<tr>
				<th scope="col" style="width:15vw">Data</th>
				<th scope="col" style="width:12vw">Valor</th>
			</tr>
		</thead>
		<tbody>
		@foreach($movimentacoes as $mov)
			<tr>
				<th scope="col">{{$mov->created_at}}</th>
				<th scope="col">{{$mov->valor}}</th>
			</tr>
		@endforeach
		</tbody>
	</table>
	<div>Saldo R${{$saldo}}</div>
	</div>
</x-base>

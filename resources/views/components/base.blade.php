<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>{{$title}}</title>
    </head>
    <body class="m-5" >
			@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<header>
				<div id="navbarNav">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link" href="/pessoas">Pessoa</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/contas">Conta</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/movimentacoes">Movimentação</a>
						</li>
					</ul>
				</div>	
			</header>
        {{$slot}}
    </body>
</html>

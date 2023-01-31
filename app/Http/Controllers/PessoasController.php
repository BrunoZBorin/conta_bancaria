<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pessoa;

use App\Http\Requests\PessoasFormRequest;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pessoas = Pessoa::query()->orderBy('nome')->get();
        $msgSucesso = $request->session()->get('mensagem.sucesso');
        $msgErro = $request->session()->get('mensagem.erro');
        $titulo = "Cadastro de Pessoas";
        return view('pessoas.index', ['pessoas' => $pessoas])->with(['msgSucesso'=> $msgSucesso,'msgErro'=> $msgErro, 'titulo'=> $titulo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pessoas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoasFormRequest $request)
    {
        
        if(filter_var($request->nome, FILTER_SANITIZE_NUMBER_INT) !== '' || !ctype_upper($request->nome[0]) )
        {
            $request->session()->flash('mensagem.erro', "Não é permitido números e a primeira letra deve ser maiúscula");
            return redirect('pessoas');
        }
        $pessoa = new Pessoa();
        $pessoa->nome = $request->nome;
        $pessoa->cpf = $request->cpf;
        $pessoa->endereco = $request->endereco;
        $pessoa->save();
        $request->session()->flash('mensagem.sucesso', "Pessoa adicionada com sucesso!");
        return redirect('pessoas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pessoa $pessoa)
    {
        $pessoas = Pessoa::query()->orderBy('nome')->get();
        $titulo = "Editar";
        return view('pessoas.index', ['pessoas' => $pessoas, 'editaPessoa'=> $pessoa])->with('titulo', $titulo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoasFormRequest $request, Pessoa $pessoa)
    {
        if(filter_var($request->nome, FILTER_SANITIZE_NUMBER_INT) !== '' || !ctype_upper($request->nome[0]) )
        {
            $request->session()->flash('mensagem.erro', "Não é permitido números e a primeira letra deve ser maiúscula");
            return redirect('pessoas');
        }
        $pessoa->nome = $request->nome;
        $pessoa->cpf = $request->cpf;
        $pessoa->endereco = $request->endereco;
        $pessoa->save();
        $pessoas = Pessoa::query()->orderBy('nome')->get();
        return view('pessoas.index', ['pessoas' => $pessoas])->with(['mensagem.sucesso'=> "Pessoa editada com sucesso!",'titulo'=> "Cadastro de Pessoas"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Pessoa::destroy($request->id);
        $request->session()->flash('mensagem.sucesso', "Pessoa removida com sucesso!");
        return redirect('pessoas');
    }
}

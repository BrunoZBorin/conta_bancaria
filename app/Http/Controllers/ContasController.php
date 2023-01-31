<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContasFormRequest;

use App\Models\Conta;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class ContasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contas = $this->listaContasComPessoa();
        $pessoas = Pessoa::all();
        $msgSucesso = $request->session()->get('mensagem.sucesso');
        $msgErro = $request->session()->get('mensagem.erro');
        $titulo = "Cadastro de Contas";
        return view('contas.index', ['contas' => $contas,'pessoas' => $pessoas])->with(['msgSucesso'=> $msgSucesso,'msgErro'=> $msgErro, 'titulo'=> $titulo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContasFormRequest $request)
    {
        if(!ctype_digit($request->numero))
        {
            $request->session()->flash('mensagem.erro', "Não é permitido caracteres que não sejam números");
            return redirect('contas');
        }
        $conta = new Conta();
        $conta->numero = $request->numero;
        $conta->pessoa_id = $request->pessoa_id;
        $conta->saldo = 0;
        $conta->save();
        $request->session()->flash('mensagem.sucesso', "Conta adicionada com sucesso!");
        return redirect('contas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conta = DB::table('contas')
        ->leftJoin('pessoas', 'pessoas.id', '=', 'contas.pessoa_id')
        ->select('contas.*', 'pessoas.nome', 'pessoas.cpf')
        ->where('contas.id', '=', $id)
        ->get()->first();
        $contas = $this->listaContasComPessoa();
        $pessoas = Pessoa::all();
        $titulo = "Editar";
        return view('contas.index', ['contas' => $contas, 'editaConta'=> $conta, 'pessoas'=>$pessoas])->with('titulo', $titulo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContasFormRequest $request, Conta $conta)
    {
        if(!ctype_digit($request->numero))
        {
            $request->session()->flash('mensagem.erro', "Não é permitido caracteres que não sejam números");
            return redirect('contas');
        }
        $conta->numero = $request->numero;
        $conta->pessoa_id = $request->pessoa_id;
        $conta->save();
        $contas = $this->listaContasComPessoa();
        $pessoas = Pessoa::all();
        return view('contas.index', ['contas' => $contas, 'pessoas'=>$pessoas])->with(['mensagem.sucesso'=> "Conta editada com sucesso!",'titulo'=> "Cadastro de Contas"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Conta::destroy($id);
        $request->session()->flash('mensagem.sucesso', "Conta removida com sucesso!");
        return redirect('contas');
    }

    public function listaContasComPessoa()
    {
        $contas = DB::table('contas')
        ->leftJoin('pessoas', 'pessoas.id', '=', 'contas.pessoa_id')
        ->select('contas.*', 'pessoas.nome', 'pessoas.cpf')
        ->get()->all();

        return $contas;
    }
}

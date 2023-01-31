<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Conta;
use App\Models\Pessoa;
use App\Models\Movimentacao;
use Illuminate\Support\Facades\DB;

class MovimentacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $movimentacoes = $this->listaMovContasComPessoa();
        $pessoas = Pessoa::all();
        $contas = Conta::all();
        $msgSucesso = $request->session()->get('mensagem.sucesso');
        $titulo = "Cadastro de Movimentações";
        return view('movimentacoes.index', ['pessoas' => $pessoas, 'contas' => $contas])->with(['msgSucesso'=> $msgSucesso, 'titulo'=> $titulo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movimentacoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movimentacao = new Movimentacao();
        $movimentacao->valor = $request->valor * $request->operacao;
        $movimentacao->pessoa_id = $request->pessoa_id;
        $movimentacao->conta_id = $request->conta_id;
        $conta = $this->atualizaSaldo($movimentacao->conta_id, $movimentacao->valor);
        if($conta->aprovado == "NAO")
        {
            $movimentacoes = DB::table('movimentacoes')
            ->select('*')
            ->where('movimentacoes.pessoa_id', '=', $movimentacao->pessoa_id)
            ->where('movimentacoes.conta_id', '=', $movimentacao->conta_id)
            ->get()->all();

            return view('movimentacoes.extrato', ['saldo' => $conta->saldo, 'movimentacoes' => $movimentacoes, 'msg' =>"Saldo insuficiente!"]);
        }
        $movimentacao->save();
        $movimentacoes = DB::table('movimentacoes')
            ->select('*')
            ->where('movimentacoes.pessoa_id', '=', $movimentacao->pessoa_id)
            ->where('movimentacoes.conta_id', '=', $movimentacao->conta_id)
            ->get()->all();

        
        return view('movimentacoes.extrato', ['saldo' => $conta->saldo, 'movimentacoes' => $movimentacoes]);
    }

    public function atualizaSaldo($id, $valor)
    {
        $conta = Conta::find($id);
        
        if($valor + $conta->saldo<0)
        {
            $conta->aprovado = "NAO";
            return $conta;
        }
        $conta->saldo = $valor + $conta->saldo;
        $conta->save();
        $conta->aprovado = "SIM";
        return $conta;
    }
}

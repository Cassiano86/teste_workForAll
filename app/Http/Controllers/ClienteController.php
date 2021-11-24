<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Estados;
use App\Models\Categorias;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('welcome',['clientes' => Clientes::paginate(10)]);        
    }

    public function administrativo(){
        return view('Clientes.index',['clientes' => Clientes::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Clientes.adicionar',['categorias' => Categorias::all(), 'estados' => Estados::orderBy('nome')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
                    'nome'  => 'required',
                    'tipo'  => 'required',
                    'contato' => 'required|regex:/^[0-9]+$/|max:15|unique:clientes,contato',
                    'nascimento' => 'required|date',
                    'estado'  => 'required',
                    'categoria' => 'required',
                  ];

        $feedback = [
                        'required' => 'O preenchimento deste campo é obrigatório',
                        'contato.regex' => 'Utilizar apenas números',
                        'contato.max' => 'Número de telefone muito extenso',
                        'contato.unique' => 'Contato já registrado',
                        'nascimento.date' => 'Data inválida'
                    ];

        $validator = Validator::Make($request->all(), $regras, $feedback);

        if($validator->fails()){
            parent::flashSuccess("Erro", "Erro ao cadastrar novo cliente", "error", false, 1500);
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Clientes::create([
                            'nome'          => $request->get('nome'),
                            'tipo'          => $request->get('tipo') == 'Física' ? 'Física' : 'Jurídica',
                            'contato'       => $request->get('contato'),
                            'nascimento'    => $request->get('nascimento'),
                            'estados_fk'    => $request->get('estado'),
                            'categoria_fk'  => $request->get('categoria'),
                        ]);

        parent::flashSuccess("Sucesso", "Cliente Cadastrado com sucesso", "success", false, 1500);
        return redirect()->route('cliente.administrativo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Clientes.clienteSelecionado' ,['cliente' => CLientes::find($id)] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Clientes.editar',[
                                            'categorias' => Categorias::all(),
                                            'estados' => Estados::orderBy('nome')->get(),
                                            'cliente' => Clientes::find($id) 
                                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $regras = [
                    'nome'  => 'required',
                    'tipo'  => 'required',
                    'contato' => 'required|regex:/^[0-9]+$/|max:15|unique:clientes,contato,'.$id,
                    'nascimento' => 'required|date',
                    'estado'  => 'required',
                    'categoria' => 'required',
                ];

        $feedback = [
                        'required' => 'O preenchimento deste campo é obrigatório',
                        'contato.regex' => 'Utilizar apenas números',
                        'contato.max' => 'Número de telefone muito extenso',
                        'contato.unique' => 'Contato já registrado',
                        'nascimento.date' => 'Data inválida'
                    ];

        $validator = Validator::Make($request->all(), $regras, $feedback);

        if($validator->fails()){
            parent::flashSuccess("Erro", "Erro ao cadastrar novo cliente", "error", false, 1500);
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Clientes::find($id)
                ->update([
                        'nome'          => $request->get('nome'),
                        'tipo'          => $request->get('tipo') == 'Física' ? 'Física' : 'Jurídica',
                        'contato'       => $request->get('contato'),
                        'nascimento'    => $request->get('nascimento'),
                        'estados_fk'    => $request->get('estado'),
                        'categoria_fk'  => $request->get('categoria'),
                ]);

        parent::flashSuccess("Sucesso", "Dados atualizados com sucesso", "success", false, 1500);
        return redirect()->route('cliente.administrativo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Clientes::find($id)->delete();
        parent::flashSuccess("Sucesso", "Cliente deletado com sucesso", "success", false, 1500);
        return redirect()->route('cliente.administrativo');
    }

    public function search(Request $request){
        $relacao = DB::table('clientes')
                    ->join('categorias','categorias.id','=','clientes.categoria_fk')
                    ->join('estados','estados.id','=','clientes.estados_fk')
                    ->where('clientes.nome','like','%'.$request->get('busca').'%')
                    ->orWhere('estados.nome','like','%'.$request->get('busca').'%')
                    ->orWhere('categorias.nome','like','%'.$request->get('busca').'%')
                    ->select(
                                'clientes.id',
                                'clientes.nome as nome_cliente',
                                'estados.nome as nome_estado',
                                'categorias.nome as nome_categoria',
                            )
                    ->limit(10)
                    ->get();

        $relacao_total = DB::table('clientes')
                        ->join('categorias','categorias.id','=','clientes.categoria_fk')
                        ->join('estados','estados.id','=','clientes.estados_fk')
                        ->where('clientes.nome','like','%'.$request->get('busca').'%')
                        ->orWhere('estados.nome','like','%'.$request->get('busca').'%')
                        ->orWhere('categorias.nome','like','%'.$request->get('busca').'%')
                        ->count();
        
        if(!empty($relacao)){
            return response()->json(['success' => 1,
                                     'dados' => $relacao,
                                     'total_tabela' => ceil($relacao_total / 10)
                                    ]);
        }else{
            return response()->json(['success' => 0]);
        }
    }
}

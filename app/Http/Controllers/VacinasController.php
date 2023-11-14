<?php

namespace App\Http\Controllers;

use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacinasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {

        $listagem = Vacina::orderBy("name");

        if (isset($request->search)){
            $listagem->where("nome","like","%$request->search%");
        }

        $listagem = $listagem->paginate(10);

        return view('vacinas.list', ["listagem"=>$listagem]);
    }

    protected function validator(array $data){

        $rules = [
            'nome'           => ['required', 'string', 'max:255'],
            'validade_meses' => ['required','integer'],
        ];

        return Validator::make($data, $rules);
    }

    public function new(){
        $vacina = new Vacina();
        return view('vacinas.form', ["data"=>$vacina]);
    }

    public function edit(Vacina $vacina){
        return view('vacinas.form', ["data"=>$vacina]);
    }

    public function salvar(Request $request){
        $validated = $this->validator($request->all())->validate();
        $vacina = Vacina::create($validated);
        return redirect()->route("vacinas-edit",$vacina)->with("success","Salvo com sucesso");
    }

    public function update(Vacina $vacina, Request $request){
        $validated = $this->validator($request->all())->validate();
        $vacina->update($validated);
        return redirect()->back()->with("success","Atualizações salvas");
    }

    public function delete(Vacina $vacina){
        $vacina->delete();
        return redirect()->route('vacinas')->with("warning","Registro deletado");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Vacina;
use App\Models\Vacinacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VacinacoesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    protected function validator(array $data){

        $rules = [
            'data'              => ['required','date'],
            'vacina_id'         => ['required','exists:vacinas,id'],
            'pet_id'            => ['required','exists:pets,id'],
            'veterinario_id'    => ['required','exists:users,id'],
        ];

        return Validator::make($data, $rules);
    }

    public function salvar(Pet $pet, Request $request){

        $data = $request->all();
        $data["pet_id"]         = $pet->id;
        #pega quem está logado
        $data["veterinario_id"] = Auth::user()->id;

        $validated = $this->validator($data)->validate();

        $vacina = Vacina::find($data['vacina_id']);
        
        #calcula a validade
        $validated["validade"] = (new Carbon($validated["data"]))->addMonths($vacina->validade_meses);

        Vacinacao::create($validated);
        return redirect()->back()->with("success","Salvo com sucesso");
    }

    public function delete(Vacinacao $vacinacao){
        $vacinacao->delete();
        return redirect()->back()->with("warning","Registro deletado");
    }
}

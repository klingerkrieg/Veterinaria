<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PetsController extends Controller
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

        $listagem = Pet::orderBy("name");

        if (isset($request->search)){
            $listagem->where("nome","like","%$request->search%");
            #cpf do dono
            #$listagem->orWhere("cpf","like","%$request->search%");
            #$listagem->orWhere("email","like","%$request->search%");
        }

        $listagem = $listagem->paginate(10);
        $especies = Pet::$especies;

        return view('pets.list', ["listagem"=>$listagem, "especies"=>$especies]);
    }

    protected function validator(array $data){

        $rules = [
            'nome'          => ['required', 'string', 'max:255'],
            'especie_id'    => ['required'],
            'nascimento'    => ['required','date_format:d/m/Y'],
            'dono_id'       => ['required','exists:users,id'],
            'foto'          => ['image','max:1024']
        ];

        return Validator::make($data, $rules);
    }

    public function new(User $user = null){
        $donos = User::all();
        $especies = Pet::$especies;

        $pet = new Pet();
        if ($user)
            $pet->dono_id = $user->id;

        return view('pets.form', ["data"=>$pet, "especies"=>$especies, "donos"=>$donos]);
    }

    public function edit(Pet $pet){
        $donos = User::all();
        $especies = Pet::$especies;
        return view('pets.form', ["data"=>$pet, "especies"=>$especies, "donos"=>$donos]);
    }

    private function armazenaImagem(Request $request, $data){
        #SALVA A IMAGEM NA PASTA
        if ($request->file('foto') != null){
            #o nome da pasta nao pode ser o mesmo nome de uma rota (pets)
            $path = $request->file('foto')->store("pets_fotos","public");
            #nao pode setar o photo do $request, pois nao irá funcionar
            $data["foto"] = $path;
        }
        return $data;
    }


    public function salvar(Request $request){
        $validated = $this->validator($request->all(), null)->validate();
        $validated = $this->armazenaImagem($request, $validated);
        $pet = Pet::create($validated);
        return redirect()->route("pets-edit",$pet)->with("success","Salvo com sucesso");
    }

    public function update(Pet $pet, Request $request){
        $validated = $this->validator($request->all())->validate();
        $validated = $this->armazenaImagem($request, $validated);
        $pet->update($validated);
        return redirect()->back()->with("success","Atualizações salvas");
    }

    public function delete(Pet $pet){
        $pet->delete();
        return redirect()->route('pets')->with("warning","Registro deletado");
    }
}

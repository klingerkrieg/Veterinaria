<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
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

        $listagem = User::orderBy("name");

        if (isset($request->search)){
            $listagem->where("name","like","%$request->search%");
            $listagem->orWhere("cpf","like","%$request->search%");
            $listagem->orWhere("email","like","%$request->search%");
        }

        $listagem = $listagem->paginate(10);
        $tipos = User::$tipos;

        return view('usuarios.list', ["listagem"=>$listagem, "tipos"=>$tipos]);
    }

    protected function validator(array $data, $user){

        if ($user){
            $myEmail = $user->email;
        } else {
            $myEmail = null;
        }
        

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required'],
            'tipo' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 
                Rule::unique('users','email')->where(function ($query) use ($myEmail) {
                    if ($myEmail){
                        return $query->whereNot("email",$myEmail);
                    } else {
                        return $query;
                    }
                })],
        ];

        #requerido apenas se for enviado
        if ($user == null
            || isset($data["password"]) && $data["password"] != "" 
            || isset($data["password_confirm"]) && $data["password_confirm"] != ""){
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        return Validator::make($data, $rules);
    }

    public function new(){
        $tipos = User::$tipos;
        return view('usuarios.form', ["data"=>new User(), "tipos"=>$tipos]);
    }

    public function edit(User $user){
        $tipos = User::$tipos;
        $especies = Pet::$especies;
        return view('usuarios.form', ["data"=>$user, "tipos"=>$tipos, "especies"=>$especies]);
    }

    public function salvar(Request $request){
        $validated = $this->validator($request->all(), null)->validate();
        $user = User::create($validated);
        return redirect()->route("usuarios-edit",$user)->with("success","Salvo com sucesso");
    }

    public function update(User $user, Request $request){
        $validated = $this->validator($request->all(), $user)->validate();
        $user->update($validated);
        return redirect()->back()->with("success","Atualizações salvas");
    }

    public function delete(User $user){
        $user->delete();
        return redirect()->route('usuarios')->with("warning","Registro deletado");
    }
}

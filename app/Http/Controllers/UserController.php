<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Mail\UserActivation;
use App\Models\State;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Traits\SEO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    use SEO;

    private $policyName = 'users';
    private $HeaderTitle = "<span class='fas fa-users fa-lg'></span> Usuarios";


    public function index(){
        try {

            $this->authorize($this->policyName, User::class);
            $this->setSeo('Usuarios - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['searchRoute'] = 'users.search';
            $data['searchProps'] = 'Nombre, Rol';
            if(Auth::user()->isSu()){
                $data['users'] = User::orderBy('id','desc')->with('rol')->paginate($this->config['itemsPerPage']);
            }else{
                $data['users'] = User::where('is_su', '<>', 1)->orderBy('id','desc')->with('rol')->paginate($this->config['itemsPerPage']);
            }
            return view('pignu.users.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function search(Request $request){
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Resultado de usuarios - Pignu');
            $query = $request->t ? : '';
            $data['headerTitle'] = $this->HeaderTitle;
            $data['searchRoute'] = 'users.search';
            $data['searchProps'] = 'Nombre, Rol';
            $data['searchQuery'] = $query;
            if(Auth::user()->isSu()){
                $data['users'] = User::search(['name', 'rol.name'], $query)->paginate($this->config['itemsPerPage']);
            }else{
                $data['users'] = User::search(['name', 'rol.name'], $query)->where('id', '<>', 1)->paginate($this->config['itemsPerPage']);
            }
            $data['users']->appends(['t' => $query]);
            return view('pignu.users.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function create(){
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Crear usuario - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['roles'] = Role::pluck('name','id');
            $data['states'] = State::pluck('name','id');
            return view('pignu.users.create',$data);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function store(UserRequest $request) {
        try {
            $this->authorize($this->policyName, User::class);
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->rol_id = $request->rol_id;
            $user->password = bcrypt($request->password);
            if ($request->avatar){
                $user->avatar = uniqid().'.jpg';
                $img = Image::make($request->avatar);
                $img->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->crop(250, 250)->save('images/usuarios/'.$user->avatar);
            }
            $user->created_by = Auth::user()->id;
            $user->save();
            return redirect()->route('users.index')->with('message', 'Usuario creado con éxito');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function edit($id)
    {
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Editar usuario - Pignu');
            $data['user'] = User::findOrFail($id);
            $data['headerTitle'] = $this->HeaderTitle;
            $data['roles'] = Role::pluck('name','id');
            $data['states'] = State::pluck('name','id');
            return view('pignu.users.edit',$data);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function update(UserEditRequest $request, $id) {
        try {
            $this->authorize($this->policyName, User::class);
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->rol_id = $request->rol_id;
            if(!empty($request->password) and !empty($request->password_confirmation)){
                $user->password = bcrypt($request->password);
            }
            if ($request->avatar){
                $user->avatar = uniqid().'.jpg';
                $img = Image::make($request->avatar);
                $img->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->crop(250, 250)->save('images/usuarios/'.$user->avatar);
            }
            $user->save();
            return redirect()->route('users.index')->with('message', 'Usuario actualizado con éxito');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function destroy($id){
        try {
            $this->authorize($this->policyName, User::class);
            User::findOrFail($id)->delete();
            return redirect()->route('users.index')->with('message', 'Usuario eliminado :(');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function profile(){
        try {
            $this->setSeo('Mi perfil - Pignu');
            $data['headerTitle'] = "<span class='fas fa-user fa-lg'></span> Mi perfil";
            $data['user'] = User::findOrFail(\auth()->id());
            return view('pignu.users.profile', $data);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function activate($user_id, $action){
        try {
            $user = User::findOrFail($user_id);
            if($action == 'yes'){
                $user->active = 1;
                Mail::to($user->email)->send(new UserActivation());
            }else{
                $user->active = null;
            }
            $user->save();
            return redirect()->route('users.index')->with('message', 'Estaus del usuario actualizado con éxito');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function updateProfile(ProfileRequest $request) {
        try {
            $this->authorize($this->policyName, User::class);
            $user = User::findOrFail(\auth()->id());
            $user->name = $request->name;
            if(!empty($request->password) and !empty($request->password_confirmation)){
                $user->password = bcrypt($request->password);
            }
            if ($request->avatar){
                $user->avatar = uniqid().'.jpg';
                $img = Image::make($request->avatar);
                $img->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->crop(250, 250)->save('images/usuarios/' . $user->avatar);
            }
            $user->save();
            return redirect()->route('profile.index')->with('message', 'Perfil actualizado con éxito');
        } catch (\Exception $e) {
            return redirect()->route('profile.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

}

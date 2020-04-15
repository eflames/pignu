<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Traits\SEO;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    use SEO;

    private $policyName = 'users';
    private $HeaderTitle = "<span class='fas fa-lock fa-lg'></span> Roles de usuario";

    public function index(){
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Roles de usuario - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['searchRoute'] = 'roles.search';
            $data['searchProps'] = 'Nombre del rol';
            $data['roles'] = Role::orderBy('id', 'desc')->paginate($this->config['itemsPerPage']);
            return view('pignu.roles.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function search(Request $request){
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Resultado de roles - Pignu');
            $query = $request->t ? : '';
            $data['headerTitle'] = $this->HeaderTitle;
            $data['searchRoute'] = 'roles.search';
            $data['searchProps'] = 'Nombre del rol';
            $data['searchQuery'] = $query;
            $data['roles'] = Role::search(['name'], $query)->paginate($this->config['itemsPerPage']);
            $data['roles']->appends(['t' => $query]);
            return view('pignu.roles.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function create(){
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Roles de usuario - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            return view('pignu.roles.create',$data);
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function store(RoleRequest $request)
    {
        try {
            $this->authorize($this->policyName, User::class);
            $config = new Role();
            $config->fill($request->all());
            $config->created_by = Auth::user()->id;
            $config->save();
            return redirect()->route('roles.index')->with('message', 'Rol creado con éxito');
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function edit($id){
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Editar rol de usuario - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['role'] = Role::findOrFail($id);
            return view('pignu.roles.edit', $data);
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function update(RoleRequest $request, $id)
    {
        try {
            $this->authorize($this->policyName, User::class);
            $config = Role::findOrFail($id);
            $config->name = $request->name;
            $config->admin = $request->admin;
            $config->p_users = $request->p_users;
            $config->p_configs = $request->p_configs;
            $config->p_products = $request->p_products;
            $config->p_blog = $request->p_blog;
            $config->p_pages = $request->p_pages;
            $config->p_galleries = $request->p_galleries;
            $config->p_categories = $request->p_categories;
            $config->p_log = $request->p_log;
            $config->save();
            return redirect()->route('roles.index')->with('message', 'Rol actualizado con éxito');
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function destroy($id){
        try {
            $this->authorize($this->policyName, User::class);
            Role::findOrFail($id)->delete();
            return redirect()->route('roles.index')->with('message', 'Rol eliminado :(');
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

}

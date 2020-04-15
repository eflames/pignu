<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigRequest;
use App\Models\Config;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\SEO;

class VariableController extends Controller
{
    use SEO;

    private $policyName = 'configs';
    private $HeaderTitle = "<span class='fas fa-cogs fa-lg'></span> Variables de configuración";

    public function index(){
        try{
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Variables de configuración');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['searchRoute'] = 'variables.search';
            $data['searchProps'] = 'Clave, Valor, Descripción';
            $data['configs'] = Config::paginate($this->config['itemsPerPage']);
            return view('pignu.variables.list', $data);
        }catch (\Exception $e){
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function search(Request $request){
        try{
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Variables de configuración');
            $query = $request->t ? : '';
            $data['headerTitle'] = $this->HeaderTitle;
            $data['searchRoute'] = 'variables.search';
            $data['searchProps'] = 'Clave, Valor, Descripción';
            $data['configs'] = Config::search(['key', 'value', 'description'], $query)->paginate($this->config['itemsPerPage']);
            $data['configs']->appends(['t' => $query]);
            $data['searchQuery'] = $query;
            return view('pignu.variables.list', $data);
        }catch (\Exception $e){
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function create(){
        try{
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Crear variable');
            $data['headerTitle'] = $this->HeaderTitle;
            return view('pignu.variables.create', $data);
        }catch (\Exception $e){
            return redirect()->route('variables.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function store(ConfigRequest $request)
    {
        try{
            $this->authorize($this->policyName, User::class);
            $config = new Config();
            $config->fill($request->all());
            $config->created_by = Auth::user()->id;
            $config->save();
            return redirect()->route('variables.index')->with('message', 'Variable guardada con éxito');
        }
        catch (\Exception $e){
            return redirect()->route('variables.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function edit($id){
        try{
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Editar variable');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['config'] = Config::findOrFail($id);
            return view('pignu.variables.edit',$data);
        }catch (\Exception $e){
            return redirect()->route('variables.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function update(ConfigRequest $request, $id)
    {
        try{
            $this->authorize($this->policyName, User::class);
            $config = Config::findOrFail($id);
            $config->fill($request->all());
            $config->created_by = Auth::user()->id;
            $config->save();
            return redirect()->route('variables.index')->with('message', 'Variable guardada con éxito');
        }catch (\Exception $e){
            return redirect()->route('variables.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function destroy($id){
        try{
            $this->authorize($this->policyName, User::class);
            Config::findOrFail($id)->delete();
            return redirect()->route('variables.index')->with('message', 'Variable eliminada :(');
        }catch (\Exception $e){
            return redirect()->route('variables.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }
}

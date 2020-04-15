<?php

namespace App\Http\Controllers;

use App\Http\Requests\PluginRequest;
use App\Models\Plugin;
use App\User;
use Illuminate\Http\Request;
use App\Traits\SEO;
use Illuminate\Support\Facades\Auth;

class PluginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use SEO;

    private $policyName = 'configs';
    private $HeaderTitle = "<span class='fas fa-code fa-lg'></span> Plugins del sistema";

    public function index(){
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Plugins - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['plugins'] = Plugin::orderBy('id','desc')->paginate($this->config['itemsPerPage']);
            return view('pignu.plugins.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Lista de plugins - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            return view('pignu.plugins.create', $data);
        } catch (\Exception $e) {
            return redirect()->route('plugins.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PluginRequest $request)
    {
        try{
            $this->authorize($this->policyName, User::class);
            $plugin = new Plugin();
            $plugin->fill($request->all());
            $plugin->created_by = Auth::user()->id;
            $plugin->save();
            return redirect()->route('plugins.index')->with('message', 'Plugin instalado con éxito');
        }
        catch (\Exception $e){
            return redirect()->route('plugins.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plugin  $plugin
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try{
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Editar plugin - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['plugin'] = Plugin::findOrFail($id);
            return view('pignu.plugins.edit',$data);
        }catch (\Exception $e){
            return redirect()->route('plugins.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plugin  $plugin
     * @return \Illuminate\Http\Response
     */
    public function update($id, PluginRequest $request)
    {
        try{
            $this->authorize($this->policyName, User::class);
            $plugin = Plugin::findOrFail($id);
            $plugin->fill($request->all());
            $plugin->status = $request->status;
            $plugin->save();
            return redirect()->route('plugins.index')->with('message', 'Plugin actualizado con éxito');
        }
        catch (\Exception $e){
            return redirect()->route('plugins.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plugin  $plugin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            Plugin::findOrFail($id)->delete();
            return redirect()->route('plugins.index')->with('message', 'Plugin eliminado :(');
        }
        catch (\Exception $e)
        {
            return redirect()->route('plugins.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function changeActive($id, $action = null)
    {
        try
        {
            $plugin = Plugin::findOrFail($id);
            if($action){
                $plugin->status = true;
                $message = 'El plugin ahora está activado';
            }else{
                $plugin->status = false;
                $message = 'El plugin se ha desactivado exitósamente.';
            }
            $plugin->save();
            return redirect()->route('plugins.index')->with('message', $message);
        }
        catch (\Exception $e)
        {
            return redirect()->route('plugins.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }
}

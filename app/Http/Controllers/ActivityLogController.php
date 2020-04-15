<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Traits\SEO;
use Illuminate\Support\Facades\Artisan;

class ActivityLogController extends Controller
{

    use SEO;

    public function activityLog(){
        try{
            $this->authorize('log', User::class);
            $data['searchRoute'] = 'activity-log.search';
            $data['searchProps'] = 'Evento, Modelo, Usuario';
            $this->setSeo('Registro de actividad - Pignu');
            $data['headerTitle'] = "<span class='fas fa-fingerprint fa-lg'></span> Registro de actividad";
            $data['logs'] = Activity::orderBy('id', 'desc')->paginate($this->config['itemsPerPage']);
            return view('pignu.activity-log.list', $data);
        }catch(\Exception $e){
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function activityLogDetail($id){
        try{
            $this->authorize('log', User::class);
            $this->setSeo('Detalle de actividad - Pignu');
            $data['headerTitle'] = "<span class='fas fa-fingerprint fa-lg'></span> Registro de actividad";
            $data['log'] = Activity::findOrFail($id);
            $data['old_data'] = @$data['log']->changes['old'];
            $data['new_data'] = @$data['log']->changes['attributes'];
            return view('pignu.activity-log.detail', $data);
        }catch(\Exception $e){
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function activityLogSearch(Request $request){
        try{
            $this->authorize('log', User::class);
            $data['headerTitle'] = "<span class='fas fa-fingerprint fa-lg'></span> Registro de actividad";
            $query = $request->t ? : '';
            $data['searchRoute'] = 'activity-log.search';
            $data['searchProps'] = 'Evento, Modelo, Usuario';
            $data['searchQuery'] = $query;
            $data['logs'] = Activity::search(['description', 'subject_type', 'userCauser.name'], $query)->paginate($this->config['itemsPerPage']);
            $data['logs']->appends(['t' => $query]);
            return view('pignu.activity-log.list', $data);
        }catch(\Exception $e){
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function activityLogCleanUp(){
        try{
            $this->authorize('log', User::class);
            Artisan::call('activitylog:clean');
            return redirect()->route('activity-log')->with('message', 'Limpieza del registro de actividad ejecutado exitosamente.');
        }catch(\Exception $e){
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }
}

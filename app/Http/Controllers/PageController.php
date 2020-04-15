<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\User;
use App\Traits\SEO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    use SEO;

    public function index(){
        try {
            $this->authorize('pages', User::class);
            $this->setSeo('Páginas - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-file'></span> Páginas <b><span class='fa fa-arrow-right text-gray'></span> Lista</b>";
            $data['searchRoute'] = 'pages.search';
            $data['searchTitle'] = 'Título de la página';
            $data['pages'] = Page::orderBy('id','desc')->paginate($this->config['itemsPerPage']);
            return view('teraadmin.pages.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function search(Request $request){
        try {
            $this->authorize('pages', User::class);
            $this->setSeo('Páginas - TeraAdmin2');
            $query = $request->t ? : '';
            $data['breadcrumb'] = "<span class='fa fa-file'></span> Páginas <b><span class='fa fa-arrow-right text-gray'></span> Resultados de: </b>".$query;
            $data['searchRoute'] = 'pages.search';
            $data['searchTitle'] = 'Título de la página';
            $data['pages'] = Page::search(['title'], $query)->paginate($this->config['itemsPerPage']);
            $data['pages']->appends(['t' => $query]);
            return view('teraadmin.pages.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function create(){
        try {
            $this->authorize('pages', User::class);
            $this->setSeo('Crear nueva página - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-file'></span> Páginas <b><span class='fa fa-arrow-right text-gray'></span> Crear nueva</b>";
            return view('teraadmin.pages.create', $data);
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function store(PageRequest $request)
    {
        try {
            $this->authorize('pages', User::class);
            $page = new Page();
            $page->fill($request->all());
            $page->created_by = Auth::user()->id;
            $page->save();
            return redirect()->route('pages.index')->with('message', 'Página creada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function edit($id){
        try {
            $this->authorize('pages', User::class);
            $data['page'] = Page::findOrFail($id);
            $this->setSeo('Editar página - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-file'></span> Páginas <b><span class='fa fa-arrow-right text-gray'></span> Editar página</b>";
            return view('teraadmin.pages.edit', $data);
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function update($id, PageRequest $request)
    {
        try {
            $this->authorize('pages', User::class);
            $page = Page::findOrFail($id);
            $page->fill($request->all());
            $page->active = $request->active;
            $page->save();
            return redirect()->route('pages.index')->with('message', 'Página actualizada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function activate($id, $action)
    {
        try
        {
            $page = Page::findOrFail($id);
            if($action == 1){
                $page->active = true;
                $message = 'La página ahora es visible';
            }else{
                $page->active = null;
                $message = 'La página fue desactivada exitósamente';
            }
            $page->save();
            return redirect()->route('pages.index')->with('message', $message);
        }
        catch (\Exception $e)
        {
            return redirect()->route('pages.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function destroy($id){
        try
        {
            Page::findOrFail($id)->delete();
            return redirect()->route('pages.index')->with('message', 'Página eliminada :(');
        }
        catch (\Exception $e)
        {
            return redirect()->route('pages.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

}

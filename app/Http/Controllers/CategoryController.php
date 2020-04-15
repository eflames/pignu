<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Models\Category;
use App\Models\CategoryType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\TipoCategoria;
use App\Traits\SEO;


class CategoryController extends Controller
{
    use SEO;

    public function index(){
        try {
            $this->authorize('configs', User::class);
            $this->setSeo('Categorias - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-list-ol'></span> Categorías <b><span class='fa fa-arrow-right text-gray'></span> Lista</b>";
            $data['searchRoute'] = 'categories.search';
            $data['searchTitle'] = 'Nombre, tipo de categoría';
            $data['categories'] = Category::orderBy('id','desc')->paginate($this->config['itemsPerPage']);
            return view('teraadmin.categories.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function search(Request $request){
        try {
            $this->authorize('configs', User::class);
            $this->setSeo('Categorias - TeraAdmin2');
            $query = $request->t ? : '';
            $data['breadcrumb'] = "<span class='fa fa-list-ol'></span> Categorías <b><span class='fa fa-arrow-right text-gray'></span> Resultados de: </b>".$query;
            $data['searchRoute'] = 'categories.search';
            $data['searchTitle'] = 'Nombre, tipo de categoría';
            $data['categories'] = Category::search(['name', 'type.name'], $query)->paginate($this->config['itemsPerPage']);
            $data['categories']->appends(['t' => $query]);
            return view('teraadmin.categories.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function create(){
        try {
            $this->authorize('configs',User::class);
            $this->setSeo('Crear categoría - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-list-ol'></span> Categorías <b><span class='fa fa-arrow-right text-gray'></span> Crear nueva categoría</b>";
            $data['types'] = CategoryType::pluck('name','id');
            return view('teraadmin.categories.create',$data);
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function store(CategoryRequest $request){
        try {
            $category = new Category();
            $category->fill($request->all());
            $category->slug = Str::slug($request->name);
            $category->created_by = Auth::user()->id;
            $category->save();
            return redirect()->route('categories.index')->with('message', 'Categoría guardada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function edit($id){
        try {
            $this->authorize('configs',User::class);
            $this->setSeo('Editar categoría - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-list-ol'></span> Categorías <b><span class='fa fa-arrow-right text-gray'></span> Editar categoría</b>";
            $data['types'] = CategoryType::pluck('name','id');
            $data['category'] = Category::findOrFail($id);
            return view('teraadmin.categories.edit', $data);
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function update(CategoryRequest $request, $id){
        try {
            $category = Category::findOrFail($id);
            $category->fill($request->all());
            $category->slug = Str::slug($request->name);
            $category->save();
            return redirect()->route('categories.index')->with('message', 'Categoría actualizada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function destroy($id){
        try {
            Category::findOrFail($id)->delete();
            return redirect()->route('categories.index')->with('message', 'Categoría eliminada :(');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }
}

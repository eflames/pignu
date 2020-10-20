<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Traits\SEO;
use App\Models\Category;
use App\Models\CategoryType;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\hasLanguages;
use App\Models\AppLanguage;

class CategoryController extends Controller
{
    use SEO, hasLanguages;

    private $policyName = 'categories';
    private $HeaderTitle = "<span class='fas fa-list fa-lg'></span> Categorías de contenido";

    public function index(){
        try{
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Categorías de contenido - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['searchRoute'] = 'categories.search';
            $data['searchProps'] = 'Nombre, Tipo de categoría';
            $data['categories'] = Category::paginate($this->config['itemsPerPage']);
            return view('pignu.categories.list', $data);
        }catch (\Exception $e){
            return redirect()->route('categories.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function create(){
        try{
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Crear categoría de contenido - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['categoryTypes'] = CategoryType::pluck('name', 'id');
            return view('pignu.categories.create', $data);
        }catch (\Exception $e){
            return redirect()->route('categories.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function store(CategoryRequest $request){
        try{
            $this->authorize($this->policyName, User::class);
            $category = new Category();
            $category->fill($request->all());
            foreach($this->appLanguages as $languageSwitch){
                $category->setTranslation('name', $languageSwitch->iso, $request->{'name_'.$languageSwitch->iso});
                $category->setTranslation('slug', $languageSwitch->iso, Str::slug($request->{'name_'.$languageSwitch->iso}));
            }
            $category->created_by = Auth::user()->id;
            $category->save();
            return redirect()->route('categories.index')->with('message', 'Categoría guardada con éxito');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function edit($id){
        try{
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Editar categoría de contenido - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['categoryTypes'] = CategoryType::pluck('name', 'id');
            $data['category'] = Category::findOrFail($id);
            return view('pignu.categories.edit', $data);
        }catch (\Exception $e){
            return redirect()->route('categories.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function update(CategoryRequest $request, $id){
        try{
            $this->authorize($this->policyName, User::class);
            $category = Category::findOrFail($id);
            $category->fill($request->all());
            foreach($this->appLanguages as $languageSwitch){
                $category->setTranslation('name', $languageSwitch->iso, $request->{'name_'.$languageSwitch->iso});
                $category->setTranslation('slug', $languageSwitch->iso, Str::slug($request->{'name_'.$languageSwitch->iso}));
            }
            $category->save();
            return redirect()->route('categories.index')->with('message', 'Categoría actualizada con éxito');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }
    
    public function destroy($id){
        try{
            $this->authorize($this->policyName, User::class);
            Category::findOrFail($id)->delete();
            return redirect()->route('categories.index')->with('message', 'Categoría eliminada :(');
        }catch (\Exception $e){
            return redirect()->route('categories.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }
}

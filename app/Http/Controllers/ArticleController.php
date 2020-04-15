<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleEditRequest;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Config;
use App\User;
use Illuminate\Http\Request;
use App\Traits\SEO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    use SEO;

    public function index(){
        try {
            $this->authorize('articles', User::class);
            $this->setSeo('Artículos - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-newspaper-o'></span> Artículos <b><span class='fa fa-arrow-right text-gray'></span> Lista</b>";
            $data['searchRoute'] = 'articles.search';
            $data['searchTitle'] = 'Título';
            $data['articles'] = Article::orderBy('id','desc')->paginate($this->config['itemsPerPage']);
            return view('teraadmin.articles.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function search(Request $request){
        try {
            $this->authorize('articles', User::class);
            $this->setSeo('Artículos - TeraAdmin2');
            $query = $request->t ? : '';
            $data['breadcrumb'] = "<span class='fa fa-newspaper-o'></span> Artículos <b><span class='fa fa-arrow-right text-gray'></span> Resultados de: </b>".$query;
            $data['searchRoute'] = 'categories.search';
            $data['searchTitle'] = 'Título';
            $data['articles'] = Article::search(['title'], $query)->paginate($this->config['itemsPerPage']);
            $data['articles']->appends(['t' => $query]);
            return view('teraadmin.articles.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function create(){
        try {
            $this->authorize('articles',User::class);
            $this->setSeo('Crear artículo - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-list-ol'></span> Artículos <b><span class='fa fa-arrow-right text-gray'></span> Crear nuevo</b>";
            $data['categories'] = Category::categorySection('articulos')->pluck('name','id');
            return view('teraadmin.articles.create', $data);
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function store(ArticleRequest $request){
        try
        {
            $article = new Article;
            $article->fill($request->all());
            $article->created_by = Auth::user()->id;
            $article->slug = Str::slug($request->title);
            if(empty($request->publish_date)){
                $article->publish_date = date('d-m-Y H:i');
            } else{
                $article->publish_date = $request->publish_date;
            }
            $article->image = $article->slug.'.jpg';
            $img = Image::make($request->image);
            $ancho = Config::where('key','articleWidthImage')->pluck('value')->first();
            $alto = Config::where('key','articleHeightImage')->pluck('value')->first();
            $ratioAncho = $img->width() / $ancho;
            $ratioAlto = $img->height() / $alto;
            if($ratioAncho > $ratioAlto){
                $img->resize(null, $alto, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }elseif($ratioAncho < $ratioAlto){
                $img->resize($ancho, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }else{
                $img->resize($ancho, $alto);
            }
            $img->crop($ancho, $alto)->save('images/articulos/'.$article->image);
            $article->save();
            return redirect()->route('articles.index')->with('message', 'Artículo guardado con exito');
        }
        catch (\Exception $e)
        {
            return redirect()->route('articles.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function edit($id){
        try {
            $this->authorize('articles',User::class);
            $this->setSeo('Editar artículo - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-newspaper-o'></span> Artículos <b><span class='fa fa-arrow-right text-gray'></span> Editar artículo</b>";
            $data['categories'] = Category::categorySection('articulos')->pluck('name','id');
            $data['article'] = Article::findOrFail($id);
            return view('teraadmin.articles.edit', $data);
        } catch (\Exception $e) {
            return redirect()->route('articles.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function update($id, ArticleEditRequest $request){
        try
        {
            $article = Article::findOrFail($id);
            $article->fill($request->all());
            $article->created_by = Auth::user()->id;
            $article->slug = Str::slug($request->title);
            if(empty($request->publish_date)){
                $article->publish_date = date('d-m-Y H:i');
            } else{
                $article->publish_date = $request->publish_date;
            }
            if(!empty($request->image)){
                $article->image = $article->slug.'.jpg';
                $img = Image::make($request->image);
                $ancho = Config::where('key','articleWidthImage')->pluck('value')->first();
                $alto = Config::where('key','articleHeightImage')->pluck('value')->first();
                $ratioAncho = $img->width() / $ancho;
                $ratioAlto = $img->height() / $alto;
                if($ratioAncho > $ratioAlto){
                    $img->resize(null, $alto, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                }elseif($ratioAncho < $ratioAlto){
                    $img->resize($ancho, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }else{
                    $img->resize($ancho, $alto);
                }
                $img->crop($ancho, $alto)->save('images/articulos/'.$article->image);
            }
            $article->save();
            return redirect()->route('articles.index')->with('message', 'Artículo guardado con exito');
        }
        catch (\Exception $e)
        {
            return redirect()->route('articles.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function destroy($id){
        try
        {
            $article = Article::findOrFail($id);
            if (public_path('images/articulos/' . $article->image)){
                File::delete(public_path('images/articulos/' . $article->image));
            }
            $article->delete();
            return redirect()->route('articles.index')->with('message', 'Artículo eliminado :(');
        }
        catch (\Exception $e)
        {
            return redirect()->route('articles.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function changeVisible($id, $action)
    {
        try
        {
            $article = Article::findOrFail($id);
            if($action == 'visible'){
                $article->visible = true;
                $message = 'El artículo ahora es visible';
            }elseif($action == 'hidden'){
                $article->visible = false;
                $message = 'El artículo fue marcado como no visible exitósamente';
            }else{
                $message = 'Estatus para artículos no encontrado';
            }
            $article->save();
            return redirect()->route('articles.index')->with('message', $message);
        }
        catch (\Exception $e)
        {
            return redirect()->route('articles.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }
}

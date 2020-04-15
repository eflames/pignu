<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductImageRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Traits\SEO;

class ProductController extends Controller
{
    use SEO;

    public function index(){
        try {
            $this->authorize('products', User::class);
            $this->setSeo('Productos - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-book'></span> Catálogo de productos <b><span class='fa fa-arrow-right text-gray'></span> Lista</b>";
            $data['products'] = Product::orderBy('id', 'desc')->paginate($this->config['itemsPerPage']);
            $data['searchRoute'] = 'products.search';
            $data['searchTitle'] = 'Nombre';
            return view('teraadmin.products.list',$data);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function search(Request $request){
        try {
            $this->authorize('products', User::class);
            $this->setSeo('Resultados de productos - TeraAdmin2');
            $query = $request->t ? : '';
            $data['breadcrumb'] = "<span class='fa fa-book'></span> Productos <b><span class='fa fa-arrow-right text-gray'></span> Resultados de: </b>".$query;
            $data['searchRoute'] = 'products.search';
            $data['searchTitle'] = 'Nombre';
            $data['products'] = Product::search(['name'], $query)->paginate($this->config['itemsPerPage']);
            $data['products']->appends(['t' => $query]);
            return view('teraadmin.products.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function create(){
        try {
            $this->authorize('products', User::class);
            $this->setSeo('Crear nuevo producto - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-book'></span> Catálogo de productos <b><span class='fa fa-arrow-right text-gray'></span> Crear nuevo producto</b>";
            $data['categories'] = Category::categorySection('productos')->pluck('name','id');
            return view('teraadmin.products.create',$data);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }

    }

    public function store(ProductRequest $request) {
        try {
            $this->authorize('products', User::class);
            $width = $this->config['ProductWidthImage'];
            $height = $this->config['ProductHeightImage'];

            $product = new Product();
            $product->fill($request->all());
            $product->slug = Str::slug($request->name);

            /*************** CREO LA CARPETA PARA LA GALERIA ********************/
            $folder_name = Str::slug($request->name);
            $folder_route = 'images/productos/' . $folder_name;
            File::makeDirectory($folder_route);

            /******************** GUARDA LA RUTA DE LA CARPETA EN LA BASE DE DATOS **************************/
            $product->folder = $folder_route;

            /******************** SUBO FOTO DE PORTADA **************************/
            $extension = $request->cover_image->getClientOriginalExtension();
            $product->cover_image = Str::slug($request->name).'-cover.'.$extension;
            $img = Image::make($request->cover_image);
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->crop($width, $height)->save($folder_route. '/' . $product->cover_image);

            $product->created_by = Auth::user()->id;
            $product->save();
            return redirect()->route('products.index')->with('message', 'Producto creado con éxito');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function edit($id)
    {
        try {
            $this->authorize('products', User::class);
            $this->setSeo('Editar producto - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-book'></span> Catálogo de productos <b><span class='fa fa-arrow-right text-gray'></span> Editar producto</b>";
            $data['categories'] = Category::categorySection('productos')->pluck('name','id');
            $data['product'] = Product::find($id);

            return view('teraadmin.products.edit',$data);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function update(ProductRequest $request, $id) {
        try {
            $this->authorize('products', User::class);
            $product = Product::findOrFail($id);
            $product->slug = Str::slug($request->name);
            if(!empty($request->cover_image)){
                $width = $this->config['ProductWidthImage'];
                $height = $this->config['ProductHeightImage'];
                unlink($product->folder . '/' . $product->cover_image);
                $folder_route = $product->folder;
                /******************** SUBO FOTO DE PORTADA **************************/
                $extension = $request->cover_image->getClientOriginalExtension();
                $product->cover_image = Str::slug($request->name).'-cover.'.$extension;
                $img = Image::make($request->cover_image);
                $img->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->crop($width, $height)->save($folder_route. '/' . $product->cover_image);
            }
            $product->fill($request->all());
            $product->active = $request->active;
            $product->orderable = $request->orderable;
            $product->highlighted = $request->highlighted;
            $product->save();
            return redirect()->route('products.index')->with('message', 'Producto actualizado con éxito');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function destroy($id){
        try {
            $product = Product::find($id);
            File::deleteDirectory($product->folder);
            $product->delete();
            return redirect()->route('products.index')->with('message', 'Producto eliminado :(');
        } catch (\Exception $e){
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function changeActive($id, $action){
        try {
            $product = Product::findOrFail($id);
            if($action=='activate'){
                $product->active = 1;
            }elseif($action=='deactivate'){
                $product->active = null;
            }else{
                return redirect()->route('products.index')->with('error','Acción Inválida');
            }
            $product->save();
            return redirect()->route('products.index')->with('message','Producto actualizado');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function changeHighlighted($id, $action)
    {
        try {
            $product = Product::findOrFail($id);
            if($action=='highlight'){
                $product->highlighted = 1;
            }
            elseif($action=='unhighlight'){
                $product->highlighted = null;
            }else{
                return redirect()->route('products.index')->with('error','Acción Inválida');
            }
            $product->save();
            return redirect()->route('products.index')->with('message','Producto actualizado');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function images($id)
    {
        try {
            $this->authorize('products', User::class);
            $this->setSeo('Imágenes del producto - TeraAdmin2');
            $data['product'] = Product::find($id);
            $data['breadcrumb'] = "<span class='fa fa-book'></span> Catálogo de productos <b><span class='fa fa-arrow-right text-gray'></span> Administrar imágenes de:</b> " .$data['product']->name;
            $data['images'] = ProductImage::where('product_id', $id)->get();
            $data['qty'] = ProductImage::images($id);
            return view('teraadmin.products.images_list', $data);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function addImage(ProductImageRequest $request)
    {
        try {
            $files = $request->file('file');
            $qtySubmitted = count($files);
            $maxAllowed = $this->config['maxImagesPerProduct'];
            $product_id = $request->input('product_id');
            $product = Product::where('id', $product_id)->first();
            $folder = $product->folder;
            $qtyExt = ProductImage::images($product_id);
            $qtyTotal = $qtySubmitted + $qtyExt;

            if ($qtyTotal > $maxAllowed) {
                return redirect()->route('product.images', $request->product_id)->with('error', 'Excede el límite de fotos. La galería no puede tener más de ' . $maxAllowed . ' fotos.');
            } else {
                $valids = 0;
                foreach ($files as $file_val){
                    $validator = Validator::make(array('file' => $file_val), array('file' => 'mimes:jpg,jpeg,png|image|max:1024'));
//                    $validator->passes() ?: $valids++;
                    if($validator->passes()){
                        $valids++;
                    }
                }
                if ($valids == $qtySubmitted){
                    $loaded = 0;
                    foreach ($files as $file){
                        $product_image = new ProductImage();
                        $product_image->product_id = $request->product_id;
                        $extension = $file->getClientOriginalExtension();
                        $product_image->image = Str::slug($product->name) . '-' . uniqid() . '.' . $extension;
                        $img = Image::make($file);
                        $height = $this->config['ProductHeightImage'];
                        $width = $this->config['ProductWidthImage'];
                        $img->resize($width, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        $img->crop($width, $height)->save($folder . '/'. $product_image->image);
                        $product_image->created_by = Auth::user()->id;
                        $product_image->save();
                        $loaded++;
                    }
                    if ($loaded == $qtySubmitted){
                        return redirect()->route('product.images', $request->product_id)->with('message', 'Foto(s) guardada(s) con éxito');
                    } else {
                        return redirect()->route('product.images', $request->product_id)->with('error', 'Ha ocurrido un error inesperado, por favor contacte a los administradores del sistema.');
                    }
                } else {
                    return redirect()->route('product.images', $request->product_id)->with('error', 'Uno o más archivos no corresponden a un formato de imagen');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function imageDestroy($id)
    {
        try {
            $image = ProductImage::find($id);
            $product = Product::where('id', $image->product_id)->first();
            unlink($product->folder . '/' . $image->image);
            $image->delete();
            return redirect()->route('product.images', $product->id)->with('message', 'Imagen eliminada con éxito');

        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }

    }

}

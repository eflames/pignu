<?php

namespace App\Http\Controllers;
use App\Http\Requests\GalleryDetailRequest;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Models\GalleryDetail;
use App\Traits\SEO;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    use SEO;

    public function index()
    {
        try {
            $this->authorize('galleries', User::class);
            $this->setSeo('Galerías - TeraAdmin2');
            $data['breadcrumb'] = "<span class='fa fa-picture-o'></span> Galerías <b><span class='fa fa-arrow-right text-gray'></span> Lista</b>";
            $data['galleries'] = Gallery::orderBy('id', 'desc')->paginate($this->config['itemsPerPage']);
            return view('teraadmin.galleries.list', $data);
        } catch (\Exception $e) {
            return redirect()->route('galleries.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }

    public function store(GalleryRequest $request)
    {
        try {
            $this->authorize('galleries', User::class);
            $gallery = Gallery::findOrNew($request->gallery_id);
            $gallery->fill($request->all());
            $gallery->slug = Str::slug($request->name);
            $gallery->created_by = Auth::user()->id;
            $gallery->save();
            return redirect()->route('galleries.index')->with('message', 'Galería guardada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('galleries.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }

    public function detail($id)
    {
        try {
            $this->authorize('galleries', User::class);
            $this->setSeo('Editar galerías - TeraAdmin2');
            $data['gallery'] = Gallery::findOrFail($id);
            $data['breadcrumb'] = "<span class='fa fa-picture-o'></span> Galerías <b><span class='fa fa-arrow-right text-gray'></span> Editando: </b>" . $data['gallery']->name;
            $data['images'] = $data['gallery']->details;
            return view('teraadmin.galleries.details', $data);
        } catch (\Exception $e) {
            return redirect()->route('galleries.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }

    public function addImage(GalleryDetailRequest $request)
    {
        try {
            $files = $request->file('file');
            $qtySubmitted = count($files);
            $maxAllowed = $this->config['maxImagesPerGallery'];
            $gallery_id = $request->input('gallery_id');
            $gallery = Gallery::where('id', $gallery_id)->first();
            $qtyExt = GalleryDetail::images($gallery_id);
            $qtyTotal = $qtySubmitted + $qtyExt;

            if ($qtyTotal > $maxAllowed) {
                return redirect()->route('gallery.detail', $request->gallery_id)->with('error', 'Excede el límite de imágenes. La galería no puede tener más de ' . $maxAllowed . ' imágenes.');
            } else {
                $valids = 0;
                foreach ($files as $file_val){
                    $validator = Validator::make(array('file' => $file_val), array('file' => 'mimes:jpg,jpeg,png|image|max:2048'));
                    if($validator->passes()){
                        $valids++;
                    }
                }
                if ($valids == $qtySubmitted){
                    $folder = 'images/galerias/'.$gallery->slug;
                    $folderThumb = 'images/galerias/thumbnails/'.$gallery->slug;
                    if(!File::isDirectory($folder)){
                        File::makeDirectory($folder, 0777, true, true);
                        File::makeDirectory($folderThumb, 0777, true, true);
                    }
                    $loaded = 0;
                    foreach ($files as $file){
                        $gallery_image = new GalleryDetail();
                        $gallery_image->gallery_id = $request->gallery_id;
                        $extension = $file->getClientOriginalExtension();
                        $gallery_image->image_path = Str::slug($gallery->name) . '/' . uniqid() . '.' . $extension;
                        $img = Image::make($file);
                        $imgThumb = Image::make($file);
                        $height = $this->config['galleryHeightImage'];
                        $width = $this->config['galleryWidthtImage'];
                        $heightthumb = $this->config['galleryThumbHeightImage'];
                        $widththumb = $this->config['galleryThumbWidthImage'];
                        $ratioAncho = $img->width() / $width;
                        $ratioAlto = $img->height() / $height;
                        if($ratioAncho > $ratioAlto){
                            $img->resize(null, $height, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }elseif($ratioAncho < $ratioAlto){
                            $img->resize($width, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }else{
                            $img->resize($width, $height);
                        }
                        $img->crop($width, $height)->save('images/galerias/'.$gallery_image->image_path);
                        //Thumbnail
                        $ratioAnchoThumb = $imgThumb->width() / $widththumb;
                        $ratioAltoThumb = $imgThumb->height() / $heightthumb;
                        if($ratioAnchoThumb > $ratioAltoThumb){
                            $imgThumb->resize(null, $heightthumb, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }elseif($ratioAnchoThumb < $ratioAltoThumb){
                            $imgThumb->resize($widththumb, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }else{
                            $imgThumb->resize($widththumb, $heightthumb);
                        }
                        $imgThumb->crop($widththumb, $heightthumb)->save('images/galerias/thumbnails/'.$gallery_image->image_path);
                        $gallery_image->created_by = Auth::user()->id;
                        $gallery_image->save();
                        $loaded++;
                    }
                    if ($loaded == $qtySubmitted){
                        return redirect()->route('gallery.detail', $request->gallery_id)->with('message', 'Imagen(es) guardada(s) con éxito');
                    } else {
                        return redirect()->route('gallery.detail', $request->gallery_id)->with('error', 'Ha ocurrido un error inesperado, por favor contacte a los administradores del sistema.');
                    }
                } else {
                    return redirect()->route('gallery.detail', $request->gallery_id)->with('error', 'Uno o más archivos no corresponden a un formato de imagen');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('gallery.detail', $request->gallery_id)->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function imageDestroy($id)
    {
        try {
            $image = GalleryDetail::find($id);
            $gallery_id = $image->gallery_id;
            unlink('images/galerias/' . $image->image_path);
            unlink('images/galerias/thumbnails/' . $image->image_path);
            $image->delete();
            return redirect()->route('gallery.detail', $gallery_id)->with('message', 'Imagen eliminada con éxito');

        } catch (\Exception $e) {
            return redirect()->route('gallery.detail', $gallery_id)->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }

    }

    public function markCover($id)
    {
        try {
            $image = GalleryDetail::findOrFail($id);
            GalleryDetail::where('gallery_id', $image->gallery_id)->update(['cover' => null]);
            $image->cover = 1;
            $image->save();
            return redirect()->route('gallery.detail', $image->gallery_id)->with('message', 'Imagen marcada como portada');

        } catch (\Exception $e) {
            return redirect()->route('gallery.detail', $image->gallery_id   )->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function active($id, $action)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->active = $action;
            $gallery->save();
            return redirect()->route('galleries.index')->with('message', 'Galeria actualizada.');
        } catch (\Exception $e) {
            return redirect()->route('galleries.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function destroy($id){
        try {
            $gallery = Gallery::find($id);
            foreach ($gallery->details as $image){
                if (File::exists('images/galerias/' .$image->image_path)){
                    unlink('images/galerias/' .$image->image_path);
                }
                if (File::exists('images/galerias/thumbnails/' .$image->image_path)){
                    unlink('images/galerias/thumbnails/' .$image->image_path);
                }
            }
            $gallery->delete();
            return redirect()->route('galleries.index')->with('message', 'Galería eliminada :(');
        } catch (\Exception $e){
            return redirect()->route('galleries.index')->with('error', 'Ha ocurrido un error inesperado y no se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }
}
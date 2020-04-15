<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppLanguageRequest;
use App\Http\Requests\DefaultImageRequest;
use App\Models\AppLanguage;
use Illuminate\Http\Request;
use App\Traits\SEO;
use App\Traits\hasLanguages;
use App\Models\Config;
use App\Models\Language;
use App\Models\Seo as ModelSeo;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ConfigController extends Controller
{
    use SEO, hasLanguages;

    private $policyName = 'configs';
    private $HeaderTitle = "<span class='fas fa-cog fa-lg'></span> Configuraciónes básicas";

    public function index()
    {
        try {
            $this->authorize($this->policyName, User::class);
            $this->setSeo('Configuraciones básicas - Pignu');
            $data['headerTitle'] = $this->HeaderTitle;
            $data['languages'] = Language::pluck('name', 'iso');
            $data['home_title'] = ModelSeo::where('key', 'home_title')->first();
            $data['home_description'] = ModelSeo::where('key', 'home_description')->first();
            return view('pignu.configuration.index', $data);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }

    public function storeAppLanguage(AppLanguageRequest $request)
    {
        try {
            $this->authorize('su', User::class);
            $languageName = Language::where('iso', $request->language_iso)->pluck('name')->first();
            AppLanguage::create(['iso' => $request->language_iso, 'name' => $languageName, 'created_by' => Auth::id()]);
            return redirect()->route('configuration.index')->with('message', 'Nuevo idioma agregado a la aplicación');
        } catch (\Exception $e) {
            return redirect()->route('configuration.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }

    public function deleteAppLanguage($id)
    {
        try {
            $this->authorize('su', User::class);
            AppLanguage::findOrFail($id)->delete();
            return redirect()->route('configuration.index')->with('message', 'Idioma eliminado de la aplicación');
        } catch (\Exception $e) {
            return redirect()->route('configuration.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }

    public function activateAppLanguage(Request $request)
    {
        try {
            $this->authorize('su', User::class);
            $opt = $request->multi_lang ?: 0;
            Config::setVar('multi_lang', $opt);
            return redirect()->route('configuration.index')->with('message', 'Sistema de idiomas actualizado');
        } catch (\Exception $e) {
            return redirect()->route('configuration.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }

    public function storeCompanyData(Request $request)
    {
        try {
            $this->authorize($this->policyName, User::class);
            Config::setVar('company', $request->company ?? '');
            Config::setVar('phone', $request->phone ?? '');
            Config::setVar('address', $request->address ?? '');
            Config::setVar('instagram', $request->instagram ?? '');
            Config::setVar('facebook', $request->facebook ?? '');
            Config::setVar('twitter', $request->twitter ?? '');
            return redirect()->route('configuration.index')->with('message', 'Información de la empresa actualizada');
        } catch (\Exception $e) {
            return redirect()->route('configuration.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }

    public function storeDefaultImage(DefaultImageRequest $request)
    {
        try {
            $this->authorize($this->policyName, User::class);
            $imagePath = 'images/default_image.jpg';
            Config::setVar('default_image', $imagePath);
            Image::make($request->image)->save($imagePath);
            return redirect()->route('configuration.index')->with('message', 'Imagen del sitio actualizada');
        } catch (\Exception $e) {
            return redirect()->route('configuration.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }

    public function storeSEOData(Request $request)
    {
        try {
            $this->authorize($this->policyName, User::class);
            $title = ModelSeo::where('key', 'home_title')->first();
            $description = ModelSeo::where('key', 'home_description')->first();
            foreach($this->appLanguages as $languageSwitch){
                $title->setTranslation('value', $languageSwitch->iso, $request->{'home_title_'.$languageSwitch->iso});
                $description->setTranslation('value', $languageSwitch->iso, $request->{'home_description_'.$languageSwitch->iso});
            }
            $title->save();
            $description->save();
            return redirect()->route('configuration.index')->with('message', 'Datos SEO actualizados');
        } catch (\Exception $e) {
            return redirect()->route('configuration.index')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() . ')');
        }
    }
}

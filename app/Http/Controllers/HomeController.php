<?php

namespace App\Http\Controllers;

use App\Traits\SEO;
use Spatie\Sitemap\SitemapGenerator;


class HomeController extends Controller
{
    use SEO;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        try
        {
            return redirect('/admin');
        }
        catch (\Exception $e)
        {
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function test()
    {
        return "home";
    }

    public function backend(){
        try {
            $this->setSeo('Dashboard - Pignu');
            $data['headerTitle'] = "<span class='fas fa-desktop fa-lg'></span> Dashboard";
//            $data['searchRoute'] = 'bla.bla';
            $data['searchProps'] = 'artículos de blog, usuarios, páginas..';
            return view('pignu.dashboard.index',$data);
        }
        catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'No se ha podido ejecutar la acción (' . $e->getMessage() .')' );
        }
    }

    public function generateSitemap(){
        try{
            $url = config('pignu.URL');
            $path = 'sitemap.xml';
            SitemapGenerator::create($url)->writeToFile($path);
            return "Sitemap generado";
        }catch(\Exception $e){
            return view('errors.error')->with('error', $e->getMessage());
        }
    }

}

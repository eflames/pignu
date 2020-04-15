<?php
/**
 * Created by PhpStorm.
 * User: ernestoflames
 * Date: 17/9/18
 * Time: 11:14 PM
 */

namespace App\Traits;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard as Twitter;
use Illuminate\Support\Str;

trait SEO
{
    public function setSeo($title = null, $description = null, $url = null, $img = null)
    {
        SEOMeta::setTitle(Str::limit($title,60));
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        //fb
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($url);
        OpenGraph::addImage($img);
        //tw
        Twitter::setTitle($title);
        Twitter::addImage($img);
    }
}
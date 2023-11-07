<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\FooterResource;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Config;
use App\Models\Footer;
use Illuminate\Http\Request;


class FooterController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $footerLinks = Footer::all();

        // Retrieve the icon mapping from the configuration
        $iconMapping = Config::get('icons');
        // dd($footerLinks, $iconMapping);
        foreach ($footerLinks as $link) {
            $iconName = $link->icon_name;
            $iconPath = $iconMapping[$iconName]['path'];
            $link->icon = asset($iconPath);
        }


        return $this->successResponse(FooterResource::collection($footerLinks),'Retrived Succsefully');
    }

}

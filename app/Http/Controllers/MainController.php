<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use App\Models\Menu;




class MainController extends Controller

{
    public function index()
    {
        $companyInfo = CompanyInformation::first();

        return view('index', compact('companyInfo'));
         $menus = Menu::all(); // atau ->take(10)
    return view('frontend.home', compact('menus'));
    }

    public function abouts()
    {
        return view('abouts');
    }

    public function blogs()
{
    return view('blogs'); // ⬅️ sesuai nama file baru
}


    public function gallery()
    {
        return view('gallery');
    }

    public function contact()
    {
        return view('contact');
    }

    public function diningAndBar()
    {
        $companyInfo = CompanyInformation::first();

        return view('dining-bar', compact('companyInfo'));
    }

    public function menu()
    {
        return view('menu');
    }

    public function chef()
    {
        return view('chef');
    }

    public function event()
    {
        return view('event');
    }

    public function fisheryAndPlantation()
    {
        return view('fishery-and-plantation');
    }

    public function hotelAndResort()
    {
        return view('hotel-and-resort');
    }

    public function propertyAndLand()
    {
        return view('property-and-land');
    }
}

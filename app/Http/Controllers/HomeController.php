<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'privacy_policy', 'social_media_disclosure', 'terms_of_service');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('site.pages.home');
        $title = 'Home' ;
        return view('site.pages.themeHome', compact('title') );
    }

    public function privacy_policy()
    {
        session()->put('lang', 'en');
        $title = 'Privacy Policy' ;
        return view('site.pages.static_pages.privacy_policy', compact('title') );
    }

    public function social_media_disclosure()
    {
        session()->put('lang', 'en');
        $title = 'Social Media Disclosure' ;
        return view('site.pages.static_pages.social_media_disclosure', compact('title') );
    }

    public function terms_of_service()
    {
        session()->put('lang', 'en');
        $title = 'Terms Of Service' ;
        return view('site.pages.static_pages.terms_of_service', compact('title') );
    }
}

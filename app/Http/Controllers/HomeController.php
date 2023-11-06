<?php

namespace App\Http\Controllers;

use App\Components\User\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function show(Request $request, HomeService $homeService): View
    {
        return view('home', [
            'user' => auth()->user(),
            'weather' => $homeService->getWeather($request->ip()),
        ]);
    }
}

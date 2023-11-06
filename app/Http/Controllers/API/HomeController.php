<?php

namespace App\Http\Controllers\API;

use App\Components\User\Services\HomeService;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request, HomeService $homeService): JsonResponse
    {
        $weather = $homeService->getWeather('130.0.33.226');

        return HomeResource::make($weather)->response();
    }
}

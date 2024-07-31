<?php

namespace App\Http\Controllers;

use App\Services\CountryInfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CountryInfoController extends Controller
{
    protected $countryInfoService;

    public function __construct(CountryInfoService $countryInfoService)
    {
        $this->countryInfoService = $countryInfoService;
    }

    public function getCountryName($countryCode)
    {
        Log::info('Received request for country code: ' . $countryCode);// guarda un registro de el codigo consultado en el log C:\xampp\htdocs\wssoap\storage\logs\laravel.log
        $countryName = $this->countryInfoService->getCountryNameByISOCode($countryCode);
        if ($countryName === null) {
            return response()->json(['error' => 'Unable to retrieve country name'], 500);
        }
        return response()->json($countryName);
    }
    public function getListOfCountryNames()
    {
        Log::info('Received request for list of country names');
        $countryNames = $this->countryInfoService->getListOfCountryNamesByCode();
        if ($countryNames === null) {
            return response()->json(['error' => 'Unable to retrieve list of country names'], 500);
        }
        return response()->json($countryNames);
    }

    public function addCountry(Request $request)
    {
        $countryName = $request->input('country_name');
        $countryCode = $request->input('country_code');

        Log::info('Received request to add country: ' . $countryName . ' with code: ' . $countryCode);
        $response = $this->countryInfoService->addCountry($countryName, $countryCode);
        if ($response === null) {
            return response()->json(['error' => 'Unable to add country'], 500);
        }
        return response()->json($response);
    }
}

<?php

namespace App\Services;

use SoapClient;
use Exception;
use Log;

class CountryInfoService
{
    protected $client;

    public function __construct()
    {
        $wsdl = 'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL';
        $options = [
            'trace' => true,
            'soap_version' => SOAP_1_2,
        ];

        try {
            $this->client = new SoapClient($wsdl, $options);
        } catch (Exception $e) {
            Log::error('SOAP Client Initialization Error: ' . $e->getMessage());
        }
    }

    public function getCountryNameByISOCode($countryCode)
    {
        try {
            $params = ['sCountryISOCode' => $countryCode];
            $response = $this->client->__soapCall('CountryName', [$params]);
            Log::info('SOAP response: ' . print_r($response, true));
            return $response;
        } catch (Exception $e) {
            Log::error('SOAP Call Error: ' . $e->getMessage());
            return null;
        }
    }

    public function getListOfCountryNamesByCode()
    {
        try {
            $response = $this->client->__soapCall('ListOfCountryNamesByCode', []);
            Log::info('SOAP response: ' . print_r($response, true));
            return $response;
        } catch (Exception $e) {
            Log::error('SOAP Call Error: ' . $e->getMessage());
            return null;
        }
    }

    public function addCountry($countryName, $countryCode)
    {
        try {
            $params = [
                'CountryName' => $countryName,
                'CountryISOCode' => $countryCode
            ];
            $response = $this->client->__soapCall('AddCountry', [$params]);
            Log::info('SOAP response: ' . print_r($response, true));
            return $response;
        } catch (Exception $e) {
            Log::error('SOAP Call Error: ' . $e->getMessage());
            return null;
        }
    }
}

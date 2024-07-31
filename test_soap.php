<?php

$wsdl = 'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL';
$options = [
    'trace' => true,
    'soap_version' => SOAP_1_2,
];

try {
    $client = new SoapClient($wsdl, $options);
    $params = ['sCountryISOCode' => 'US'];
    $response = $client->__soapCall('CountryName', [$params]);
    print_r($response);
} catch (Exception $e) {
    echo 'Exception: ' . $e->getMessage();
}

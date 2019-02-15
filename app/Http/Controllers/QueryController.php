<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class QueryController extends Controller
{
    public function query (Request $request)
    {
        //check whether the user provided query data
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        if ($validatedData) {

            $name = $request->name;
            $address = $request->address;

            $client = new Client();
            //make a request
            try {
                $requestURL = 'http://ratings.food.gov.uk/search/' . $name . '/' . $address . '/json';

                $response = $client->get($requestURL, [
                    'headers' => [
                        'version' => ["x-api-version", 2],
                        'language' => ["Accept-Language", "eb-GB"]
                    ]
                ]);

                $status = $response->getStatusCode();

                if ($status === 200) {

                    $response = $response->getBody()->getContents();

                    $response = json_decode($response, true);
                    //if there is a result, check the rating
                    if ($response['FHRSEstablishment']['Header']['ItemCount'] == 1) {

                        $rating = $response['FHRSEstablishment']['EstablishmentCollection']['EstablishmentDetail']['RatingValue'];
                        $addressL1 = $response['FHRSEstablishment']['EstablishmentCollection']['EstablishmentDetail']['AddressLine1'];
                        $addressL2 = $response['FHRSEstablishment']['EstablishmentCollection']['EstablishmentDetail']['AddressLine2'];
                        $postCode = $response['FHRSEstablishment']['EstablishmentCollection']['EstablishmentDetail']['PostCode'];

                        //return rating info
                        return view('results')->with(['rating' => $rating, 'name' => ucwords($name), 'addressL1' => ucwords($addressL1), 'addressL2' => ucwords($addressL2), 'postcode' => $postCode]);
                    } //if there is none or more than one result, return an error message
                    else {
                        return view('results')->with(['rating' => null, 'message' => 'Sorry, information not found.', 'name' => $name, 'address' => $address]);
                    }
                } //if there was a problem with API server, return an error message
                else {
                    echo 'Sorry there was an error.';
                }
            } catch (GuzzleException $e) {
                echo 'Error Message: ' . $e->getMessage();
            }
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;
use  Illuminate\Support\Facades\Session as Session;
use  Illuminate\Support\Facades\View as View;
use  Illuminate\Support\Facades\Auth as Auth;
use  Illuminate\Support\Facades\Storage as Storage;
use Shopify\Clients\HttpHeaders;
use Shopify\Clients\Rest;
use Shopify\Utils;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }
    public function store(Request $request)
    {
        // /** @var AuthSession */
        // $session = $request->get('shopifySession'); // Provided by the shopify.auth middleware, guaranteed to be active
        // $client = new Rest($session->getShop(), $session->getAccessToken());
        // $shop = Utils::sanitizeShopDomain($request->query('shop'));
        // dd($request);

        $post = [];
        $post['name'] = $request->name;
        $post['password'] = $request->password;


        // send api request for the shipper data
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://nexus-express.net/admin-area/shopify_auth_shipper.php',
            // CURLOPT_URL => 'https://mega-express.info/admin-area/shopify_auth_shipper.php', //test domain
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('data' => json_encode($post)),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = str_replace(' ', '', $response);
        $response = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response);

        // set auth value into file
        $file_value = file_put_contents(public_path('auth.txt'), $response);
        logger("response for Auth shipper: " . $response);
        // set auth value into file


        if ($response == 'true') {
            $message = 'Sucess Login to NCX System!';
            $alert = 'alert-success';
        } else {
            $message = 'Error while Login to NCX System!';
            $alert = 'alert-danger';
        }

        return View::make('home', compact('message', 'alert'));
        // send api request for the shipper data

    }
}

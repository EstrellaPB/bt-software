<?php

namespace publicity\Http\Controllers\admin;

use Illuminate\Http\Request;
use publicity\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class InfoProfileController extends Controller
{
    public function index()
    {
    	return view('admin.infoprofile.index');
    }

    public function getInfoProfile()
    {
    	$result['response'] = 'error';

    	$exists = Storage::disk('local')->exists('resources.json');

    	if($exists){
    		$contents = json_decode(Storage::get('resources.json'));
    		$result['data'] = $contents;
    		$result['response'] = 'success';
    		// dd($contents);
    		if (file_exists($_SERVER['DOCUMENT_ROOT'].$contents->company_info->logo_url)){
	            $result['imageExists'] = true;
	        }
    	}

    	return response()->json($result);
    }

    public function update(Request $request)
    {
    	$contents['company_info']['name'] = $request->input('name');
    	$contents['company_info']['slogan'] = $request->input('slogan'); 
    	$contents['company_info']['name'] = $request->input('name');

    	$result["uploadFile"] = false;
        if($request->hasFile('image')){
            $request->file('image')->storeAs(
                null,
                "logo.png",
                "images"
            );
            $result["uploadFile"] = true;

        }

        $contents['company_info']['logo_url'] = '/images/logo.png';
        
        $contents['company_info']['address'] = [
        	'street' => $request->input('street'),
        	'number' => $request->input('number'),
        	'crossing' => $request->input('crossing'),
        	'suburb' => $request->input('suburb'),
        	'city' => [
        		'name' => $request->input('cityName'),
        		'id' => $request->input('city')
        	],
        	'state' => [
        		'name' => $request->input('stateName'),
        		'id' => $request->input('state')
        	],
        	'country' => 'México',
        	'location' => [
        		'lat' => floatval($request->input('lat')),
        		'lng' => floatval($request->input('lng'))
        	]
        ];

        $contents['paginationElements'] = intval($request->input('paginationElements'));

        

    	if(Storage::put('resources.json', json_encode($contents))){
    		Session::flash('updateInfoProfile', 'Se ha actualizado el perfil');
    	}

    	return redirect("/admin/infoProfile");
    }
}

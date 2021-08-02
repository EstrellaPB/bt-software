<?php

namespace publicity\Http\Controllers;

use Illuminate\Http\Request;
use publicity\Publication;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $json = json_decode(Storage::get('resources.json'));

        $publications = Publication::simplePaginate($json->paginationElements);
        return view('index', [
            "publications" => $publications
        ]);
    }
}



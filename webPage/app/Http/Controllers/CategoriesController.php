<?php

namespace publicity\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use publicity\Category;
use publicity\Publication;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesAD = Category::group('A', 'D');
        $categoriesEG = Category::group('E', 'G');
        $categoriesHK = Category::group('H', 'K');
        $categoriesLO = Category::group('L', 'O');
        $categoriesPS = Category::group('P', 'S');
        $categoriesTZ = Category::group('T', 'Z');
        return view('categories', compact('categoriesAD', 'categoriesEG', 'categoriesHK', 'categoriesLO', 'categoriesPS', 'categoriesTZ'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $json = json_decode(Storage::get('resources.json'));

        $publications = Category::find($id)->publications()->simplePaginate($json->paginationElements);
        return view('index', [
            "publications" => $publications
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace publicity\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use publicity\Http\Controllers\Controller;
use publicity\Publication;
use publicity\Company;
use publicity\Category;
use Yajra\Datatables\Facades\Datatables;


class PublicationController extends Controller
{
    public function index(Request $request){
        $companies = Company::getCompanies();
        $categories = Category::getCategories();

        return view('admin.publications.index', compact('companies', 'categories'));
        // return response($request->input());

    }

    public function getPublications(Request $request){
        //return response()->json($request->header());
        $publications = Publication::with('category')->with('company')->get();
        $view = view('admin.publications.table', [
            "publications" => $publications
        ]);
        return response()->json([
            "html" => $view->render()
        ]);
    }

    public function show($id, Request $request){

        $result['response'] = 'error';

        if($publication = Publication::find($id)){

            $result['response'] = 'success';
            $publication = Publication::find($id);
            $view = view('admin.publications.show', [
                'publication' => $publication
            ]);

            $result['data'] = $publication;
            $result['data']['view'] = $view->render();
        }

        return response()->json($result);

    }

    public function edit($id, Request $request){
        $result['response'] = 'error';

        if($publication = Publication::find($id)){

            $table = view('admin.publications.tableCounter', [
                "viewed" => $publication->clicked,
                "used" => $publication->coupons->where('used', 1)->count(),
                "clients" => $publication->coupons->count()
            ]);

            $result['response'] = 'success';
            $result['data'] = $publication;
            $result['data']['category'] = $publication->category;
            $result['data']['company'] = $publication->company;
            $result['data']['coupons'] = $publication->coupons->count();
            $result['data']['table'] = $table->render();
            $result['data']['imageExists'] = false;
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$publication->urlImage)){
                $result['data']['imageExists'] = true;
            }
        }

        return response()->json($result);
    }

    public function update($id, Request $request){
        $result['response'] = 'error';
        $coupon = $request->input('is_coupon');
        $publication = Publication::find($id);
        if(!$publication)
            return response()->json($result);

        $publication->id_category = $request->input('category');
        $publication->id_company = $request->input('company');
        $publication->title = $request->input('title');
        $publication->description = $request->input('description');
        $publication->is_coupon = isset($coupon) ? true : false;
        $publication->urlImage = "/images/messages/" . $publication->id . ".jpg";
        $publication->update();

        Session::flash('updatePublication', 'Se ha actualizado la publicación ' . $publication->id . "[" . $publication->title . "]");
        $result["uploadFile"] = false;
        if($request->input('deleteImage')){
            if(file_exists($_SERVER['DOCUMENT_ROOT'].$publication->urlImage)){
                Storage::disk('messageImages')->delete($publication->id . ".jpg");
            }
        }
        else{
            if($request->hasFile('image')){
                $request->file('image')->storeAs(
                    null,
                    $publication->id . ".jpg",
                    "messageImages"
                );
                $result["uploadFile"] = true;
            }
            else{
                Storage::disk('messageImages')->delete($publication->id . ".jpg");
                Session::flash('fileStatus', 'Se ha eliminado el archivo de imagen');
            }
        }
        $result["data"] = $publication;

        return redirect('admin/publications/');
    }

    public function destroy($id, Request $request){
        return response()->json($request);
    }

    public function store(Request $request){
        $coupon = $request->input('is_coupon');
        $publication = Publication::create([
            'id_category' => $request->input('category'),
            'id_company' => $request->input('company'),
            'title' => $request->input('titulo'),
            'description' => $request->input('descripcion'),
            'is_coupon' => isset($coupon) ? true : false
        ]);

        $publication->fill([
            'urlImage' => "/images/messages/" . $publication->id . ".jpg"
        ]);
        $publication->update();

        Session::flash('storePublication', 'Se ha agregado una nueva publicación');
        $result["uploadFile"] = false;
        if($request->hasFile('image')){
            $request->file('image')->storeAs(
                null,
                $publication->id . ".jpg",
                "messageImages"
            );
            $result["uploadFile"] = true;
        }
        else{
            Session::flash('fileStatus', 'No se pudo cargar el archivo');
        }
        $result["data"] = $publication;
        return redirect('admin/publications/');
    }
}

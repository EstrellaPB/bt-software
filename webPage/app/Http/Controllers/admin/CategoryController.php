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

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    public function getCategories(Request $request){
        //return response()->json($request->header());
        $categories = Category::with('publications')->get();
        $view = view('admin.categories.table', [
            "categories" => $categories
        ]);
        return response()->json([
            "html" => $view->render()
        ]);
    }

    public function show($id, Request $request){

        $result['response'] = 'error';

        if($category = Category::find($id)){

            $result['response'] = 'success';
            $category = Category::find($id);
            $view = view('admin.categories.show', [
                'category' => $category
            ]);

            $result['data'] = $category;
            $result['data']['view'] = $view->render();
        }

        return response()->json($result);

    }

    public function edit($id, Request $request){
        $result['response'] = 'error';

        if($category = Category::find($id)){

            $table = view('admin.categories.tableCounter', [
                "publications" => $category->publications->count()
            ]);

            $result['response'] = 'success';
            $result['data'] = $category;
            
            $result['data']['table'] = $table->render();

            $result['data']['imageExists'] = false;
            if ($category->urlImage!=null && file_exists($_SERVER['DOCUMENT_ROOT'].$category->urlImage)){
                $result['data']['imageExists'] = true;
            }
            
        }
       
        return response()->json($result);
    }

    public function update($id, Request $request){
        $result['response'] = 'error';
        
        $category = Category::find($id);
        if(!$category)
            return response()->json($result);

        $category->shortDescription = $request->input('shortDescription');
        $category->longDescription = $request->input('longDescription');
        $category->urlImage = "/images/categories/" . $category->id . ".jpg";

        $category->update();

        Session::flash('updateCategory', 'Se ha actualizado la categoría ' . $category->id . "[" . $category->shortDescription . "]");
        $result["uploadFile"] = false;
        if($request->input('deleteImage')){
            if(file_exists($_SERVER['DOCUMENT_ROOT'].$category->urlImage)){
                Storage::disk('categoryImages')->delete($category->id . ".jpg");
            }
        }
        else{
            if($request->hasFile('image')){
                $request->file('image')->storeAs(
                    null,
                    $category->id . ".jpg",
                    "categoryImages"
                );
                $result["uploadFile"] = true;
            }
            else{
                Storage::disk('categoryImages')->delete($category->id . ".jpg");
                Session::flash('fileStatus', 'Se ha eliminado el archivo de imagen');
            }
        }
        $result["data"] = $category;

        return redirect('admin/categories/');
    }

    public function destroy($id, Request $request){
        
        if($category = Category::findOrFail($id)){
            $publications = $category->publications;

            foreach ($publications as $publication) {
                $publication->delete();
            }

            if($category->delete()){
                Session::flash('deleteCategory', 'Se ha eliminado la categoría correctamente');
            }else{
                Session::flash('errorCategory', 'Ha ocurrido un error al eliminar la categoría');
            }
        }else{
            Session::flash('errorCategory', 'No se ha encontrado la categoría');
        }

        return redirect('admin/categories/');
    }

    public function store(Request $request){
        
        $category = Category::create([
            'shortDescription' => $request->input('shortDescription'),
            'longDescription' => $request->input('longDescription')
        ]);

        $category->fill([
            'urlImage' => "/images/categories/" . $category->id . ".jpg"
        ]);
        $category->update();

        Session::flash('storeCategory', 'Se ha agregado una nueva categoría');
        $result["uploadFile"] = false;
        if($request->hasFile('image')){
            $request->file('image')->storeAs(
                null,
                $category->id . ".jpg",
                "categoryImages"
            );
            $result["uploadFile"] = true;
        }
        else{
            Session::flash('fileStatus', 'No se pudo cargar el archivo');
        }
        $result["data"] = $category;
        return redirect('admin/categories/');
    }
}

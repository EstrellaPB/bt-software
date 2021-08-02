<?php

namespace publicity\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use publicity\Http\Controllers\Controller;
use publicity\Publication;
use publicity\Company;
use publicity\CompanyDetail;



class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.clients.index');
    }

    public function getClients(Request $request){
        //return response()->json($request->header());
        $clients = Company::with('companyDetail')->get();
        $view = view('admin.clients.table', [
            "clients" => $clients
        ]);
        return response()->json([
            "html" => $view->render()
        ]);
    }

    public function getClientPublications($id){
        $publications = Publication::where('id_company', $id)->get();
        $view = view('admin.clients.tableClientPublications', [ 
            "publications" => $publications
        ]);
        return response()->json([
            "html" => $view->render()
        ]);
    }

    public function show($id, Request $request){

        $result['response'] = 'error';

        if($client = Company::find($id)){

            $result['response'] = 'success';
            $client = Company::find($id);
            $view = view('admin.clients.show', [
                'client' => $client
            ]);

            $result['data'] = $client;
            $result['data']['view'] = $view->render();
        }

        return response()->json($result);

    }

    public function edit($id, Request $request){
        $result['response'] = 'error';

        if($client = Company::find($id)){

            $table = view('admin.clients.tableCounter', [
               "publications" => $client->publications->count()
            ]);
           
            $result['response'] = 'success';
            $result['data'] = $client;
            $result['data']['companyDetail'] = $client->companyDetail;
            $result['data']['table'] = $table->render();

            $result['data']['imageExists'] = false;
            if ($client->companyDetail->urlImage!=null && file_exists($_SERVER['DOCUMENT_ROOT'].$client->companyDetail->urlImage)){
                $result['data']['imageExists'] = true;
            }
            
        }

        return response()->json($result);
    }

    public function update($id, Request $request){
        $result['response'] = 'error';
        
        $client = Company::find($id);
        if(!$client)
            return response()->json($result);

        $client->name = $request->input('name');
        $client->rfc = $request->input('rfc');
        $client->city = $request->input('city');
        $client->state = $request->input('state');
        $is_premium = $request->input('is_premium');
        $is_active = $request->input('is_active');

        if($client->update())
        {
            $clientDetail = CompanyDetail::where('id_company', $id)->first();
            //$clientDetail = CompanyDetail::find($client->companyDetail->id);
            $clientDetail->latitude = $request->input('latitude');
            $clientDetail->longitude = $request->input('longitude');
            
            
            if(isset($is_premium))
            {
                $clientDetail->is_premium = 1;
            }
            else
            {
                $clientDetail->is_premium  = 0;
            }
             if(isset($is_active))
            {
                $clientDetail->is_active = 1;
            }
            else
            {
                $clientDetail->is_active  = 0;
            }
            
             $clientDetail->urlImage = "/images/companies/" . $client->id . ".jpg";

            $clientDetail->update();

        }

        Session::flash('updateClient', 'Se ha actualizado el cliente ' . $client->id . "[" . $client->name . "]");
        $result["uploadFile"] = false;
        if($request->input('deleteImage')){
            if(file_exists($_SERVER['DOCUMENT_ROOT'].$client->companyDetail->urlImage)){
                Storage::disk('clientImages')->delete($client->id . ".jpg");
                Session::flash('fileStatus', 'Se ha eliminado el archivo de imagen');
            }
        }
        else{
            if($request->hasFile('image')){
                $request->file('image')->storeAs(
                    null,
                    $client->id . ".jpg",
                    "clientImages"
                );
                $result["uploadFile"] = true;
            }
            else{
                Storage::disk('clientImages')->delete($client->id . ".jpg");
                
            }
        }
        $result["data"] = $client;

        return redirect('admin/clients/');
    }

    public function destroy($id, Request $request){
        
        if($client = Company::findOrFail($id)){
            
            if($client->delete()){
                Session::flash('deleteClient', 'Se ha eliminado el cliente correctamente');
            }else{
                Session::flash('errorClient', 'Ha ocurrido un error al eliminar el cliente');
            }
        }else{
            Session::flash('errorClient', 'No se ha encontrado el cliente');
        }

        return redirect('admin/clients/');
    }



    public function store(Request $request){
        
        $client = Company::create([
            'name' => $request->input('name'),
            'rfc' => $request->input('rfc'),
            'city' => $request->input('city'),
            'state' => $request->input('state')


        ]);
        if($client)
        {
            $detail = new CompanyDetail;
            $detail->id_company = $client->id;
            $detail->latitude = $request->input('latitude');
            $detail->longitude = $request->input('longitude');
            $detail->longitude = $request->input('longitude');
            if($request->has('is_premium')){
                $detail->is_premium = 1;
            }
            else{
                $detail->is_premium = 0;
            }
            if($request->has('is_active')){
                $detail->is_active = 1;
            }
            else{
                $detail->is_active = 0;
            }
            $detail->urlImage = "/images/companies/" . $client->id . ".jpg";
            $detail->save();
        }

        Session::flash('storeClient', 'Se ha agregado un nuevo cliente');
        $result["uploadFile"] = false;
        if($request->hasFile('image')){
            $request->file('image')->storeAs(
                null,
                $client->id . ".jpg",
                "companyImages"
            );
            $result["uploadFile"] = true;
        }
        else{
            Session::flash('fileStatus', 'No se pudo cargar el archivo');
        }
        $result["data"] = $client;
        return redirect('admin/clients/');
    }
}

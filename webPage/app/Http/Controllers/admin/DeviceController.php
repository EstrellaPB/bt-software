<?php

namespace publicity\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use publicity\Http\Controllers\Controller;
use publicity\Publication;
use publicity\Message;
use publicity\Device;
use Validator;

use Illuminate\Validation\Rule;

class DeviceController extends Controller
{
    public function index(Request $request){
        

        return view('admin.devices.index');
        // return response($request->input());

    }

    public function getDevices(Request $request){
        //return response()->json($request->header());
        $devices = Device::all();
        $view = view('admin.devices.table', [
            "devices" => $devices
        ]);
        return response()->json([
            "html" => $view->render()
        ]);
    }

    public function show($id, Request $request){

        $result['response'] = 'error';

        if($device = Device::find($id)){

            $result['response'] = 'success';
            $device = Device::find($id);
            $view = view('admin.devices.show', [
                'device' => $device
            ]);

            $result['data'] = $device;
            $result['data']['view'] = $view->render();
        }

        return response()->json($result);

    }

    public function edit($id, Request $request){
        $result['response'] = 'error';

        if($device = Device::find($id)){

            $table = view('admin.devices.tableCounter', [
                "deviceID" => $device->id,
                "messages" => $device->messages->count(),
               // "coupons" => $device->messages->publication->where('is_coupon', 1)->count()
                
            ]);

            $result['response'] = 'success';
            $result['data'] = $device;
            $result['data']['mac'] = $device->mac;
            $result['data']['status'] = $device->status;
            
            $result['data']['table'] = $table->render();
           
        }

        return response()->json($result);
    }

    public function update($id, Request $request){
        $result['response'] = 'error';
        $status = $request->input('status');
        $device = Device::find($id);
        if(!$device)
            return response()->json($result);

        $device->mac = $request->input('mac');

        if(isset($status)){
            $device->status = 1;
        }else{
            $device->status = 0;
        }
        
        
        $device->update();

        Session::flash('updateDevice', 'Se ha actualizado el dispositivo ' . $device->id . " - " . $device->mac);
        
        $result["data"] = $device;

        return redirect('admin/devices/');
    }

    public function destroy($id, Request $request){
        if($device = Device::findOrFail($id)){

            if($device->delete()){
                Session::flash('deleteDevice', 'Se ha eliminado el dispositivo correctamente');
            }else{
                Session::flash('errorDevice', 'Ha ocurrido un error al eliminar el dispositivo');
            }
        }else{
            Session::flash('errorDevice', 'No se ha encontrado el dispositivo');
        }

        return redirect('admin/devices/');
    }

    public function store(Request $request){
        $status = $request->input('status');
        $device = Device::create([
            'mac' => $request->input('mac'),
            
            'status' => isset($status) ? 1 : 0
        ]);

        

        Session::flash('storeDevice', 'Se ha agregado un nuevo dispositivo');
       
        $result["data"] = $device;
        return redirect('admin/devices/');
    }

    public function validateMacUnique(Request $request){
        //$result['response'] = 'error';
        
        $validator = Validator::make($request->all(), [
            'mac' => [
                'required',
                Rule::unique('Devices')->ignore($request->input('id'))
            ]
        ]);
        
        if($validator->fails()){
            // $result['response'] = 'error';
            return response()->json(false);
        }else{
            // $result['response'] = 'success';
            return response()->json(true);
        }

        // return response()->json($result);
    }
    public function messages($id, Request $request){
        $device = Device::find($id);
        $now = \Carbon\Carbon::now();
        //$messages = Message::where('id_device', '!=', $id)->join('MessagesDevices', 'MessagesDevices.id_message', '=', 'Messages.id')->join('Devices', 'Devices.id', '=', 'MessagesDevices.id_device')->get();
        $messages = Message::leftJoin('MessagesDevices', function($join) use($id){
            $join->on('MessagesDevices.id_message', '=', 'Messages.id');
            $join->on(\DB::raw("'".$id."'"), '=', 'MessagesDevices.id_device');
        })->whereNull('MessagesDevices.id_message')
        ->join('Publications', 'Publications.id', 'Messages.id_publication')
        ->join('CompanyClients', 'CompanyClients.id', 'Publications.id_company')
        ->join('CompanyDetails', 'CompanyDetails.id_company', 'CompanyClients.id')

        ->select(
            'Messages.*', 
            'Publications.urlImage as urlImage', 
            'Publications.title as publicationTitle',
            'CompanyDetails.urlImage as companyImage',
            'CompanyClients.name as companyName'
        )->get();
        //$messages = Message::all();
        $deviceMessages = $device->messages;

        return view('admin.devices.messages', compact('messages', 'deviceMessages', 'device', 'now'));
    }

    public function saveDeviceMessage(Request $request){
        $result['response'] = 'error';
        $device = Device::find($request->idDevice);
       
        if($device->messages()->count() >= 5){
            $result['message'] = 'El dispositivo no puede tener más de 5 mensajes asignados';
        }else{
            $device->messages()->attach($request->idMessage);

            if($device->save()){
                $result['response'] = 'success';
                $result['message'] = 'Se ha asignado el mensaje al dispositivo correctamente';
            }else{
                $result['message'] = 'Hubo un error en la asignación';
            }
        }
        

        return response()->json($result);
    }

    public function deleteDeviceMessage(Request $request){
        $result['response'] = 'error';
        $device = Device::find($request->idDevice);
        $device->messages()->detach($request->idMessage);

        if($device->save()){
            $result['response'] = 'success';
            $result['message'] = 'Se ha removido el mensaje del dispositivo';
        }else{
            $result['message'] = 'Hubo un error al remover el mensaje';
        }

        return response()->json($result);
    }
}

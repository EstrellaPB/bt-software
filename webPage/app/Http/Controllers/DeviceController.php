<?php

namespace publicity\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use publicity\Device;

class DeviceController extends Controller
{
    public function getMessage(Request $request){
        $device = Device::with('messages')->where('mac', $request->input('mac'))->first();
        if($device == null){
            $response = ["message" => "Device not found!"];
            $contentLength = strlen(implode($response));
            return response($response)->header('Content-Length', $contentLength);
        }
        $response = ["qty" => count($device->messages->pluck('url')->toArray()), "content" => $device->messages->pluck('url')->toArray()];
        $contentLength = strlen(json_encode($response));
        return response($response)->header('Content-Length', $contentLength);
    }
}

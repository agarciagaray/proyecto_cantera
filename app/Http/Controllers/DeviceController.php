<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Auth;

class DeviceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $devices =Device::orderBy('id','DESC')->get();
        return view('devices.index', ['devices' => $devices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $device = Device::find($request->id);

        if (isset($request->show) && $request->show == 'true') {

            return view('devices.show', compact('device'));
        } else {

            return view('devices.form', compact('device'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $device  = Device::find($request->id);
        $data =$request->all();
        if ($device) {
            $device->update( $data);
        } else {
            $data['id_user']=Auth::id();
            $device = Device::create( $data);
        }
        $devices =Device::orderBy('id','DESC')->get();
        return view('devices.trDevices', compact('devices'));
    }

    public function destroy(Request $request) {
        
        $device  = Device::find($request->idDevice);
        $device->disp_estado = 'I';
        $device->save();
        $devices =Device::orderBy('id','DESC')->get();
        return view('devices.trDevices', compact('devices'));
    }
}

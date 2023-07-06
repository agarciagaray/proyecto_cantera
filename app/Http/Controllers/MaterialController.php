<?php

namespace App\Http\Controllers;

use App\Models\Admin\PermissionModel;
use App\Models\Material;
use App\Models\MaterialModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::orderBy('id','DESC')->get();
        return view('materials.index', ['materials' => $materials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $material = Material::find($request->id);
        $person = null;

        if (isset($request->show) && $request->show == 'true') {

            return view('materials.show', compact('material'));
        } else {

 
            // dd($material);
            return view('materials.form', compact('material'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Creo los datos de material
        $material = $request->all();
  
        $material['id_user']            = Auth::id();
  
        $validate = MaterialModel::getValidator($material);

        if($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);

        }
        
        Material::create($material);

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $materials = Material::orderBy('id','DESC')->get();
        return view('materials.trMaterial', ['materials' => $materials]);

    }

    public function update(Request $request)
    {
        // Actualizo los datos de un material
        $matUpd = $request->all();

        $matUpd['id_user']            = Auth::id();

        $validate = MaterialModel::getValidator($matUpd);

        if($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        $constr = MaterialModel::getMaterial($request->id);
        $constr->update($matUpd);

        // Obtengo los datos nuevamente para mostrarlos en el listado

        $materials = Material::orderBy('id','DESC')->get();
        return view('materials.trMaterial', ['materials' => $materials]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $material = MaterialModel::getMaterial($request->idMaterial);
        $material->mate_estado = $request->mate_estado;
        $material->save();
        $materials = Material::orderBy('id','DESC')->get();
        return view('materials.trMaterial', ['materials' => $materials]);
    }
}

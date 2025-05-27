<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $municipios = DB::table('tb_municipio')
            ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
            ->select('tb_municipio.*', 'tb_departamento.depa_nomb')
            ->get();
            return json_encode(['municipios' => $municipios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $request->validate([
            'muni_nomb' => ['required', 'max:255'],
            'depa_codi' => ['required', 'numeric', 'min:1'],
        ]);

        $municipio = new Municipio();
        $municipio->muni_nomb = $request->muni_nomb;
        $municipio->depa_codi = $request->depa_codi;
        $municipio->save();

        return response()->json(['municipio' => $municipio], 201);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error al crear el municipio.',
            'detalle' => $e->getMessage(),
        ], 500);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $municipio = Municipio::find($id);
        if (is_null($municipio)) {
                return abort(404);
        }
        $departamentos = DB::table('tb_departamento')
            ->orderBy('depa_nomb')
            ->get();

        return json_encode(['municipio' => $municipio, 'departamentos' => $departamentos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
        'muni_nomb' => ['required', 'max:255'],
        'depa_codi' => ['required', 'numeric', 'min:1'],
        ]);

        $municipio = Municipio::find($id);

        if (is_null($municipio)) {
            return response()->json(['message' => 'Municipio no encontrado.'], 404);
        }

        $municipio->muni_nomb = $request->muni_nomb;
        $municipio->depa_codi = $request->depa_codi;
        $municipio->save();

        return response()->json(['municipio' => $municipio]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $municipio = Municipio::find($id);
        if (is_null($municipio)) {
                return abort(404);
        }
        
        $municipio->delete();

        $municipios = DB::table('tb_municipio')
        ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
        ->select('tb_municipio.*', 'tb_departamento.depa_nomb')
        ->get();

        return json_encode(['municipios' => $municipios, 'success' => true]);
    }
}

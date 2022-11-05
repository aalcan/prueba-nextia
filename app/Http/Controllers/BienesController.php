<?php

namespace App\Http\Controllers;

use App\Models\Bienes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BienesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function getAll()
    {
        $bienes = Bienes::all();
        $bienes_with_user = [];

        foreach ($bienes as $bien){
            $bienes_with_user[] = $bien->serialize();
        }
        return $bienes_with_user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $bien_id
     * @return array
     */
    public function getById($bien_id)
    {
        $bien = Bienes::find($bien_id);

        if (!$bien) {
            abort(500, "Bien with ID not found");
        }

        return $bien->serialize();
    }

    /**
     * Display the specified resource.
     *
     * @return array
     */
    public function getByList(Request $request)
    {

        $string_list = $request->query('id');
        $list = explode(",", $string_list);
        $bienes = Bienes::whereIn('id', $list)->get();
        $bienes_with_user = [];

        foreach ($bienes as $bien) {
            $bienes_with_user[] = $bien->serialize();
        }
        return $bienes_with_user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function create(Request $request)
    {
        $request->validate([
            'articulo'    => 'required|max:255',
            'descripcion' => 'max:255'
        ]);

        $bien = new Bienes([
            'articulo'    => $request->input('articulo'),
            'descripcion' => $request->input('descripcion'),
            'user_id'     => $request->user()->id
        ]);

        if (!$bien->save()) {
            abort(500, "No se pudo guardar el bien");
        }

        return $bien->serialize();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $bien_id
     * @return array
     */
    public function update(Request $request, $bien_id)
    {
        $request->validate([
            'articulo'    => 'required|max:255',
            'descripcion' => 'max:255'
        ]);

        $bien = Bienes::find($bien_id);

        if (!$bien) {
            abort(500, "Bien with ID not found");
        }

        $bien->articulo    = $request->input('articulo');
        $bien->descripcion = $request->input('descripcion');

        if (!$bien->save()) {
            abort(500, "Can't update record");
        }

        return $bien->serialize();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $bien_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bien_id)
    {
        $bien = Bienes::find($bien_id);

        if (!$bien) {
            abort(500, "Bien with ID not found");
        }

        if (!$bien->delete()) {
            abort(500, "Can't delete record");
        }

        return Response('Record deleted', 204) ->header('Content-Type', 'text/plain');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $datos['articulos'] = Articulo::paginate(5);
        // return view('articulo.index', $datos);
        $buscar = $request->get('buscarpor');

        $tipo = $request->get('tipo');

        if($tipo == "Buscar por tipo"){
            $datos['articulos'] = Articulo::paginate(10);
            return redirect('articulo.index', $datos)->with('mensaje', 'Debes elegir una opción');
        }

        $datos['articulos'] = Articulo::buscarpor($tipo, $buscar)->paginate(10);
        
        return view('articulo.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('articulo.create');
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
        // $datosArticulo = request()->all();
        $datosArticulo = request()->except('_token');
        if ($request->hasFile('Foto')){
            $datosArticulo['Foto']=$request->file('Foto')->store('uploads', 'public');
        }
        Articulo::insert($datosArticulo);
        return redirect('/articulo');

        // return response()->json($datosArticulo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $articulo=Articulo::findOrFail($id);
        return view('articulo.edit', compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosArticulo = $request->except(['_token', '_method']);

        if ($request->hasFile('Foto')){
            $articulo=Articulo::findOrFail($id);
            
            Storage::delete('public/'.$articulo->Foto);

            $datosArticulo['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        Articulo::where('id', '=', $id)->update($datosArticulo);
        $articulo=Articulo::findOrFail($id);
        return redirect('articulo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $articulo=Articulo::findOrFail($id);

        Storage::delete('public/'.$articulo->Foto);
        Articulo::destroy($id);


        return redirect('articulo');
    }
}

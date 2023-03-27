<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SessionManager $sessionManager)
    {
        //
        // $datos['articulos'] = Articulo::paginate(5);
        // return view('articulo.index', $datos);

        $buscar = $request->get('buscarpor');

        $tipo = $request->get('tipo');

        if($tipo == "Buscar por tipo"){
            $sessionManager->flash('mensaje', 'Debes elegir una opción');
            $datos['articulos'] = Articulo::paginate(10);
            return view('articulo.index', $datos);
        }

        // if($buscar == ""){
        //     $sessionManager->flash('mensaje2', 'Debes añadir un criterio para buscar');
        //     $datos['articulos'] = Articulo::paginate(10);
        //     return view('articulo.index', $datos);
        // }


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
        
        $request->validate([
            'codigo' => 'unique:articulos|max:13',
            'descripcion' => 'regex:/(^([a-z]+)(\d+)$)/',
            'precio' => ['required','numeric'],
            'stock' => ['required','numeric']
            ] );
        
        $datosArticulo = request()->except('_token');
        if ($request->hasFile('foto')){
            
            $request->foto=$request->file('foto')->store('uploads', 'public');
        }

        Articulo::create(['codigo' => $request->codigo, 
        'descripcion' => $request->descripcion, 
        'precio' => $request->precio,
        'stock' => $request->stock,
        'foto' => $request->foto]);
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
    

        if($articulo=Articulo::findOrFail($id)){
            return view('articulo.edit', compact('articulo'));
        } 
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
  
        $request->validate([
            // 'codigo' => ['unique:articulos', 'max:13'],
            'descripcion' => ['regex:/(^([a-z]+)(\d+)$)/'],
            'precio' => ['required','numeric'],
            'stock' => ['required','numeric']
            ] );

       



        $articulo=Articulo::findOrFail($request->id_articulo);


        if ($request->hasFile('foto')){
            
            Storage::delete('public/'.$articulo->foto);

            $request->file('foto')->store('uploads', 'public');
            $articulo->foto=$request->foto;
        }

        $articulo->codigo = $request->codigo;
        $articulo->descripcion = $request->descripcion;
        $articulo->precio = $request->precio;
        $articulo->stock = $request->stock;

        $articulo->save();

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

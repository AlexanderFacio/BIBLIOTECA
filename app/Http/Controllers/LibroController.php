<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use PDF;
use League\Csv\Writer;
use Illuminate\Validation\Rule;

/**
 * Class LibroController
 * @package App\Http\Controllers
 */
class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $query = Libro::query();

        // Verifica si hay un término de búsqueda en la URL
        if ($request->has('busqueda')) {
            $busqueda = $request->input('busqueda');
            $query->where('nombre', 'like', '%' . $busqueda . '%');
        }

        // Verifica si hay una categoría en la URL
        if ($request->has('categoria')) {
            $categoriaId = $request->input('categoria');
            $query->where('categoria_id','like', '%' . $categoriaId . '%');
        }

        $libros = $query->paginate(5);

        // Obtén todas las categorías para el menú desplegable
        $categorias = Categoria::pluck('nombre', 'id');

        return view('libro.index', compact('libros', 'categorias'))
            ->with('i', (request()->input('page', 1) - 1) * $libros->perPage());
    }

    public function pdf()
    {
        $libros = Libro::paginate();
        $pdf = PDF::loadView('libro.pdf',['libros'=>$libros]);
        //return $pdf->stream();
        return $pdf->download('__libros.pdf');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create() {
        $libro = new Libro();

        $categorias= Categoria::pluck('nombre','id');

        return view('libro.create', compact('libro','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar reglas de validación definidas en el modelo Libro
        request()->validate([
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('libros'),
                // Agrega aquí otras reglas de validación necesarias
            ],
            // Agrega aquí otras reglas de validación necesarias para otros campos
        ]);

        // Verificar si ya existe un libro con el mismo nombre
        $existingLibro = Libro::where('nombre', $request->input('nombre'))->first();

        if ($existingLibro) {
            // Si ya existe un libro con el mismo nombre, redirecciona con un mensaje de error
            return redirect()->route('libros.index')
                ->with('error', 'Ya existe un libro con este nombre.');
        }

        // Si no hay un libro con el mismo nombre, crea el nuevo libro
        $libro = Libro::create($request->all());

        // Redirecciona con un mensaje de éxito
        return redirect()->route('libros.index')
            ->with('success', 'LIBRO CREADO EXITOSAMENTE.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libro = Libro::find($id);

        return view('libro.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = Libro::find($id);
        $categorias= Categoria::pluck('nombre','id');
        return view('libro.edit', compact('libro', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Libro $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        // Validar reglas de validación definidas en el modelo Libro
        request()->validate([
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('libros')->ignore($libro->id),
                // Agrega aquí otras reglas de validación necesarias
            ],
            // Agrega aquí otras reglas de validación necesarias para otros campos
        ]);

        // Verificar si ya existe otro libro con el mismo nombre (excluyendo el libro actual)
        $existingLibro = Libro::where('nombre', $request->input('nombre'))
            ->where('id', '!=', $libro->id)
            ->first();

        if ($existingLibro) {
            // Si ya existe otro libro con el mismo nombre, redirecciona con un mensaje de error
            return redirect()->route('libros.index')
                ->with('error', 'Ya existe otro libro con este nombre.');
        }

        // Si no hay otro libro con el mismo nombre, actualiza el libro actual
        $libro->update($request->all());

        // Redirecciona con un mensaje de éxito
        return redirect()->route('libros.index')
            ->with('success', 'LIBRO MODIFICADO EXITOSAMENTE');
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $libro = Libro::find($id)->delete();

        return redirect()->route('libros.index')
            ->with('success', 'LIBRO ELIMINADO EXITOSAMENTE');
        
    }
}

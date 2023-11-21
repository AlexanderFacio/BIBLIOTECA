<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class CategoriaController
 * @package App\Http\Controllers
 */
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');

        // Aplica la búsqueda si se proporciona un término de búsqueda
        if ($busqueda) {
            $categorias = Categoria::where('nombre', 'LIKE', '%' . $busqueda . '%')->paginate();
        } else {
            $categorias = Categoria::paginate();
        }

        return view('categoria.index', compact('categorias', 'busqueda'))
            ->with('i', (request()->input('page', 1) - 1) * $categorias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = new Categoria();
        return view('categoria.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar reglas de validación definidas en el modelo Categoria
        request()->validate([
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('categorias'),
                // Agrega aquí otras reglas de validación necesarias
            ],
            // Agrega aquí otras reglas de validación necesarias para otros campos
        ]);

        // Verificar si ya existe una categoría con el mismo nombre
        $existingCategoria = Categoria::where('nombre', $request->input('nombre'))->first();

        if ($existingCategoria) {
            // Si ya existe una categoría con el mismo nombre, redirecciona con un mensaje de error
            return redirect()->route('categorias.index')
                ->with('error', 'Ya existe una categoría con este nombre.');
        }

        // Si no hay una categoría con el mismo nombre, crea la nueva categoría
        $categoria = Categoria::create($request->all());

        // Redirecciona con un mensaje de éxito
        return redirect()->route('categorias.index')
            ->with('success', 'CATEGORIA CREADA EXITOSAMENTE');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);

        return view('categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);

        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        // Validar reglas de validación definidas en el modelo Categoria
        request()->validate([
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('categorias')->ignore($categoria->id),
                // Agrega aquí otras reglas de validación necesarias
            ],
            // Agrega aquí otras reglas de validación necesarias para otros campos
        ]);

        // Verificar si ya existe otra categoría con el mismo nombre (excluyendo la categoría actual)
        $existingCategoria = Categoria::where('nombre', $request->input('nombre'))
            ->where('id', '!=', $categoria->id)
            ->first();

        if ($existingCategoria) {
            // Si ya existe otra categoría con el mismo nombre, redirecciona con un mensaje de error
            return redirect()->route('categorias.index')
                ->with('error', 'Ya existe otra categoría con este nombre.');
        }

        // Si no hay otra categoría con el mismo nombre, actualiza la categoría actual
        $categoria->update($request->all());

        // Redirecciona con un mensaje de éxito
        return redirect()->route('categorias.index')
            ->with('success', 'CATEGORIA MODIFICADA EXITOSAMENTE');
}

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id)->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'CATEGORIA ELIMINADA EXITOSAMENTE');
    }
}

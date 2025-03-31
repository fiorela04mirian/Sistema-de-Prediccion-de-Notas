<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ParametroRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax()) {
            $parametros = Parametro::all();
            return response()->json($parametros);
        }

        // Agrupar registros en bloques de tres por la misma fecha
        $parametros = Parametro::orderBy('fecha')
            ->get()
            ->groupBy('fecha') // Agrupa por fecha
            ->map(function ($items) {
                return $items->chunk(3); // Divide los registros por bloques de 3
            });

        return view('parametro.index', compact('parametros'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $parametro = new Parametro();

        return view('parametro.create', compact('parametro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParametroRequest $request): RedirectResponse
    {
        // Recorremos las series de datos dinámicos (hora, ce, ph, etc.)
        for ($i = 1; $i <= 3; $i++) {
            Parametro::create([
                'fecha' => $request->input('fecha'),  // Campo común para todos
                'hora' => $request->input("hora{$i}"),
                'ce' => $request->input("ce{$i}"),
                'ph' => $request->input("ph{$i}"),
                'temp_ambiente' => $request->input("temp_amb{$i}"),
                'temp_solucion' => $request->input("temp_sol{$i}"),
            ]);
        }

        // Redireccionamos al índice con un mensaje de éxito
        return Redirect::route('parametros.index')
            ->with('success', 'Parámetros registrados correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $parametro = Parametro::find($id);

        return view('parametro.show', compact('parametro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $parametro = Parametro::find($id);

        return view('parametro.edit', compact('parametro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParametroRequest $request, Parametro $parametro): RedirectResponse
    {
        // Obtener todos los registros con la misma fecha
        $parametros = Parametro::where('fecha', $parametro->fecha)->get();

        // Iterar sobre los registros y actualizar con los datos del formulario
        foreach ($parametros as $index => $registro) {
            if (isset($request->hora[$index])) {
                $registro->update([
                    'hora' => $request->hora[$index],
                    'ce' => $request->ce[$index],
                    'ph' => $request->ph[$index],
                    'temp_ambiente' => $request->temp_ambiente[$index],
                    'temp_solucion' => $request->temp_solucion[$index],
                ]);
            }
        }

        return Redirect::route('parametros.index')
            ->with('success', 'Parámetros actualizados correctamente.');
    }


    public function destroy($id): RedirectResponse
    {
        // Obtiene el parámetro a eliminar
        $parametro = Parametro::find($id);

        if ($parametro) {
            // Elimina todos los registros con la misma fecha que el parámetro obtenido
            Parametro::where('fecha', $parametro->fecha)->delete();

            return Redirect::route('parametros.index')
                ->with('success', 'Bloque de parámetros eliminado correctamente.');
        }

        return Redirect::route('parametros.index')
            ->with('error', 'Parámetro no encontrado.');
    }
}

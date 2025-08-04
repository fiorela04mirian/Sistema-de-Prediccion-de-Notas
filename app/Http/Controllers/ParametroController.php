<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ParametroRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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
        // Verificar si ya existe un registro con la misma fecha
        $fecha = $request->input('fecha');  // O el nombre del campo correspondiente

        $exists = DB::table('parametros')->where('fecha', $fecha)->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['fecha' => 'La fecha ya está registrada.'])->withInput();
        }
        // Recorremos las series de datos dinámicos (hora, ce, ph, etc.)
        for ($i = 1; $i <= 3; $i++) {
            $n1 = $request->input("nota1{$i}");
            $n2 = $request->input("nota2{$i}");
            $n3 = $request->input("nota3{$i}");
            $prediccion = $this->predecirNota($n1, $n2, $n3);

            Parametro::create([
                'fecha' => $request->input('fecha'),  // Campo común para todos
                'hora' => $request->input("hora{$i}"),
                'nota1' => $request->input("nota1{$i}"),
                'nota2' => $request->input("nota2{$i}"),
                'nota3' => $request->input("nota3{$i}"),
                'promedio_predicho' => $prediccion,
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
    public function update(Request $request): RedirectResponse
    {
        $ids = $request->input('id'); // Obtener los IDs de los registros a actualizar
        $horas = $request->input('hora');
        $nota1 = $request->input('nota1');
        $nota2 = $request->input('nota2');
        $nota3 = $request->input('nota3');
        $promedio_predicho = $request->input('promedio_predicho');

        foreach ($ids as $index => $id) {
            $parametro = Parametro::find($id); // Buscar el parámetro por ID

            if ($parametro) {
                $parametro->update([
                    'hora' => $horas[$index],
                    'nota1' => $nota1[$index],
                    'nota2' => $nota2[$index],
                    'nota3' => $nota3[$index],
                    'promedio_predicho' => $promedio_predicho[$index],
                ]);
            }
        }

        return Redirect::route('parametros.index')
            ->with('success', 'Parámetros actualizados correctamente.');
    }

    public function predecirNota($n1, $n2, $n3): float
    {
        $pesos = [0.30258242, 0.19750771, 0.50114373];
        $bias = -0.0160;
        $y = $pesos[0] * $n1 + $pesos[1] * $n2 + $pesos[2] * $n3 + $bias;
        return round($y, 2);
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

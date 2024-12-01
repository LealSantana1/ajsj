<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    // Mostrar el formulario para crear un nuevo estudiante
    public function create()
    {
        return view('estudiantes.create');
    }

    // Guardar un nuevo estudiante en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'grado' => 'required|string|max:255',
            'seccion' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',

            'nombre_padre' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'telefono_padre' => 'nullable|string|max:15',
            'telefono_madre' => 'nullable|string|max:15',
            'documento_tipo' => 'nullable|string|max:50',
            'documento_numero' => 'nullable|string|max:50|unique:registro_estudiantes',
        ]);

        Estudiante::create($request->all());

        return redirect()->route('admin.estudiantes.index');
    }

    // Mostrar todos los estudiantes
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('estudiantes.index', compact('estudiantes'));
    }

    // Mostrar el formulario para editar un estudiante
    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        return view('estudiantes.edit', compact('estudiante'));
    }

    // Actualizar los datos de un estudiante
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'grado' => 'required|string|max:255',
            'seccion' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
            'promedio' => 'nullable|numeric|min:0|max:10',
            'nombre_padre' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'telefono_padre' => 'nullable|string|max:15',
            'telefono_madre' => 'nullable|string|max:15',
            'documento_tipo' => 'nullable|string|max:50',
            'documento_numero' => 'nullable|string|max:50|unique:registro_estudiantes,documento_numero,' . $id,
        ]);

        $estudiante = Estudiante::findOrFail($id);
        $estudiante->update($request->all());

        return redirect()->route('admin.estudiantes.index');
    }

    // Eliminar un estudiante
    public function destroy($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('admin.estudiantes.index');
    }
}

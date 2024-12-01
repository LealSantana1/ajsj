<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Estudiante;
use App\Models\Curso;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    // Mostrar el formulario para crear una nueva asistencia
    public function create()
    {
        $estudiantes = Estudiante::all();  // Obtener todos los estudiantes
        $cursos = Curso::all();  // Obtener todos los cursos

        return view('asistencias.create', compact('estudiantes', 'cursos'));
    }

    // Guardar una nueva asistencia en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:registro_estudiantes,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        Asistencia::create($request->all());  // Crear nueva asistencia

        return redirect()->route('admin.asistencias.index')->with('success', 'Asistencia registrada con éxito.');
    }

    // Mostrar todas las asistencias
    public function index()
    {
        $asistencias = Asistencia::with(['estudiante', 'curso'])->get();  // Obtener todas las asistencias con estudiante y curso
        return view('asistencias.index', compact('asistencias'));
    }

    // Mostrar el formulario para editar una asistencia
    public function edit($id)
    {
        $asistencia = Asistencia::findOrFail($id);  // Obtener la asistencia por su ID
        $estudiantes = Estudiante::all();  // Obtener todos los estudiantes
        $cursos = Curso::all();  // Obtener todos los cursos

        return view('asistencias.edit', compact('asistencia', 'estudiantes', 'cursos'));
    }

    // Actualizar la información de la asistencia
    public function update(Request $request, $id)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:registro_estudiantes,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        $asistencia = Asistencia::findOrFail($id);  // Obtener la asistencia por su ID
        $asistencia->update($request->all());  // Actualizar la asistencia

        return redirect()->route('admin.asistencias.index')->with('success', 'Asistencia actualizada con éxito.');
    }

    // Eliminar una asistencia
    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);  // Obtener la asistencia por su ID
        $asistencia->delete();  // Eliminar la asistencia

        return redirect()->route('admin.asistencias.index')->with('success', 'Asistencia eliminada con éxito.');
    }
}

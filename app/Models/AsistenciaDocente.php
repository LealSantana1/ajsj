<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaDocente extends Model
{
    use HasFactory;

    protected $table = 'asistencias_docentes'; // Nombre de la tabla

    protected $fillable = ['docente_id', 'fecha', 'estado']; // Campos asignables masivamente

    // Relación: una asistencia pertenece a un docente
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'registro_estudiantes';  // Nombre de la tabla

    protected $fillable = [
        'nombre_completo',
        'direccion',
        'telefono',
        'correo_electronico',
        'grado',
        'seccion',
        'fecha_ingreso',
        'promedio',
        'nombre_padre',
        'nombre_madre',
        'telefono_padre',
        'telefono_madre',
        'documento_tipo',
        'documento_numero',
    ];

    // Relación con otras tablas (si es necesario)
    // Por ejemplo, si tienes una relación con otra tabla llamada "asistencias"
    // public function asistencias() {
    //     return $this->hasMany(Asistencia::class);
    // }


public function notas()
    {
        return $this->hasMany(Nota::class, 'registro_estudiante_id');
    }
}

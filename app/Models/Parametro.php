<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Parametro
 *
 * @property $id
 * @property $fecha
 * @property $hora
 * @property $ce
 * @property $ph
 * @property $temp_ambiente
 * @property $temp_solucion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Parametro extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fecha', 'hora', 'ce', 'ph', 'temp_ambiente', 'temp_solucion'];


}

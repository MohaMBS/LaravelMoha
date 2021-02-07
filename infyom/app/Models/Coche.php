<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Coche
 * @package App\Models
 * @version February 7, 2021, 5:40 pm UTC
 *
 * @property string $marca
 * @property string $modelo
 * @property string $fecha
 * @property integer $id_cilinete
 */
class Coche extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'coches';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'marca',
        'modelo',
        'fecha',
        'id_cilinete'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'marca' => 'string',
        'modelo' => 'string',
        'fecha' => 'date',
        'id_cilinete' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'marca' => 'required|string',
        'modelo' => 'required|string',
        'fecha' => 'required',
        'deleted_at' => 'nullable',
        'updated_at' => 'nullable',
        'id_cilinete' => 'nullable|integer'
    ];

    
}

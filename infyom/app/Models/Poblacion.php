<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Poblacion
 * @package App\Models
 * @version February 8, 2021, 6:03 pm UTC
 *
 * @property string $ciudad
 * @property integer $poblacion
 * @property string $cp
 */
class Poblacion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'poblaciones';
    public $timestamps =false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'ciudad',
        'poblacion',
        'cp'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ciudad' => 'string',
        'poblacion' => 'integer',
        'cp' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ciudad' => 'required|string|max:150',
        'poblacion' => 'required|integer',
        'cp' => 'required|string|max:10'
    ];

    
}

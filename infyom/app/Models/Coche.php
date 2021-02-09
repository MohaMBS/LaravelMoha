<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Coche
 * @package App\Models
 * @version February 8, 2021, 5:55 pm UTC
 *
 * @property \App\Models\Ciliente $idCiliente
 * @property string $marca
 * @property string $modelo
 * @property string|\Carbon\Carbon $fecha
 * @property integer $id_ciliente
 */
class Coche extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'coches';
    public $timestamps =false;
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'marca',
        'modelo',
        'fecha',
        'id_ciliente'
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
        'fecha' => 'datetime',
        'id_ciliente' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'marca' => 'required|string|max:150',
        'modelo' => 'required|string|max:150',
        'fecha' => 'required',
        'id_ciliente' => 'required|integer',
        'updated_at' => 'nullable',
        'created_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function idCiliente()
    {
        return $this->belongsTo(\App\Models\Ciliente::class, 'id_ciliente');
    }
}

<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Golosinas
 * @package App\Models
 * @version March 15, 2021, 4:45 pm UTC
 *
 * @property string $sabor
 * @property string $calorias
 * @property string $precio
 */
class Golosinas extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'golosinas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'sabor',
        'calorias',
        'precio'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sabor' => 'string',
        'calorias' => 'string',
        'precio' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sabor' => 'required|string|max:255',
        'calorias' => 'required|string|max:255',
        'precio' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}

<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Ciliente
 * @package App\Models
 * @version February 7, 2021, 6:12 pm UTC
 *
 * @property string $nom
 * @property string $cognom
 * @property string $nif
 */
class Ciliente extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cilientes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nom',
        'cognom',
        'nif'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'cognom' => 'string',
        'nif' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'required|string|max:99',
        'cognom' => 'required|string|max:99',
        'nif' => 'required|string|max:9'
    ];

    
}

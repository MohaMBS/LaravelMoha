<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use \Illuminate\Http\Response; 

class Llibre extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'llibres';//se que no fa falta pero ho faig...

   
}

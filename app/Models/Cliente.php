<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey = 'id_cliente';
    use HasFactory;
    protected $fillable = ['documento_identidad','nombre_cliente','cliente_id','created_at'];
}

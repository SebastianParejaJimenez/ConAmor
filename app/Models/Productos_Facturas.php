<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura_Productos extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_productos_factura';
    protected $fillable = ['total_producto', 'cantidad'];
}

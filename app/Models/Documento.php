<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $primaryKey = 'id_documento';
    use HasFactory;
    protected $fillable = ['nombre','documento','user_id'];
}

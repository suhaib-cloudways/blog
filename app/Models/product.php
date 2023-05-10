<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
   protected $fillable = [
    'notes', 'notes price', 'notes description'
   ];
}

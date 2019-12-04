<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
     'name'
    ]; 
    protected $table='collections';  
}

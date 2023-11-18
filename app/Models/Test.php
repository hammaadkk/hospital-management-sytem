<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
       // Assuming 'tests' is the table name
       protected $table = 'tests';

       public function reports()
       {
           return $this->hasMany(Report::class);
       }
}

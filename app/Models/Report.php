<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import the User model

class Report extends Model
{
    use HasFactory;

    // Define the inverse relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }
    // Assuming 'reports' is the table name
    protected $table = 'reports';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    
}

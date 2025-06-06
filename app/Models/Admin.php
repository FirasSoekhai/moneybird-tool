<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;
    
    
    public function user()
    {
        // Definieer de relatie met de User model
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

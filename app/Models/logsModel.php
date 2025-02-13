<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logsModel extends Model
{
    use HasFactory;

    protected $table = 'log'; // Ensure this matches your table name
    protected $fillable = ['user_id', 'description']; // Mass assignable fields

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

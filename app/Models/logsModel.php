<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class logsModel extends Model
{
    use HasFactory;

    protected $table = 'log';
    // Use 'Description' with capital D to match your DB column
    protected $fillable = ['user_id', 'Description', 'ip', 'device'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
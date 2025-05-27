<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logsModel extends Model
{
    use HasFactory;

    protected $table = 'log';
    protected $fillable = ['user_id', 'Description', 'ip', 'device'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

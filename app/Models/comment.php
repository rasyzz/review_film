<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id_comments';
    protected $fillable = ['comment', 'rating', 'id_user', 'id_film'];

    public function user()
    {
        return $this->belongsTo(user::class, 'id_user');
    }

    public function film()
    {
        return $this->belongsTo(film::class, 'id_film');
    }
}

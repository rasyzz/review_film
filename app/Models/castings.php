<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\film;

class castings extends Model
{
    use HasFactory;

    protected $table = 'castings';
    protected $primaryKey = 'id_castings';
    protected $fillable = ['stage_name', 'real_name', 'id_film'];

    public function film()
    {
        return $this->belongsTo(film::class, 'id_film');
    }
}

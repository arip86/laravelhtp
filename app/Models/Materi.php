<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelatihan;

class Materi extends Model
{
    use HasFactory;
   protected $table = 'materi';
   protected $fillable = 
    [
        'nama'
    ];
    public function pelatihan(){
        return $this->hasMany(Pelatihan::class);
    }
}

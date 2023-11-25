<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Board extends Model
{
    use HasFactory;

    protected $primaryKey = 'd_id';
    // pk 정의 (정의 하지 않았다면 'id'컬럼을 pk로 인식)
    protected $fillable = [
        'd_title',
        'd_content',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class CommunityBoard extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'community_board';
    protected $primaryKey = 'community_id';
    protected $fillable = [
        'user_id',
        'community_content',
    ];
}

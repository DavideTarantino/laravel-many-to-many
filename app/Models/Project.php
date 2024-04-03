<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner',
        'creation_date',
        'slug',
        'cover_image',
        'type_id'
    ];

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = ['category_id', 'title', 'slug', 'content', 'image', 'is_published'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    // Un article possède plusieurs commentaires
public function comments() {
    return $this->hasMany(Comment::class)->latest();
}
public function likes()
{
    return $this->hasMany(\App\Models\Like::class);
}
public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}
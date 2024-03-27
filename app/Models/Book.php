<?php

namespace App\Models;

use Ahmetsabri\FatihLaravelSearch\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    protected $appends = ['formatted_likes_count'];

    protected $searchable = ['title','user.name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function getFullImageUrlAttribute()
    {
        if ($this->image_url) {
            return asset('storage/'.$this->image_url);
        }

        return null;
    }

    public function formattedLikesCount(): Attribute
    {
        $likesCount = $this->loadCount('likes')->likes_count;

        return Attribute::make(
            get: fn () => $likesCount.' '.Str::plural('like', $likesCount)
        );
    }

    public function casts(): array
    {
        return [
            'is_public' => 'bool'
        ];
    }

    public function scopeByPublic(Builder $builder, bool $isPublic): Builder
    {
        return $builder->where('is_public', $isPublic);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory;

    protected const LENGTH_CODE = 6;

    protected $fillable = [
        'url',
        'access_count',
    ];

    protected $guarded = [
        'url',
        'code',
    ];

    protected $appends = ['redirect_from'];

    protected $hidden = ['user_id', 'session_id', 'redirect_from'];

    public function getRedirectFromAttribute(): string
    {
        return url($this->code);
    }

    public static function generateCode()
    {
        $code = Str::random(static::LENGTH_CODE);
        $isExists = static::where('code', $code)->exists();

        if ($isExists) {
            return static::generateCode();
        }

        return $code;
    }

    public function incrementCount()
    {
        return $this->increment('access_count');
    }

    public function scopeWhereOwner(Builder $query): void
    {
        if (auth()->check()) {
            $query->where('user_id', auth()->id());
        } else {
            $query->where('session_id', session()->id());
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $link) {
            $link->code = static::generateCode();

            if (auth()->check()) {
                $link->user_id = auth()->id();
            } else {
                $link->session_id = session()->id();
            }
        });
    }

    public function isOwner()
    {
        if (auth()->check()) {
            return auth()->id() === $this->user_id;
        }

        return session()->id() === $this->session_id;
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Link extends Model
{
    protected const LENGTH_CODE = 6;

    protected $fillable = [
        'link',
        'access_count',
    ];

    protected $guarded = [
        'link',
        'code',
    ];

    protected $appends = ['redirect_from'];

    protected $hidden = ['user_id', 'session_id'];

    public function getRedirectFromAttribute(): string
    {
        return url($this->code);
    }

    public static function generateCode()
    {
        return Str::random(static::LENGTH_CODE);
    }

    public function incrementCount()
    {
        return $this->increment('access_count');
    }

    public function scopeWhereOwner(Builder $query): void
    {
        $query->where('user_id', '=', Auth::id())
            ->orWhere('session_id', '=', session()->id());
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Link $link) {
            $link->code = static::generateCode();

            if (Auth::check()) {
                $link->user_id = Auth::id();
            } else {
                $link->session_id = session()->id();
            }
        });
    }
}

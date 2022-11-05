<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bienes extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'articulo',
        'descripcion',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_id'
    ];


    /**
     * Serialize model to return user data
     *
     * @return array
     */
    public function serialize()
    {
        return [
            'id'          => $this->id,
            'articulo'    => $this->articulo,
            'descripcion' => $this->descripcion,
            'user'        => $this->user
        ];
    }


    /**
     * Return user owner
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

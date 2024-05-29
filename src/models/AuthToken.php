<?php

class AuthToken extends Model
{
    protected $table = 'auth_tokens';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ... (Otros métodos de la clase AuthToken, como 'create', 'invalidate', etc.)
}
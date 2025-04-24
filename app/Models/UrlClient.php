<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlClient extends Model
{
    protected $fillable = [
        'url',
        'id_client',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
}

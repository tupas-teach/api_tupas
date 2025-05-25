<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['client_id', 'name', 'description', 'start_date', 'end_date', 'status'];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function materials() {
        return $this->hasMany(Material::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}

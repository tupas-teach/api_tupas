<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'project_id',
        'amount',
        'payment_method',
        'payment_date',
        'reference',
        'status'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

<?php

namespace App\Models;

use App\Models\Admin\CompanyResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(CompanyResource::class);
    }
}

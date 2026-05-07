<?php

namespace App\Models\Admin;

use App\Enums\CompanyType;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyResource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'email',
        'active',
        'founded_at',
        'last_audit_at',
        'settings',
        'type',
        'category_id',
    ];

    protected $casts = [
        'active' => 'boolean',
        'founded_at' => 'date',
        'last_audit_at' => 'datetime',
        'settings' => 'array',
        'type' => CompanyType::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

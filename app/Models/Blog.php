<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use Auditable;

    public const STATUS_SELECT = [
        'active'   => 'Active',
        'inactive' => 'Inactive',
    ];

    public $table = 'blogs';

    public static $search = [
        'title',
    ];

    public $orderable = [
        'id',
        'title',
        'status',
        'content',
    ];

    public $filterable = [
        'id',
        'title',
        'status',
        'content',
    ];

    protected $fillable = [
        'title',
        'status',
        'content',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

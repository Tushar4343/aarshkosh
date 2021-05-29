<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aarshbook extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'aarshbooks';

    public static $searchable = [
        'aarsh_book',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'language_id',
        'aarsh_book',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function aarshBookAarshgranths()
    {
        return $this->hasMany(Aarshgranth::class, 'aarsh_book_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

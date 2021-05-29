<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aarshgranth extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'aarshgranths';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'aarsh_book_id',
        'arshbook_no',
        'arshbook_title',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function granthTitleAarshchapters()
    {
        return $this->hasMany(Aarshchapter::class, 'granth_title_id', 'id');
    }

    public function aarsh_book()
    {
        return $this->belongsTo(Aarshbook::class, 'aarsh_book_id');
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

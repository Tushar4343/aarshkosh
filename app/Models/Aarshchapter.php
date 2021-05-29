<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aarshchapter extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'aarshchapters';

    public static $searchable = [
        'arshchapter_no',
        'arshchapter_title',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'granth_title_id',
        'arshchapter_no',
        'arshchapter_title',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function chapterTitleAarshDescs()
    {
        return $this->hasMany(AarshDesc::class, 'chapter_title_id', 'id');
    }

    public function granth_title()
    {
        return $this->belongsTo(Aarshgranth::class, 'granth_title_id');
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

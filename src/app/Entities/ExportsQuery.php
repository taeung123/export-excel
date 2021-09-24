<?php

namespace VCComponent\Laravel\Export\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ExportsQuery extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'export_query';
    protected $fillable = [
        'slug',
        'query'
    ];
}

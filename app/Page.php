<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;
    public $translatable = ['name','content'];
    public function children() {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
    protected $table = 'pages';




}

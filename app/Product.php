<?php

namespace App;

use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use Mediable;
    use HasTranslations;
    use SoftDeletes;
    public $translatable = ['name', 'sh_desc', 'desc'];
    protected $fillable =['slug'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::Slug($value);
    }

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'product_cat_id');
    }
    public function parentCategory()
    {
        return $this->belongsTo(CategoryProduct::class, 'parent_cat_id');
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'product_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacher_courses','product_id','user_id');
    }
    public function getDiscountAttribute()
    {
        if ($this->start_date < Carbon::now()->format('Y-m-d H:i:s') && $this->end_date > Carbon::now()->format('Y-m-d H:i:s')) {
            return $this->discountPrice;
        } else {
            return 0;
        }
    }
}

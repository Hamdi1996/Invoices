<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'description',
        'section_id'
    ];
    // OR
    // protected $guarded=[];

    public function SectionRelation()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
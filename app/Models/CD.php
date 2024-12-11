<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CD extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'description',
        'price',
        'stock',
        'datePublished',
        'genre',
        'onlineLink',
        'catalogue_type'
    ];

    public $timestamps = false;
    public $updated_at = false;

    public function borrowedItems()
{
    return $this->morphMany(BorrowedItem::class, 'borrowable');
}

}

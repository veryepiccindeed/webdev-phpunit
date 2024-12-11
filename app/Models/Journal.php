<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
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
        'volume',
        'series',
        'number',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalYearProject extends Model
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
        'stock',
        'datePublished',
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

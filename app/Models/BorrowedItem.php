<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedItem extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'borrower_id',
        'borrowable_id',
        'borrowable_type',
        'borrowed_at',
        'due_date'

    ];

    public function borrowable()
    {
        return $this->morphTo();
    }
}

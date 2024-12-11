<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollectionUpdateRequest extends Model
{

    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'catalogue_type',
        'catalogue_id',
        'librarian_id',
        'update_data',
        'status'
    ];

    // public $timestamps = false;
    // public $updated_at = false;
    // public $created_at = false;
    
    public function librarian()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function catalogue()
    {
        return $this->morphTo(); // For polymorphic relationship
    }
}

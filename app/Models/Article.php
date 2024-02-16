<?php

namespace App\Models;

use App\Events\ArticleCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    /** 
     * Enable mass-assignment for those attributes
     */
    protected $fillable = [
        'title',
        'content',
        'category',
        'cover',
        'updated_at',
    ];

    /** 
     * Used to dispatch an event when creating a new Article
     */
    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
    ];

    /**
     * Adding a "belongs to" (User) relationship to the Article 
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}

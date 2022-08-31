<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    protected $fillable = ['article_url', 'comment', 'user_id'];

    /**
     * This method is for foreign table relationship
     * It represents user who posted the comment, and allows you to retrieve the user's details
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

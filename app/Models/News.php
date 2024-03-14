<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getImage()
    {
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return '/storage/' . $this->image;
    }
}

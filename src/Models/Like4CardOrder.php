<?php

namespace CodeBugLab\Like4Card\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CodeBugLab\Like4Card\Database\Factories\Like4CardOrderFactory as OrderFactory;
use CodeBugLab\Like4Card\Models\Like4CardSerial as Serial;

class Like4CardOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return OrderFactory::new();
    }

    public function serials()
    {
        return $this->hasMany(Serial::class);
    }
}

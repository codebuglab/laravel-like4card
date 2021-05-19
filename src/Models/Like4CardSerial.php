<?php

namespace CodeBugLab\Like4Card\Models;

use Illuminate\Database\Eloquent\Model;
use CodeBugLab\Like4Card\Models\Like4CardOrder as Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CodeBugLab\Like4Card\Models\Like4CardProduct as Product;
use CodeBugLab\Like4Card\Database\Factories\Like4CardSerialFactory as SerialFactory;

class Like4CardSerial extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * decrypting the `serialCode`
     *
     * @return string
     */
    public function decryptSerialCode()
    {
        $secret_key = 't-3zafRa';
        $secret_iv = 'St@cE4eZ';
        $encrypt_method = 'AES-256-CBC';
        $key = hash('sha256', $secret_key);

        //iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        return openssl_decrypt(base64_decode($this->serial_code), $encrypt_method, $key, 0, $iv);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'like4_card_product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'like4_card_order_id');
    }

    protected static function newFactory()
    {
        return SerialFactory::new();
    }
}

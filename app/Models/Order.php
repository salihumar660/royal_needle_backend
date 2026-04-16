<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'attachments' => 'array',
    ];
    protected $append = ['due'];
    protected $table = 'order';
    
    protected $fillable = [
        'naap_book_id',
        'status',
        'order_date',
        'original_amount',
        'paid_amount',
        'discount_amount',
        'payment_method',
        'attachments'
    ];
    //Due attribute 
    public function getDueAttribute() {
        return max(0, $this->original_amount - $this->paid_amount - $this->discount_amount);
    }
    public function naapBook() {
        return $this->belongsTo(NaapBook::class);
    }
}

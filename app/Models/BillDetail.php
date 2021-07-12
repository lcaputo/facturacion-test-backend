<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'bills_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'active',
        'bill_id',
        'product_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function Products() {
        return $this->hasMany('App\Models\Product');
    }

    public function bills() {
        return $this->hasMany('App\Models\Bill');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['customer_name',  'customer_username',  'customer_password','customer_email','customer_address','customer_phone'];
 
    protected $primaryKey = 'customer_id';
 	protected $table = 'tbl_customer';
}

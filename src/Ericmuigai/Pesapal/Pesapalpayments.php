<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 6/13/14
 * Time: 5:17 PM
 */

namespace Ericmuigai\Pesapal;

use Illuminate\Database\Eloquent\Model;
class Pesapalpayments extends Model {
       public $table = "pesapalpayments";
       protected $fillable = ['tracking_id','payment_method',
           'description',
           'currency',
           'user',
           'first_name',
           'last_name',
           'email',
           'phone_number',
           'amount',
           'reference',
           'type',
           'enabled',
           'updated_at',
       ];
} 
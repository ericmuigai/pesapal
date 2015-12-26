<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 12/26/15
 * Time: 4:46 PM
 */

namespace Ericmuigai\Pesapal;
use Illuminate\Database\Eloquent\Model;

class PesapalpaymentsTransactions extends Model
{
    public $table= 'pesapal_payments_transactions';
    protected $fillable = ['status','tracking_id','reference','data'];
}
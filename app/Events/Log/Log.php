<?php
/**
 * Created by PhpStorm.
 * User: danon
 * Date: 7/4/2017
 * Time: 11:21 PM
 */

namespace App\Events\Log;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class Log extends Event
{

    use SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}
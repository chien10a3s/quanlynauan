<?php
/**
 * Created by PhpStorm.
 * User: danon
 * Date: 7/4/2017
 * Time: 11:28 PM
 */

namespace App\Listeners\Log;

use App\Events\Log\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogEventListener
{
    public function onLog($events)
    {
        DB::beginTransaction();
        try {
            $data = $events->data;
            $data_insert = array();
            $data_insert['table'] = $data['table'];
            $data_insert['action_type'] = $data['action_type'];
            $data_insert['item_id'] = $data['item_id'];
            $data_insert['kitchen_id'] = $data['kitchen_id'];
            $data_insert['data'] = json_encode($data['data']);
            $data_insert['created_by'] = Auth::user()->id;
            $data_insert['updated_by'] = Auth::user()->id;
            DB::table('logs')->insert($data_insert);
        } catch (\Exception $e) {
            DB::rollback();
        }
        DB::commit();
    }

    public function subscribe($events)
    {
        $events->listen(Log::class, 'App\Listeners\Log\LogEventListener@onLog');
    }
}

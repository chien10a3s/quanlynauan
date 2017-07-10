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
            //Check last update by item_id (id_daily_meal)
            $data = $events->data;
            $data_insert = array();
            $data_insert['table'] = $data['table'];
            $data_insert['action_type'] = $data['action_type'];
            $data_insert['item_id'] = $data['item_id'];
            $data_insert['kitchen_id'] = $data['kitchen_id'];
            $array_save = array();
            $array_save['minus_money'] = $data['minus_money'];
            $array_save['last_money'] = $data['last_money'];
            $array_save['detail'] = $data['data'];
            $data_insert['data'] = json_encode($array_save);
            $data_insert['is_last'] = 1;
            $data_insert['created_by'] = Auth::user()->id;
            $data_insert['updated_by'] = Auth::user()->id;
            $data_insert['created_at'] = Carbon::now();
            $data_insert['updated_at'] = Carbon::now();
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

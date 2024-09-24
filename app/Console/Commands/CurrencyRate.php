<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\CurrencyModel;
use App\Models\CurrencyRateModel;
class CurrencyRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency_rate:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store currency rate';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $status = [];
        $arr_currency    = $arr_combination = [];
        $obj_currency    = CurrencyModel::select('id','code')->get();
        if($obj_currency)
        {
            $arr_currency = $obj_currency->toArray();
        }
        if(isset($arr_currency) && sizeof($arr_currency)>0)
        {
            for($i=0;$i<sizeof($arr_currency);$i++)
            {
                $from_currency_code    = $arr_currency[$i]['code'];
                $from_currency_id      = $arr_currency[$i]['id'];
                foreach($arr_currency as $key => $value) 
                {
                    $to_currency_code  = $value['code'];
                    $to_currency_id    = $value['id'];
                    if($from_currency_code!=$to_currency_code)
                    {
                       $conversion_rate   = currency_conversion_api($from_currency_code,$to_currency_code);
                       $obj_currency_rate = CurrencyRateModel::where('from_currency_id','=',$from_currency_id)
                                                           ->where('to_currency_id','=',$to_currency_id)
                                                           ->first();

                       if($obj_currency_rate)
                       {
                         $obj_currency_rate =$obj_currency_rate->update(['rate'=>$conversion_rate]); 
                       }
                       else
                       {
                            $arr_create = [];
                            $arr_create['from_currency_id']   = $from_currency_id;
                            $arr_create['from_currency_code'] = $from_currency_code;
                            $arr_create['to_currency_id']     = $to_currency_id;
                            $arr_create['to_currency_code']   = $to_currency_code;
                            $arr_create['rate']               = $conversion_rate;

                           $status =  CurrencyRateModel::create($arr_create);

                       }
                    }
                }
            }

        }
        if($status)
        {
            dd('Converstion rate added successfuly.');
        }
        else
        {
            dd('Converstion rate updated successfuly.');
        }
    }
    public function array_power_set($array) 
    {
        $results = array(array( ));
        foreach ($array as $element)
        {
            foreach ($results as $combination)
            {
                array_push($results,array_merge(array($element['code']),$combination));
            }
        }
        return $results;
    }
}

<?php
use App\Models\CurrencyModel;
use App\Models\CurrencyConversionModel;

function currency_conversion_api($from_currency, $to_currency)
{
	try {
		$from_Currency      = urlencode($from_currency);
		$to_Currency        = urlencode($to_currency);
		$query              =  "{$from_Currency}_{$to_Currency}";
		$conversion_api_url = trim("http://free.currencyconverterapi.com/api/v6/convert?q={$query}&compact=ultra");
		$json               = file_get_contents($conversion_api_url);
		$obj                = json_decode($json);
		$val                = floatval($obj->$query);
		return $val;
	} catch(\Exception $e) {
		return $e;
	}
}

// Currency Conversion
function currencyConverter($from_Currency, $to_Currency, $amount)
{
	$data = [];
	
	if ($from_Currency == null && $to_Currency == null && $amount == null) {
		return 0;
	} else {
		if ($from_Currency != $to_Currency) {
			$conversion_rate = Session::get('conversion_rates.'.$from_Currency.'_'.$to_Currency);
			// dd($conversion_rate);
		} else {
			$conversion_rate = 1;
		}
		$converted_amount = $conversion_rate * $amount;
		return $converted_amount;
	}
}

function currency_list()
{
	$currency_arr = [];
	$currency_obj = CurrencyModel::select('id', 'currency', 'currency_code')->get();
	
	if (isset($currency_obj) && count($currency_obj) > 0) {
		$currency_arr = $currency_obj->toArray();
	}
	
	return $currency_arr;
}

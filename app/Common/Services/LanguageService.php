<?php
namespace App\Common\Services;

use App\Models\LanguageModel;

use Session;

class LanguageService
{
    public function get_all_language()
    {
        $arr_lang = array();
        $obj_res  = LanguageModel::where('status','1')->get();
        if( $obj_res != FALSE)
        {
            $arr_lang = $obj_res->toArray();

        }
        return $arr_lang;
    }

    public function get_language()
    {
        $arr_language = array();
        $arr_language  = LanguageModel::where('status','1')->pluck('title');
        if(count($arr_language) > 0)
        {
            $arr_language = $arr_language->toArray();
        }
        return $arr_language;
    }

    public function arrange_locale_wise(array $arr_data)
    {
        if(isset($arr_data) && sizeof($arr_data)>0)
        {
            foreach ($arr_data as $key => $data)
            {
                unset($arr_data[$key]);
                $arr_data[$data['locale']] = $data;                    
            }

            return $arr_data;
        }
        else
        {
            return [];
        }
    }
}
?>
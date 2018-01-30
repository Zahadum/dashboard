<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CommonFunctions extends Controller
{
    //
    public static function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $headers = null;

        $rowData = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 0, $delimiter)) !== false)
            {

                if (!$headers) {
                    $headers = [];
                    $tempHeaders = $row;

                    foreach ($tempHeaders as $header) {

                        $header = str_replace('.','\\.',$header);
                        $headers[] = $header;
                    }
                } else {
                    $rowData[] = array_combine($headers, $row);
                }
            }

            fclose($handle);
        }

        $data = array('headers'=>$headers,'rows'=>$rowData);
        return $data;
    }
}

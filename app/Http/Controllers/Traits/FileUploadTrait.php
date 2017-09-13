<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Exception;
use Illuminate\Support\Facades\File;

trait FileUploadTrait
{
    public function saveFiles(Request $request)
    {
        try {
            $file = $this->generateFileName() . '.xlsx';
            $path = 'storage/app/users_excel_sheets/';
            $request->file('file')->storeAs('users_excel_sheets', $file);
            $excel_data = Excel::load($path . $file)->get();
            $data = array();
            if (!empty($excel_data) && $excel_data->count()) {
                foreach ($excel_data as $key => $value) {
                    $data[] = ['id' => $value->id, 'name' => $value->name, 'email' => $value->email];
                }
            }
            try {
                unlink($path = storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'users_excel_sheets' . DIRECTORY_SEPARATOR . $file);
            } catch (\Exception $e) {

            }
            return $data;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function generateFileName()
    {
        $time = Carbon::now();
        return (string)$time->toDateTimeString();
    }

    public function readFile($path)
    {
        try {
            $content = file_get_contents($path);
        } catch (\Exception $e) {
            return 'failed';
        }
        return $content;
    }


}

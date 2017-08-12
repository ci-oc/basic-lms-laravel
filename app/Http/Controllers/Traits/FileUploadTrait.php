<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Exception;

trait FileUploadTrait
{
    public function saveFiles(Request $request)
    {
        try {
            $file = $this->generateFileName() . '.xlsx';
            $path = 'storage/app/users_excel_sheets/';
            $request->file('file')->storeAs('users_excel_sheets', $file);
            $data = Excel::load($path . $file)->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $data[] = ['id' => $value->id, 'name' => $value->name, 'email' => $value->email];
                }
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
}

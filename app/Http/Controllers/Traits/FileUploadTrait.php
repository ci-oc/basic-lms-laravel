<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Exception;
use App\Diff;
use Symfony\Component\Filesystem\Filesystem;
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

    public static function compareFiles($program1_path, $program2_path)
    {
        try {
            $diff = new Diff;
            $diff->file1 = $program1_path;
            $diff->file2 = $program2_path;
            $isDifferent = $diff->isDifferent();
            $isSame = $diff->isSame();

            // return
            return [
                'judge' => [
                    'output_file_difference' => $isDifferent,
                    'output_file_similarity' => $isSame
                ]
            ];

        } catch (Exception $e) {
            return [
                'judge' => false
            ];
        }
    }

    public static function saveOutput($folder_path, $content, $filename = null)
    {
        // check if file is not empty
        if (empty($content)) {
            return [
                'success' => false,
                'message' => "Content can't be empty."
            ];
        }

        $filesystem = new Filesystem();
        $path = $folder_path . 'output/';

        // check file existence
        if (!$filesystem->exists($path)) {

            try {
                $filesystem->mkdir($path);
            } catch (Exception $e) {
                return [
                    'success' => false,
                    'message' => "Can't create path to save file",
                    'detail' => [
                        'reason' => $e->getMessage()
                    ]
                ];
            }

        }
        try {

            $filename = ($filename === null) ? 'output_' . rand() . time() : $filename;
            $script = $path . $filename . '.txt';

            // save to files
            $filesystem->dumpFile($script, $content);

            $response = [
                'success' => true,
                'message' => 'File saved!',
                'detail' => [
                    'filename' => $filename . '.txt',
                    'path' => $path,
                    'extension' => 'txt'
                ]
            ];
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Exception Error',
                'detail' => [
                    'reason' => $e->getMessage()
                ]
            ];
        }

        return $response;
    }
}

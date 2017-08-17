<?php
/**
 * Created by PhpStorm.
 * User: andrewnagyeb
 * Date: 8/15/17
 * Time: 12:34 AM
 */

namespace App;


class Diff
{
    public $file1;
    public $file2;

    /**
     * Check if file is similar
     *
     * @return bool
     */
    public function isSame()
    {
        $diff = dirname(__FILE__) . '/bashcode/diff.sh';

        $diff_query = $diff . ' ' . $this->file1 . ' ' . $this->file2;
        exec($diff_query, $diff_response);

        if (empty($diff_response)) {
            // if diff.sh not return anything a.k.a empty then it means the output file is not different
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }


    /**
     * Check if file is differ
     *
     * @return bool
     */
    public function isDifferent()
    {
        $diff = dirname(__FILE__) . '/../bashcode/diff.sh';

        $diff_query = $diff . ' ' . $this->file1 . ' ' . $this->file2;
        exec($diff_query, $diff_response);

        if (empty($diff_response)) {
            // if diff.sh not return anything a.k.a empty then it means the output file is not different
            $status = false;
        } else {
            $status = true;
        }
        return $status;
    }
}
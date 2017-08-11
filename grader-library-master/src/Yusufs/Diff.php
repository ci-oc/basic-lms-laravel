<?php 

namespace Yusufs;
use Symfony\Component\Filesystem\Filesystem;

/*
 |----------------------------------------------------------
 | Diff Class
 |----------------------------------------------------------
 |
 | an extension to check wether two files is same or not
 | 
 | Author       : Yusuf Syaifudin
 | Author email : yusuf.syaifudin@gmail.com
 | Author url   : http://yusyaif.com/
 | Created at   : Wednesday, July 2, 2014
 |
 |----------------------------------------------------------
*/

class Diff {

	public $file1;
	public $file2;

	/**
	 * Check if file is similar
	 *
	 * @return bool
	 */
	public function isSame()
	{
		$diff 	= dirname(__FILE__) . '/../bashcode/diff.sh';

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
		$diff 	= dirname(__FILE__) . '/../bashcode/diff.sh';

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
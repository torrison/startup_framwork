<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Inside Test Model
 *
 * @author Alex Torrison
 */
class Main_Model extends CI_Model
{

	public function index()
	{
		
		
		ob_start();
?>

Here Data from models/inside/custom_interfaces/$interface/main_model.php

<?php
		$date = ob_get_clean();

		return $date;
		
	}

	
// End Class

}

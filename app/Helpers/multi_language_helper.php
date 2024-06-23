<?php
use Config\Services;

if (!function_exists('get_phrase')) {
	function get_phrase($phrase = '')
	{
		$db = \Config\Database::connect();
		$session = Services::session();

		$current_language = $session->get('language');
		if (!$current_language) {
			$current_language = $db->table('settings')->where('type', 'language')->get()->getRow()->description;
			$session->set('current_language', $current_language);
		}

		if ($current_language == '') {
			$current_language = 'english';
			$session->set('current_language', $current_language);
		}


		/** insert blank phrases initially and populating the language db 
			  $check_phrase	=	$CI->db->get_where('language' , array('phrase' => $phrase))->row()->phrase;
			  if ( $check_phrase	!=	$phrase)
				  $CI->db->insert('language' , array('phrase' => $phrase)); ***/



		/** delete already phrases  
				 $check_phrase	=	$CI->db->get_where('language' , array('phrase' => $phrase))->row()->phrase;
				 if ( $check_phrase	==	'Teachers')
				 $CI->db->delete('language' , array('phrase' => $phrase)); ***/


		$query = $db->table('language')->where('phrase', $phrase)->get();
		$row = $query->getRow();

		if (isset($row->$current_language) && $row->$current_language != "") {
			return $row->$current_language;
		} else {
			return ucwords(str_replace('_', ' ', $phrase));
		}
	}
}

<?php

class db_connection{
	private $conn;
	public function __construct(){

		global $conn;
		$servername = "localhost";
		$username = "root"; //u956940883_root
		$password = ""; //u[BS1[0xG
		$db_name = "biophp"; // u956940883_biophp

		$this->conn = mysqli_connect($servername, $username, $password);

		mysqli_select_db($this->conn,$db_name);
	}

	public function call_db(){
		return $this->conn;
	}

	public function get_date(){
		return date('Y-m-d H:i:s');
	}

	public function query($query){
		return mysqli_query($this->call_db(), $query);
		
	}
	
	public function sanitize($str)
    {
        $str = htmlspecialchars($str);
        $str = mysqli_real_escape_string($this->call_db(),$str);
        return $str;
    }

	public function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);		
		if ($diff->y < 1 && $diff->m < 1 && $diff->d < 1 && $diff->h < 2) {
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
	
			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'minute',
				's' => 'second',
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}

            if (!$full) $string = array_slice($string, 0, 1);
                return  $string ? implode(', ', $string).' ago'  : 'juste maintenant';
		}elseif($diff->y < 1 && $diff->m < 1 ){
			return date(("H:i d M"),strtotime($datetime));
		}else{
			setlocale (LC_TIME, 'fr_FR.utf8','fra');
			return date(("H:i d M, Y"),strtotime($datetime));
		}
	}
}
?>

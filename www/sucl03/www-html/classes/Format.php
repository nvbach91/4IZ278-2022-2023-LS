<?php
// crossmile @ LXSX file:www-html/classes/Format.php

class Format
{
	public function __construct() 
	{
	}

	public static function genderToText($gender)
	{
		return ($gender == null ? 'všichni' : ($gender == 1 ? 'ženy' : 'muži'));
	}

	public static function toDate($string, $date)
	{
		return (date($string, strtotime($date)));
	}

	public static function toFullName($last_name, $first_name)
	{
		return (htmlspecialchars($last_name, ENT_QUOTES) . ' ' . htmlspecialchars($first_name, ENT_QUOTES));
	}

	public static function toFullNamePopover($last_name, $first_name, $reg_note, $show)
	{
		$full_name = self::toFullName($last_name, $first_name);
		if (!$show || empty($reg_note))
			return ($full_name);
		else
			return ('<span class="dotted-underline" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="' . $reg_note . '">' . $full_name . '</span>');
	}

	public static function toFullDiscipline($reg_arr)
	{
		return ($reg_arr['name'] . ', ' . $reg_arr['description'] . ', ' . self::genderToText($reg_arr['gender']));
	}
	public static function toFullDiscipline2($reg_arr)
	{
		return ($reg_arr['name'] . ', ' . $reg_arr['description'] . ', ' . $reg_arr['gender_name']);
	}

	public static function toClubPopover($club, $clubs_cas_arr)
	{
		if (in_array($club, $clubs_cas_arr)) {
			return ('<span class="dotted-underline" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="' . array_search($club, $clubs_cas_arr) . '">' . htmlspecialchars($club, ENT_QUOTES) . '</span>');
		} else if (array_key_exists($club, $clubs_cas_arr)) {
			return ('<span class="dotted-underline" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="' . $clubs_cas_arr[$club] . '">' . htmlspecialchars($club, ENT_QUOTES) . '</span>');
		} else {
			return (htmlspecialchars($club, ENT_QUOTES));
		}
	}

	public static function toRacePopover($race_name, $reg_note = '')
	{
		if (empty($reg_note))
			return ($race_name);
		else
			return ('<span class="dotted-underline" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="' . $reg_note . '">' . $race_name . '</span>');
	}
	
	public static function toACLPopover($app_acl, $acl)
	{
		$str_arr = [];
		foreach ($app_acl as $key => $val) {
			if ($val & $acl)
				$str_arr[] = $key;
		}
		if (empty($str_arr))
			return ($acl);
		else
			return ('<span class="dotted-underline" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="' . implode(', ', $str_arr) . '">' . $acl . '</span>');
	}
	
	public static function toStatusPopover($status)
	{
		static $status_arr = [
			0 => 'new',
			1 => 'confirmed',
			2 => 'ready',
			3 => 'suspended'
		];
		return ('<span class="dotted-underline" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="' . $status_arr[$status] . '">' . $status . '</span>');
	}

	public static function registerButton($rs, $discipline_arr, $logged_user_arr) //TBD
	{
		$rs->userId = (!empty($logged_user_arr['user_id']) ? $logged_user_arr['user_id'] : 0);
		$rs->disciplineId = $discipline_arr['id'];
		if ($rs->isUserRegisterable())
			return ('<button class="btn btn-xs btn-success register" type="button" data-reg="' . $discipline_arr['id'] . '" data-user="' . $discipline_arr['user_id'] . '">&nbsp;&nbsp;&nbsp;Registrovat&nbsp;&nbsp;&nbsp;</button>');
		else if ($discipline_arr['user_registered'])
			return ('<button class="btn btn-xs btn-danger unregister" type="button" data-reg="' . $discipline_arr['registration_id'] . '" data-user="' . $discipline_arr['user_id'] . '">Odregistrovat</button>');
		else
			return ('');
	}

	public static function showPopover($reg_arr, $app_acl, $logged_user_arr)
	{
		if (!empty($logged_user_arr['user_id'])
			&& ($reg_arr['user_id'] == $logged_user_arr['user_id']
				|| (!empty($logged_user_arr['user_acl']) && $logged_user_arr['user_acl'] & $app_acl['users_r'])
			)
		)
			return (true);
		else
			return (false);
	}
}
?>
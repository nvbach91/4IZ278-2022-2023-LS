<?php
// crossmile @ LXSX file:www-html/logins-list.php

// app init
require_once(__DIR__ . '/libs/init.php');

// auth
$_page_protected = true;
$_required_acl = $app_acl['login'];
require_once(__DIR__ . '/libs/login-check.php');
$logged_user_arr = $as->getUser();

// formatting
require_once(__DIR__ . '/classes/Format.php');

// data processing
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['logins'])) {
	// user or admin list od logins (fallback to user)
	if ($_GET['logins'] == 'u' || !$as->aclCheck($app_acl['admin'])) {
		$where = ' t1.user = ? ';
		$type = 'User';
		$user_id = ($as->aclCheck($app_acl['admin']) ? $_GET['id'] : $logged_user_arr['user_id']);
	} else { // all
		$where = ' 1 ';
		$type = 'All';
	}
	$logins_list = '';
	$sql = sprintf('SELECT ' .
		't1.login_type, COALESCE(t1.hostname, t1.ip_addr) AS hostname, t1.ip_addr, t1.port, t1.created, ' .
		'COALESCE(t1.country_name, "Unknown") AS country_name, ' .
		'COALESCE(t1.city_name, "Unknown") AS city_name, ' .
		't2.last_name, t2.first_name ' .
		'FROM users_logins t1 ' .
		'JOIN users t2 ON t2.id = t1.user ' .
		'WHERE ' . $where .
		'ORDER BY t1.created DESC ' .
		'LIMIT 15');
	$stmt = $db->prepare($sql);
	if ($type == 'User')
		$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
	$stmt->execute();
	// SSR version of data processing (usually there comes only JSON array construction and CSR)
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$popover_html = '
			<p>
				' . ($row['hostname'] != $row['ip_addr'] ? $row['hostname'] . '<br>' : '') . '
				' . $row['ip_addr'] . '
			</p>';
		$popover2_html = '
			<p>
				' . $row['country_name'] . '<br>
				' . $row['city_name'] . '
			</p>';
		$logins_list .= '
			<tr>
				<td>' . Format::toDate('d.m.Y H:i', $row['created']) . '</td>
				<td>' . $row['login_type'] . '</td>
				<td>' . Format::toFullName($row['last_name'], $row['first_name'])  . '</td>
				<td>
					<a href="#" title="Host" data-bs-toggle="popover" data-bs-html="true" data-bs-sanitize="false" data-bs-trigger="hover focus" data-bs-content="' . $popover_html . '">' . (strlen($row['hostname']) > 30 ? substr($row['hostname'], 0, 29) . '…' : $row['hostname']) . '</a>
				</td>
				<td>
					<a href="#" title="Geolocation" data-bs-toggle="popover" data-bs-html="true" data-bs-sanitize="false" data-bs-trigger="hover focus" data-bs-content="' . $popover2_html . '">' . $row['country_name'] . '</a>
				</td>
			</tr>
			';
	}
	$stmt = null;
	if (!empty($logins_list)) {
		$status = 'ok';
		$output = $logins_list;
	} else {
		$status = 'invalid';
		$output = '<p>Žádná přihlášení.</p>';
	}
	// returning JSON construct
	$result = [];
	$result['status'] = $status;
	$result['header'] = $type . ' logins';
	$result['output'] = $output;
	echo json_encode($result);
} else {
	$result = ['status' => 'err', 'output' => 'No valid data'];
	http_response_code(400);
	echo json_encode($result);
}

// clean-up
require(__DIR__ . '/libs/clean.php');
?>
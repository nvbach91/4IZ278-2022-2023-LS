<?php
// crossmile @ LXSX file:www-html/libs/clean.php

if (!empty($db))
	@$db = null;
if (!empty($redis))
	@$redis->close();
?>
<?php
$target = '/home/httpd/html/users/vitd04/sp/storage/app/public';
$shortcut = '/home/httpd/html/users/vitd04/sp/public/storage';
symlink($target, $shortcut);
$target2 = '/home/httpd/html/users/vitd04/sp/public';
$shortcut2 = '/home/httpd/html/users/vitd04/sp-api';
symlink($target2, $shortcut2);
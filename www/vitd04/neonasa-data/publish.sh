#!/bin/bash
rsync ./ vitd04@esotemp.vse.cz:/home/httpd/html/users/vitd04/neonasa-data -alz --delete --exclude-from=.rsync-exclude
<?php
define("FACEBOOK_APP_ID", getenv('FACEBOOK_APP_ID'));
define("FACEBOOK_APP_SECRET", getenv('FACEBOOK_APP_SECRET'));
define("FACEBOOK_CALLBACK_URL", getenv('FACEBOOK_CALLBACK_URL'));
define("FACEBOOK_GRAPH_VERSION", getenv('FACEBOOK_GRAPH_VERSION'));
const FACEBOOK_REQUIRED_CLAIMS = ['email', 'public_profile'];
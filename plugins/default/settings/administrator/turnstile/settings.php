<?php

$com = new OssnComponents;
$params = $com->getSettings('turnstile');
echo ossn_view_form('turnstile/admin', array(
    'action' => ossn_site_url() . 'action/turnstile/admin/settings',
	'params' => array('turnstile' => $params),
    'class' => 'ossn-admin-form'	
));
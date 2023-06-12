<?php
 $component = new OssnComponents;
 
 $site_key = input('turnstile_site_key');
 $secret_key = input('turnstile_secret_key');
 if(empty($site_key)){
	 ossn_trigger_message(ossn_print('turnstile:site_key:empty'), 'error');
	 redirect(REF);
 }else if(empty($secret_key)){
   ossn_trigger_message(ossn_print('turnstile:secret_key:empty'), 'error');
   redirect(REF);
 }
 $vars = array(
	'turnstile_site_key' => $site_key,
	'turnstile_secret_key' => $secret_key,
  );
 if($component->setSettings('turnstile', $vars)){
	 ossn_trigger_message(ossn_print('turnstile:saved'));
	 redirect(REF);
 } else {
	 ossn_trigger_message(ossn_print('turnstile:save:error'), 'error');
	 redirect(REF);	 
 }
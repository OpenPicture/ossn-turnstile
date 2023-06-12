<?php

$en = array(
  'turnstile' => 'CloudFlare Turnstile',
  'turnstile:text' => 'Please, accomplish the turnstile',
  'turnstile:error' => 'Invalid turnstile, please retry doing it again',
  'turnstile:com:site_key' => 'turnstile SITE_KEY',
  'turnstile:com:secret_key' => 'turnstile SECRET_KEY',
  'turnstile:com:note' => 'We need the API keys, go to <a href="https://dash.cloudflare.com/">https://dash.cloudflare.com/</a>. To get access this page, you will need to access your CloudFlare Account. Register your site name where this turnstile will be used. After that, paste both SECRET_KEY and SITE_KEY in each field here.',
  'turnstile:site_key:empty' => 'The SITE_KEY is empty.',
  'turnstile:secret_key:empty' => 'The SECRET_KEY is empty.',
  'turnstile:saved' => 'API keys stored sucessfully!.',
  'turnstile:save:error' => 'The API keys cannot be saved.',
);
ossn_register_languages('en', $en);
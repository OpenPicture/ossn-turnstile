<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

define('turnstile', ossn_route()->com . 'turnstile/');

/**
 * turnstile initialize
 *
 * @return void
 */
function turnstile_init()
{
  ossn_extend_view('forms/signup/before/submit', 'turnstile/view');
  ossn_extend_view('forms/resetlogin/before/submit', 'turnstile/view');
  ossn_register_callback('action', 'load', 'turnstile_check');
  ossn_register_com_panel('turnstile', 'settings');
  if(ossn_isAdminLoggedin()){
    ossn_register_action('turnstile/admin/settings', turnstile . 'actions/admin.php');
  }
}

/**
 * turnstile the actions which you wanted to validate
 *
 * @return array
 */
function turnstile_actions_validate()
{
  return ossn_call_hook('turnstile', 'actions', false, array(
    'user/register',
    'resetlogin'
  ));
}

/**
 * Validate the turnstile actions
 *
 * @param string $callback The callback type
 * @param string $type The callback type
 * @param array $params The option values
 *
 * @return string
 */
function turnstile_check($callback, $type, $params)
{
  $turnstile_data = input('cf-turnstile-response');
  if (isset($params['action']) && in_array($params['action'], turnstile_actions_validate()) && !turnstile_verify($turnstile_data)) {
    if ($params['action'] == 'user/register') {
      header('Content-Type: application/json');
      echo json_encode(array(
        'dataerr' => ossn_print('turnstile:error'),
      ));
      exit;
    } else {
      ossn_trigger_message(ossn_print('turnstile:error'));
      redirect(REF);
    }
  }
}

/**
 * Verify a captcha based on the input value entered by the user and the seed token passed.
 *
 * @param string $input_value
 * @return bool
 */
function turnstile_verify($input_value)
{
  ini_set('allow_url_fopen', 1);

  $turnstileCom = new OssnComponents();

  $turnstile = $turnstileCom->getSettings('turnstile');

  $vetParametros = array(
    "secret" => $turnstile->turnstile_secret_key,
    "response" => $input_value,
    "remoteip" => $_SERVER["REMOTE_ADDR"]
  );
  $curlturnstile = curl_init();
  curl_setopt($curlturnstile, CURLOPT_URL, "https://challenges.cloudflare.com/turnstile/v0/siteverify");
  curl_setopt($curlturnstile, CURLOPT_POST, true);
  curl_setopt($curlturnstile, CURLOPT_POSTFIELDS, http_build_query($vetParametros));
  curl_setopt($curlturnstile, CURLOPT_RETURNTRANSFER, true);
  $vetResposta = json_decode(curl_exec($curlturnstile), true);
  curl_close($curlturnstile);
  if (isset($vetResposta["success"]) && $vetResposta["success"]) {
    return true;
  } else {
    return false;
  }
}

ossn_register_callback('ossn', 'init', 'turnstile_init');
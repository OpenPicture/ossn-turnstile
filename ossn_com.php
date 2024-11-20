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
  ossn_extend_view('forms/admin/login', 'turnstile/view');    
  ossn_extend_view('forms/login2/before/submit', 'turnstile/view');
  ossn_extend_view('forms/signup/before/submit', 'turnstile/view');
  ossn_extend_view('forms/resetlogin/before/submit', 'turnstile/view');
  ossn_extend_view('forms/resetpassword/before/submit', 'turnstile/view');
  ossn_extend_view('forms/Contact/contactform/before/submit', 'turnstile/view');
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
    'admin/login',
    'user/login',
    'login2',
    'signup',
    'user/register',
    'resetlogin',
    'resetpassword',
    'Contact/contactmail'
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
      if ($params['action'] == 'administrator/login') {
      header('Content-Type: application/json');
      echo json_encode(array(
        'dataerr' => ossn_print('turnstile:error'),
      ));
      exit;
    } else {
      ossn_trigger_message(ossn_print('turnstile:error'));
      redirect(REF);
    };
    if ($params['action'] == 'login') {
      header('Content-Type: application/json');
      echo json_encode(array(
        'dataerr' => ossn_print('turnstile:error'),
      ));
      exit;
    } else {
      ossn_trigger_message(ossn_print('turnstile:error'));
      redirect(REF);
    };
    if ($params['action'] == 'user/login2') {
      header('Content-Type: application/json');
      echo json_encode(array(
        'dataerr' => ossn_print('turnstile:error'),
      ));
      exit;
    } else {
      ossn_trigger_message(ossn_print('turnstile:error'));
      redirect(REF);
    };
    if ($params['action'] == 'signup') {
      header('Content-Type: application/json');
      echo json_encode(array(
        'dataerr' => ossn_print('turnstile:error'),
      ));
      exit;
    } else {
      ossn_trigger_message(ossn_print('turnstile:error'));
      redirect(REF);
    };
    if ($params['action'] == 'user/register') {
      header('Content-Type: application/json');
      echo json_encode(array(
        'dataerr' => ossn_print('turnstile:error'),
      ));
      exit;
    } else {
      ossn_trigger_message(ossn_print('turnstile:error'));
      redirect(REF);
    };
  if ($params['action'] == 'resetlogin') {
    header('Content-Type: application/json');
    echo json_encode(array(
      'dataerr' => ossn_print('turnstile:error'),
    ));
    exit;
  } else {
    ossn_trigger_message(ossn_print('turnstile:error'));
    redirect(REF);
};
if ($params['action'] == 'resetpassword') {
  header('Content-Type: application/json');
  echo json_encode(array(
    'dataerr' => ossn_print('turnstile:error'),
  ));
  exit;
} else {
  ossn_trigger_message(ossn_print('turnstile:error'));
  redirect(REF);
};
if ($params['action'] == 'Contact/contactmail') {
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

  $verification_params = array(
        "secret" => $turnstile->turnstile_secret_key,
        "response" => $input_value,
        "remoteip" => $_SERVER["REMOTE_ADDR"]
    );

    $curl_verification = curl_init();
    curl_setopt($curl_verification, CURLOPT_URL, "https://challenges.cloudflare.com/turnstile/v0/siteverify");
    curl_setopt($curl_verification, CURLOPT_POST, true);
    curl_setopt($curl_verification, CURLOPT_POSTFIELDS, http_build_query($verification_params));
    curl_setopt($curl_verification, CURLOPT_RETURNTRANSFER, true);

    $verification_response = curl_exec($curl_verification);

    // Log the raw verification response for debugging.
    error_log('Turnstile Raw Verification Response: ' . $verification_response);

    $verification_response_decoded = json_decode($verification_response, true);

    if ($verification_response_decoded === null) {
        // Handle JSON decoding error
        error_log('Turnstile JSON Decoding Error: ' . json_last_error_msg());
    }

    curl_close($curl_verification);

    if (isset($verification_response_decoded["success"]) && $verification_response_decoded["success"]) {
        return true;
    } else {
        return false;
    }
}

ossn_register_callback('ossn', 'init', 'turnstile_init');

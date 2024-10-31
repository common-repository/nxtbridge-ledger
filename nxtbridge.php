<?php

/*
  Plugin Name: NXTBridge
  Plugin URI: https://nxter.org/nxtbridge
  Version: 1.3.0
  Author: scor2k 
  Description: Nxt Ledger on your Wordpress site without problems
  License: GPLv2 or later.
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
global $api;
global $app_version;

$app_version = '1.3.0'; // NOT FORGET TO CHANGE !!!

$api = '//api.nxter.org/v2';
#$api = 'http://python-srv:8000/v2';

/*****************************************************************************************************/
require ('config.php');                 // actions and registered scripts and hooks
/*****************************************************************************************************/
require('lib/tip.php');                 // Tip
require('ledger/main.php');             // Ledger
/*****************************************************************************************************/

add_filter('the_content', 'nxtbridge_tip');
add_action('wp_footer', 'nxtbridge_ledger_footer');

add_action('wp_ajax_nopriv_show_ledger', 'get_ledger_ajax');
add_action('wp_ajax_show_ledger', 'get_ledger_ajax');

add_action('wp_ajax_nopriv_send_broadcast', 'send_broadcast_ajax');
add_action('wp_ajax_send_broadcast', 'send_broadcast_ajax');

add_action('wp_ajax_nopriv_send_NXT', 'send_NXT_ajax');
add_action('wp_ajax_send_NXT', 'send_NXT_ajax');

function get_ledger_ajax() {
  $acc = ' ';

  if ( $_POST['account'] ) { $acc = $_POST['account']; }
  
  $wallet = new NXTBridgeWalletPage();
  $ledger = $wallet->show_ledger($acc);

  echo $ledger;

  wp_die();
}

function send_broadcast_ajax() {
  $tr = '';

  if ( $_POST['signedTransation'] ) { $tr = $_POST['signedTransation']; }

  $wallet = new NXTBridgeWalletPage();
  $result = $wallet->send_broadcast($tr);

  echo $result;

  wp_die();
}

function send_NXT_ajax() {
  $recipient = '';
  $amount = '';
  $account = '';
  $message = 'Sent using NXTBridge'; 

  if ( $_POST['account'] ) { $account = $_POST['account']; }
  if ( $_POST['recipient'] ) { $recipient = $_POST['recipient']; } 
  if ( $_POST['amount'] ) { $amount = $_POST['amount']; } 
  if ( $_POST['message'] ) { $message = $_POST['message']; }

  $wallet = new NXTBridgeWalletPage();
  $result = $wallet->send_NXT($recipient,$amount,$account,$message); 

  echo $result;

  wp_die();
}



?>

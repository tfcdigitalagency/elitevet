<?php
/**
 * File: email.php
 * Created on: 2013/06/23
 * Author: Lucdt
 * 
 */
 
$config['system_email'] = 'info@ncdeliteveterans.org';
$config['system_name'] = 'Elite Nor-Cal';
$config['smtp_account'] = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'smtp.sendgrid.net',
  'smtp_port' => 587,
  'smtp_crypto' => 'ssl',
  'smtp_user' => 'apikey',
  'smtp_pass' => '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',
  'mailtype'  => 'html',
  'newline'   => "\r\n",
  'charset'   => 'iso-8859-1'
);

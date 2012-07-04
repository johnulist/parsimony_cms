<?php

//General Config
define('PARSIMONY_VERSION','0.3');
define('BASE_PATH',str_replace('//','/',dirname($_SERVER['PHP_SELF']).'/'));

//Themes
$config['THEMEMODULE'] = 'core';
$config['THEME'] = 'parsidefault';  

//BDD
$config['db']['host'] = 'localhost';
$config['db']['port'] = '3306';
$config['db']['dbname'] = 'parsimony';
$config['db']['user'] = 'root';
$config['db']['pass'] = '';


//Cache
$config['cache']['cache-control'] = 'private';
$config['cache']['max-age'] = '2592000999865';

//Extenssions auth
$config['extensions_auth'] = 'js,png,css,jpg,jpeg,gif,swf,ico,xml,mp3,wmv,avi,mpeg,html';

//security
$config['security']['allowedipadmin'] = '';
$config['security']['salt'] = '';

//domain
$config['domain']['multisite'] = '0';
$config['domain']['sld'] = '2';

//Dev
$config['dev']['status'] = 'dev';
$config['dev']['serialization'] = 'obj';

//localization
$config['localization']['default_language'] = 'en_EN';
$config['localization']['timezone'] = 'America/Adak';

//preferences
$config['preferences']['conteneurColor'] = '#ffffff';
$config['preferences']['blockColor'] = '#ffffff';
$config['preferences']['cssPickerColor'] = '#ffffff';
$config['preferences']['translateColor'] = '#ffffff';

$config['cache']['active'] = '0';

//general
$config['general']['ajaxnav'] = '0';

//mailing conf
$config['mail']['adminMail'] = 'juliodetolosa@free.fr';
$config['mail']['type'] = '';
$config['mail']['server'] = '';
$config['mail']['port'] = '25';

$config['activeModules']['core'] = '1';
$config['activeModules']['admin'] = '0';

$config['sitename'] = 'My WebSite';
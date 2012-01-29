<?php

define("PARANOID", 1);
define("SQL", 2);
define("SYSTEM", 4);
define("HTML", 8);
define("INT", 16);
define("FLOAT", 32);
define("LDAP", 64);
define("UTF8", 128);

// get register_globals ini setting - jp
$register_globals = (bool) ini_get('register_gobals');
if ($register_globals == TRUE) { define("REGISTER_GLOBALS", 1); } else { define("REGISTER_GLOBALS", 0); }

// get magic_quotes_gpc ini setting - jp
$magic_quotes = (bool) ini_get('magic_quotes_gpc');
if ($magic_quotes == TRUE) { define("MAGIC_QUOTES", 1); } else { define("MAGIC_QUOTES", 0); }

class Sanitize {

// addslashes wrapper to check for gpc_magic_quotes - gz
function nice_addslashes($string)
{
  // if magic quotes is on the string is already quoted, just return it
  if(MAGIC_QUOTES)
    return $string;
  else
    return addslashes($string);
}

// internal function for utf8 decoding
// thanks to Hokkaido for noticing that PHP's utf8_decode function is a little
// screwy, and to jamie for the code
function my_utf8_decode($string)
{
return strtr($string,
  "???????¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ",
  "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
}

// paranoid sanitization -- only let the alphanumeric set through
function sanitize_paranoid_string($string, $min='', $max='')
{
  $string = preg_replace("/[^a-zA-Z0-9]/", "", $string);
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return $string;
}

// sanitize a string in prep for passing a single argument to system() (or similar)
function sanitize_system_string($string, $min='', $max='')
{
  $pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; // no piping, passing possible environment variables ($),
                           // seperate commands, nested execution, file redirection,
                           // background processing, special commands (backspace, etc.), quotes
                           // newlines, or some other special characters
  $string = preg_replace($pattern, '', $string);
  $string = '"'.preg_replace('/\$/', '\\\$', $string).'"'; //make sure this is only interpretted as ONE argument
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return $string;
}

// sanitize a string for SQL input (simple slash out quotes and slashes)
function sanitize_sql_string($string, $min='', $max='')
{
  $string = nice_addslashes($string); //gz
  $pattern = "/;/"; // jp
  $replacement = "";
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return preg_replace($pattern, $replacement, $string);
}

// sanitize a string for SQL input (simple slash out quotes and slashes)
function sanitize_ldap_string($string, $min='', $max='')
{
  $pattern = '/(\)|\(|\||&)/';
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return preg_replace($pattern, '', $string);
}


// sanitize a string for HTML (make sure nothing gets interpretted!)
function sanitize_html_string($string)
{
  $pattern[0] = '/\&/';
  $pattern[1] = '/</';
  $pattern[2] = "/>/";
  $pattern[3] = '/\n/';
  $pattern[4] = '/"/';
  $pattern[5] = "/'/";
  $pattern[6] = "/%/";
  $pattern[7] = '/\(/';
  $pattern[8] = '/\)/';
  $pattern[9] = '/\+/';
  $pattern[10] = '/-/';
  $replacement[0] = '&amp;';
  $replacement[1] = '&lt;';
  $replacement[2] = '&gt;';
  $replacement[3] = '<br>';
  $replacement[4] = '&quot;';
  $replacement[5] = '&#39;';
  $replacement[6] = '&#37;';
  $replacement[7] = '&#40;';
  $replacement[8] = '&#41;';
  $replacement[9] = '&#43;';
  $replacement[10] = '&#45;';
  return preg_replace($pattern, $replacement, $string);
}

// make int int!
function sanitize_int($integer, $min='', $max='')
{
  $int = intval($integer);
  if((($min != '') && ($int < $min)) || (($max != '') && ($int > $max)))
    return FALSE;
  return $int;
}

// make float float!
function sanitize_float($float, $min='', $max='')
{
  $float = floatval($float);
  if((($min != '') && ($float < $min)) || (($max != '') && ($float > $max)))
    return FALSE;
  return $float;
}

// glue together all the other functions
function sanitize($input, $flags, $min='', $max='')
{
  if($flags & UTF8) $input = my_utf8_decode($input);
  if($flags & PARANOID) $input = sanitize_paranoid_string($input, $min, $max);
  if($flags & INT) $input = sanitize_int($input, $min, $max);
  if($flags & FLOAT) $input = sanitize_float($input, $min, $max);
  if($flags & HTML) $input = sanitize_html_string($input, $min, $max);
  if($flags & SQL) $input = sanitize_sql_string($input, $min, $max);
  if($flags & LDAP) $input = sanitize_ldap_string($input, $min, $max);
  if($flags & SYSTEM) $input = sanitize_system_string($input, $min, $max);
  return $input;
}

function check_paranoid_string($input, $min='', $max='')
{
  if($input != sanitize_paranoid_string($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_int($input, $min='', $max='')
{
  if($input != sanitize_int($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_float($input, $min='', $max='')
{
  if($input != sanitize_float($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_html_string($input, $min='', $max='')
{
  if($input != sanitize_html_string($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_sql_string($input, $min='', $max='')
{
  if($input != sanitize_sql_string($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_ldap_string($input, $min='', $max='')
{
  if($input != sanitize_string($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_system_string($input, $min='', $max='')
{
  if($input != sanitize_system_string($input, $min, $max, TRUE))
    return FALSE;
  return TRUE;
}

// glue together all the other functions
function check($input, $flags, $min='', $max='')
{
  $oldput = $input;
  if($flags & UTF8) $input = my_utf8_decode($input);
  if($flags & PARANOID) $input = sanitize_paranoid_string($input, $min, $max);
  if($flags & INT) $input = sanitize_int($input, $min, $max);
  if($flags & FLOAT) $input = sanitize_float($input, $min, $max);
  if($flags & HTML) $input = sanitize_html_string($input, $min, $max);
  if($flags & SQL) $input = sanitize_sql_string($input, $min, $max);
  if($flags & LDAP) $input = sanitize_ldap_string($input, $min, $max);
  if($flags & SYSTEM) $input = sanitize_system_string($input, $min, $max, TRUE);
  if($input != $oldput)
    return FALSE;
  return TRUE;
}
}

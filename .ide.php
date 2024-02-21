<?php
//defined('BASEPATH') or exit('Only for IDE Purpose');
function log_message($level, $message){}
$params = array('text' => 1, 'chat_id' => 2);
$params_2 =array_merge($params, array('parse_mode'=>'HTML'));

echo "<pre>";
print_r($params_2);
echo "</pre>";

<?php exit;
$input['red_type'] = form_select('red_type', array('普通红包','拼手气红包','口令红包'));
$input['red_num'] = form_text('red_num', '-1');
$input['red_total_money'] = form_text('red_total_money', '0');
$input['red_command'] = form_text('red_command', '0');
$input['post_red'] =form_radio_yes_no('post_red', 0);
?>
<?php
exit;

global $thread;

$haya_post_sort_see_type = param('type', '');
if ($haya_post_sort_see_type == 'onlyhost') {
    if (! isset($cond['uid']) && isset($cond['tid'])) {
        if (isset($thread) 
			&& isset($thread['tid']) 
			&& $thread['tid'] == $cond['tid']
		) {
            $cond['uid'] = $thread['uid'];
        } else {
            $result = db_find_one('thread', array(
                'tid' => $cond['tid']
            ), array(), array(
                'uid'
            ));
            if ($result && isset($result['uid'])) {
                $cond['uid'] = $result['uid'];
            }
        }
    }
} elseif ($haya_post_sort_see_type == 'last') {
	unset($orderby['pid']);
	$haya_sign_orderby = array('isfirst' => -1, 'pid' => -1);
	$orderby = array_merge($haya_sign_orderby, $orderby);
}


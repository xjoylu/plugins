<?php
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)){
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_structure/setting.htm');
    elseif($method=='POST')
    {
        $op=param('op');
        $selected=param('forum_select');
        $selected_count = strlen($selected);
        if($selected_count<=4) die();
        $str_empty = '0';
        for($i=0;$i<19;$i++)
            $str_empty.='|0';
        $fid = substr($selected,4,$selected_count-3);
        if($op=='0')
        {
            $_forum=db_find_one('forum',array('fid'=>$fid));
            if($_forum['structure']=='0')
                $_forum['structure']=$str_empty;
            message(0,$_forum['structure']);
        }
        elseif($op=='1')
        {
            $sql='';$flag=0;$param_count=0;
            for($i=0;$i<20;$i++)
            {
                $s= param('in_'.($i+1),'0');
                if($s!='0') { $param_count++;
                    if ($flag == 0) {
                        $sql .= str_replace('|', '', $s);
                        $flag = 1;
                    } else $sql .= '|' . str_replace('|', '', $s);
                }else break;
            }
            if($param_count>=1)
                db_update('forum',array('fid'=>$fid),array('structure'=>$sql));
            else
                db_update('forum',array('fid'=>$fid),array('structure'=>'0'));
            forum_list_cache_delete();
            message(0,'更新成功!');
        }
    }
}
?>
$forum_structure_r = $forumlist[$newfid]['structure'];
$forum_structure= explode('|',$forum_structure_r);
$forum_structure_count = count($forum_structure); $update_array = array();
for($i=0;$i<$forum_structure_count;$i++)
    $update_array['c'.($i+1)] = param('ini_'.($i+1),'-');
$_r = db_find_one('thread_structure',array('tid'=>$tid));
if($_r)
    db_update('thread_structure',array('tid'=>$tid),$update_array);
else{
    $update_array['tid']=$tid;
    db_insert('thread_structure',$update_array);
}
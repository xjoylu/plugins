$post_update=1;
$forum_structure_r = db_find_one('thread_structure',array('tid'=>$tid));
if($forumlist[$fid]['structure'] =='0')
    $forum_structure_count = 0;
else
    $forum_structure_count = count(explode('|',$forumlist[$fid]['structure']));
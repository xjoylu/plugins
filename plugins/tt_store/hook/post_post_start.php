$set = setting_get('tt_store');
if($fid==$set['fid']&&$thread['content_buy']>0)
{  $isbought = db_find_one('paylist',array('tid'=>$tid,'uid'=>$uid));
    if(! $isbought)
    {message(-1, '这是收费主题，您需要先购买才能发表评论！'); die();}
}
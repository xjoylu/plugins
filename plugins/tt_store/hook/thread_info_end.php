$set = setting_get('tt_store');$rate_open=0;
if($fid==$set['fid']&&$thread['content_buy']>0)
{
    $rate = db_find_one('store_rate',array('tid'=>$tid)); $rate_open=1;
    if(!$rate)
    {
        db_insert('store_rate',array('tid'=>$tid));
        $rate = db_find_one('store_rate',array('tid'=>$tid));
    }
}
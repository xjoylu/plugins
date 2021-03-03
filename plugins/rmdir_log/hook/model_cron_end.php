// 删除log目录下大于7天的日志和目录
function rmdir_log_recusive($dir, $day = 7)
{
    if ($dir == '/' || $dir == './' || $dir == '../') return FALSE;// 不允许删除根目录，避免程序意外删除数据。
    if (!is_dir($dir)) return FALSE;
    substr($dir, -1) != '/' AND substr($dir, -1) != '/' AND $dir .= '/';

    $files = glob($dir . '*');
    foreach (glob($dir . '.*') as $v) {
        if (substr($v, -1) != '.' && substr($v, -2) != '..') $files[] = $v;
    }
    $filearr = $dirarr = array();
    if ($files) {
        foreach ($files as $file) {
            //是否为目录
            if (is_dir($file)) {
                $r = explode('/', $file);
                $r[1] <= date('Ymd', strtotime('-' . $day . ' day')) AND $dirarr[] = $file;
            } else {
                //子目录下要删除的文件
                $filearr[] = $file;
            }
        }
    }
    if ($filearr) {
        foreach ($filearr as $file) {
            xn_unlink($file);
        }
    }
    if ($dirarr) {
        foreach ($dirarr as $file) {
            rmdir_log_recusive($file);
            xn_rmdir($file);
        }
    }
    return TRUE;
}
<?php
function plugin_install(){
    if(!get_plugin_install_state('XianD_Pay')){
        $sql = file_get_contents(PLUGIN_PATH.'XianD_Pay/pay_install/install.sql');
        $sqlQuery = S('user');
        $is_true = $sqlQuery -> query($sql);
        if(empty($is_true)){
            exit('插件安装失败, 数据表创建失败.');
        }else{
            file_put_contents(PLUGIN_PATH.'XianD_Pay/on','');
            return true;
        }
    }else{
        exit('你已经安装了插件, 请不要重复安装.');
    }
}
function plugin_uninstall(){
    if(get_plugin_install_state('XianD_Pay')){
        $data = S("user");
        $sql = "DROP TABLE IF EXISTS hy_xiand_pay";
        if($data -> query($sql))
        {
            unlink(PLUGIN_PATH."XianD_Pay/on");
            return true;
        }else{
            exit('插件卸载失败, 数据表删除失败.');
        }
    }else{
        exit('你还没有安装这个插件.');
    }
}
                    
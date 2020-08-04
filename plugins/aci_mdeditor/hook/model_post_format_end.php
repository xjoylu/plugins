include_once "plugin/aci_mdeditor/Parsedown.php";
$Parsedown = new Parsedown();

if($post['doctype'] == 2){
    $post['message_fmt'] = $Parsedown->text($post['message_fmt']);
}




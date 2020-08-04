<?php
exit;

if (strtolower($attach['filetype']) == 'image') {
	$s .= '<div class="row mt-1" data-aid="'.$attach['aid'].'">';
	$s .= '		<div class="col-md-12">';
	$s .= '			<span class="haya-post-attach-lite-info haya-post-attach-lite-info-'.$haya_post_attach_lite_rand.'">';
	$s .= '				<img class="haya-post-attach-lite-img" onclick="javascript:haya_post_attach_lite_open_'.$haya_post_attach_lite_rand.'(this);" src="'.$attach['url'].'" alt="'.$attach['orgfilename'].'" title="'.$attach['orgfilename'].'" />';
	$s .= '				<a class="haya-post-attach-lite-search" href="'.$attach['url'].'" target="_blank" title="'.lang("haya_post_attach_lite_open").'">';
	$s .= '					<i class="icon-search"></i>';
	$s .= '				</a>';
	$s .= '			</span>';
	$s .= '		</div>';
	$s .= '</div>';
} 

?>

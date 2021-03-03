<?php
exit;

if (strtolower($attach['filetype']) == 'image') { 
	$s .= '<div class="row m-t-sm">';
	$s .= '		<div class="col-sm-12">';
	$s .= '			<span class="haya-post-attach-info">';
	$s .= '				<img class="haya-post-attach-img js-haya-post-attach-img-btn" src="'.$attach['url'].'" alt="'.$attach['orgfilename'].'" title="'.$attach['orgfilename'].'" />';
	$s .= '				<a class="haya-post-attach-search" href="'.$attach['url'].'" target="_blank" title="查看详情">';
	$s .= '					<i class="icon-search"></i>';
	$s .= '				</a>';
	$s .= '			</span>';
	$s .= '		</div>';
	$s .= '</div>';
} 

?>

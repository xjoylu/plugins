<?php exit;

$haya_post_attach_lite_rand = md5(time().xn_rand(10));

?>
<style>
.message > .fieldset {
	margin-top: 20px;
}
.attachlist {
	padding: 0;
}
.attachlist li {
	list-style-type: none;
	font-size: 15px;
	margin-bottom: 8px;
}
.attachlist li:last-child {
	border-bottom: 0;
	margin-bottom: 0;
}
.attachlist li .haya-post-attach-lite-info-<?php echo $haya_post_attach_lite_rand; ?> {
	display: inline-block;
	position: relative;
	max-width: 50%;
	cursor: pointer;
	transition: all 0.5s linear;
}
.attachlist li .haya-post-attach-lite-info-<?php echo $haya_post_attach_lite_rand; ?>.open {
	max-width: 100%;
	transition: all 0.5s linear;
}
.attachlist li .haya-post-attach-lite-info-<?php echo $haya_post_attach_lite_rand; ?> .haya-post-attach-lite-img {
	width: 100%;
    margin-bottom: 0 !important;
}
.attachlist li .haya-post-attach-lite-info-<?php echo $haya_post_attach_lite_rand; ?> .haya-post-attach-lite-search {
	position: absolute;
	right: 0;
	bottom: 0;
	text-decoration: none;
	border-radius: 4px;
	padding: 0 5px;
	border: 1px solid rgba(255, 255, 255, 0.3);
	background: rgba(255, 255, 255, 0.3);
}
.attachlist li .haya-post-attach-lite-info-<?php echo $haya_post_attach_lite_rand; ?> .haya-post-attach-lite-search:hover {
	border: 1px solid rgba(255, 255, 255, 0.5);
	background: rgba(255, 255, 255, 0.5);
}
</style>
<script>
function haya_post_attach_lite_open_<?php echo $haya_post_attach_lite_rand; ?>(id) {
	var thiz = $(id).parent();
	if (thiz.hasClass("open")) {
		thiz.removeClass("open");
	} else {
		thiz.addClass("open");
	}
}
</script>
<?php

?>
// 定义输入框的全局变量 #tag-add, 0 为隐藏状态, 1 为显示状态
var tag_dis = 0



/*----------------------------------------
|
| 初始化时添加组建 (显示的)
| 初始化时添加组件 (隐藏的)
| 增加标签按钮
| 删除标签按钮 <button title="添加标签" id="tagRes" class="icon-plus"></button>
|
---------------------------------------- */

$('#tag').append( '<li style="padding:0;"><button title="添加标签" id="tagRes" class="icon-plus"></button></li>' )
$('#tag').after(
	'<div id="tag-add">'+
		'<form>'+
			//'<h5>添加标签 <a href="#" title="修改记录"><i class="icon-paste"></i></a></h5>'+
			'<input id="tag-data" type="text" placeholder="输入标签名" maxlength="32"><button type="submit"><i class="icon-paper-plane"></i></button>'+
		'</form>'+
	'</div>'
)



/*----------------------------------------
|
| 监听 #tag-add 显示与隐藏的开关 #tagRes
| 根据全局变量转变 标签图标
| 根据全局变量转变 #tag-add 的显隐状态
|
----------------------------------------*/

 $(document).on('click', '#tagRes', function() {
 	if(tag_dis==0){
 		$("#tag li i").removeClass("icon-tag");
 		$("#tag li i").addClass("icon-times-circle");	
 		$("#tag-add").fadeToggle("slow");
 		$("#tag-data").focus();
 		tag_dis = 1
 	}else{
 		$("#tag li i").removeClass("icon-times-circle");
 		$("#tag li i").addClass("icon-tag");
 		$("#tag-add").fadeToggle("slow");
 		tag_dis = 0
 	}
 })



/*----------------------------------------
|
| delete
| 
----------------------------------------*/

$(document).on('click', '#tag li a', function() {
	if(tag_dis==1){
		var t   = $(this).parent() // this不能直接传递
		var tid = $('#tag').data('tid')
		var tag = $(this).parent().data('tag')
		var url = '?tag-del.htm'
		$.xpost(url, {'tid': tid, 'tag': tag }, function(code,msg){
			if (code == 0) {
				// 删除成功则移除此标签
				t.remove()
			} else {
				alert(msg)
			}
		})
		return false
	}
})



/*----------------------------------------
|
| add tag ( Allow Space )
| 
----------------------------------------*/

$(document).on('click', '#tag-add button', function() {
	var r = $('#tag-data').val()
	var tid = $('#tag').attr('data-tid')
	if (安检(r)){
		var url = '?tag-add.htm'
		$.xpost(url, {'tid': tid, 'tag': r.trim() }, function(code,msg){
			if (code == 1) {
				if ( $("#tag li[data-tag='"+msg+"']").length > 0 ) {
					//alert(tag+'标签已存在')
					return false
				}
				// 先移除结尾的元素, 增加完毕再添加结尾的元素
				$("#tag li:last").remove()
				$("#tag").append('<li data-tag="'+msg+'"><a href="?tag-'+msg+'.htm"><i class="icon-tag"></i>'+r+'</a></li>')
				$('#tag').append('<li style="padding:0;"><button title="添加标签" id="tagRes" class="icon-plus"></button></li>')

				// 关闭组件 并切回tag状态
				$("#tag-add").fadeOut("slow");
				$("#tag li i").removeClass("icon-times-circle");
				$("#tag li i").addClass("icon-tag");
				$("#tagRes").focus();

				tag_dis = 0
				$("#tag-data").val("")
			} else {
				alert(msg)
			}	
		})
	}
	return false
})



/*----------------------------------------
|
| 封装整理
| 
----------------------------------------*/

function 安检(r){
	var q = $('#tag').children('li').length
	if(q > 12){
		提示('标签最多设置12个')
		return false
	}

	if(r==null||r.length==0){
		提示('你明明什么都没写..')
		return false
	}

	if( 检查字符长度(r) ){
		提示('中文字数 1-8 个, 英文2-24个 ')
		return false
	}

	if( 检查特殊字符(r) ){
		提示('不可使用特殊字符')
		return false
	}

	if( 检查重复标签(r) ){
		提示('标签已存在')
		return false
	}

	// 重复检查( 前端检查 )

	return true
}



function 检查重复标签(r){
	// 服务端也需要判断一遍, 或许本地可以省略..
	return false
}


function 检查特殊字符(r){
	// 特殊符号不可使用 (各种空格与危险字符/但英文空格是允许的)
	var a = new Array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "{", "}", "[", "]", "(", ")")
	a.push(":", ";", "'", "|", "\\\\", "<", ">", "?", "/", "<<", ">>", "||", "//", "　", ",", ".")
	a.push("select", "delete", "update", "insert", "create", "drop", "alter", "trancate")
	var s = r.toLowerCase();
	for (var i = 0; i < a.length; i++) {
		if (s.indexOf(a[i]) >= 0) {
			return true
		}
	}
	return false
}


function 检查字符长度(str){
	// UTF8字符集实际长度计算
	var realLength = 0
	var len = str.length
	var charCode = -1
	for(var i = 0; i < len; i++){
		charCode = str.charCodeAt(i)
		if (charCode >= 0 && charCode <= 128) {
			realLength += 1
		}else{
			// 中文则长度加3
			realLength += 3
		}
	}
	if( realLength>24 || realLength<2 ){
		return true
	}
	return false
}



function 提示(r){
	var timestamp = (new Date()).valueOf()
	$("#tag-add").after('<div class="alert alert-warning" role="alert" id="t'+timestamp+'"><strong>提示!</strong> '+r+'</div>');
	setTimeout(function () { $("#t"+timestamp).hide(1000) }, 4000)
	setTimeout(function () { $("#t"+timestamp).remove() }, 5000)

}

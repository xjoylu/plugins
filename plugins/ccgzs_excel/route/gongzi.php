<?php
!defined('DEBUG') AND exit('Access Denied.');
//Spreadsheet_Excel_Reader()函数支持文件
include APP_PATH.'plugin/ccgzs_excel/model/excel.func.php';
//Excel所在文件夹
$path = kv_get('excel_path');
$excel_path = $path['excel_dir'];
include _include(APP_PATH.'view/htm/header.inc.htm');

if(isset($user['idnumber'])){
	if(isset($_POST['select'])){
		//转换编码
		$excel_name = iconv('UTF-8', 'GB2312', $_POST['select']);
		//合成Excel路径
		$excel_dir = $excel_path.$excel_name.".xls";
		//创建 Reader
		$data = new Spreadsheet_Excel_Reader();
		//设置文本输出编码
		$data->setOutputEncoding('UTF-8');
		//读取Excel文件
		$data->read("$excel_dir");
		//载入选择Excel页面
		include _include(APP_PATH.'plugin/ccgzs_excel/view/gongzi.htm');
		//显示表格表头标签
		echo '<table border=1>';
		$x=0;
		$y=0;
		//$data->sheets[0]['numRows']为Excel行数
		for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++){
			//查询搜索关键字在第一行第几列
			if($i=="1"){
				//输出表格“行”标签
				echo '<tr class="tt">';
				//$data->sheets[0]['numCols']为Excel列数
				for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
					//显示每个单元格内容
					$datas = $data->sheets[0]['cells'][$i][$j];
					echo '<th>'.$datas.'</th>';
					$x++;
					//定位关键字列数
						if($datas=="身份证号"){
							$y = $x;
						}
				}
				echo "</tr>\r\n";
			}else{
				//从第二行开始逐行判断本行是否有搜索关键字
				$excel = $data->sheets[0]['cells'][$i][$y];
				$excel = iconv('UTF-8', 'GB2312', $excel);
					//输出有关键字一行所有数据
					if($excel==$user['idnumber']){
						echo '<tr>';
						for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
							$excels = $data->sheets[0]['cells'][$i][$j];
							echo '<td>'.$excels.'</td>';
						}
					echo "</tr>\r\n";
					}
			}
		}
		//显示表格表尾标签
		echo '</table>';
	}else{
	include _include(APP_PATH.'plugin/ccgzs_excel/view/gongzi.htm');
	}
}else{
include _include(APP_PATH.'plugin/ccgzs_excel/view/user_login.htm');
}
include _include(APP_PATH.'view/htm/footer.inc.htm');

function excel_dir($dir){
	if (is_dir($dir)){
		if ($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false){
				if($file == '.' || $file == '..'){
	   			}else{
					$file = str_replace(".xls","",$file);
					$file = iconv('GB2312', 'UTF-8', $file);
					echo '<option value="' . $file . '">' . $file . '</option>';
				}
			}
		closedir($dh);
		}
	}
}
?>
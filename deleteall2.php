<?php
// 检测文件存在但数据库没有的，存到files表
$nosession=true;
$nosecu=true;
include("./includes/common.php");

/*$array=glob(ROOT.'file/*');

echo '正在读取目录<br/>';

$i=0;
foreach($array as $dir){
	$hash = substr($dir,strripos($dir, '/')+1);
	$row = $DB->get_row("SELECT * FROM udisk WHERE fileurl='{$hash}' limit 1");
	if(!$row){
		$i++;
		$DB->query("INSERT INTO files (`hash`,`addtime`) VALUES ('{$hash}', NOW())");
	}
}

echo 'ok!'.$i;
*/

$tid=isset($_GET['tid'])?$_GET['tid']:0;
$count = $DB->count("SELECT count(*) FROM files");
if($count == 0)exit('complete');
$row = $DB->get_row("SELECT * FROM files LIMIT 1");
$result = $stor->delete($row['hash']);
$sql = $DB->query("DELETE FROM files WHERE id='{$row['id']}' LIMIT 1");
if($result==true && $sql)
{echo '删除成功！流水号：'.$tid.' Hash：'.htmlspecialchars($row['hash']).' 剩余：'.$count.'<br/>';}
else{
echo '删除失败！流水号：'.$tid.' Hash：'.htmlspecialchars($row['hash']).' 剩余：'.$count.'<br/>';
}
echo "<script language='javascript'>document.location = './deleteall2.php?tid=".($tid+1)."'</script>";


/*
CREATE TABLE `files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) NOT NULL,
  `addtime` datetime DEFAULT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/
<?php
$nosession=true;
$nosecu=true;
include("./includes/common.php");

$tid=isset($_GET['tid'])?$_GET['tid']:0;
$count = $DB->getColumn("SELECT count(*) FROM pre_file WHERE lasttime<'2020-03-01 00:00:00'");
if($count == 0)exit('complete');
$row = $DB->getRow("SELECT * FROM pre_file WHERE lasttime<'2020-03-01 00:00:00' LIMIT 1");
//$count = $DB->count("SELECT count(*) FROM udisk WHERE `filename` LIKE '%傻逼%'");
//if($count == 0)exit('complete');
//$row = $DB->get_row("SELECT * FROM udisk WHERE `filename` LIKE '%傻逼%' LIMIT 1");
//$count = $DB->count("SELECT count(*) FROM udisk WHERE `ip`='117.132.195.233'");
//if($count == 0)exit('complete');
//$row = $DB->get_row("SELECT * FROM udisk WHERE `ip`='117.132.195.233' LIMIT 1");

$result = $stor->delete($row['hash']);
$sql = $DB->exec("DELETE FROM pre_file WHERE id='{$row['id']}' LIMIT 1");
if($result==true && $sql==true)
{echo '删除成功！流水号：'.$tid.' 文件名：'.htmlspecialchars($row['name']).' 剩余：'.$count.'<br/>';}
else{
echo '删除失败！流水号：'.$tid.' 文件名：'.htmlspecialchars($row['name']).' 剩余：'.$count.'<br/>';
}

echo "<script language='javascript'>document.location = './deleteall.php?tid=".($tid+1)."'</script>";
?>
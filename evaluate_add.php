<?php
include 'includes/conn.php';
if (!empty($_POST)) {
  $params = $_POST;
  $fieldStr = '';
  $dataStr = '';
  $act = $_POST['act'];
  unset($params['act']);
  switch ($act) {
    case 'lease':
      $params['create_t'] = time();
      foreach ($params as $key => $value) {
        $fieldStr .= $key.',';
        $dataStr .= '"'.$value.'",';
      }
      $fieldStr = substr($fieldStr,0,-1);
      $dataStr = substr($dataStr,0,-1);

      $result = $mysqli->query("INSERT INTO evaluate ({$fieldStr}) VALUES({$dataStr})");
      if ($result) {
        echo "<script>alert('评价成功');window.location.href='leaseDetail.php?act=detailedlease&gid=".$params['list_id']."';</script>";
      }else{
        echo "<script>alert('评价失败');window.location.href='leaseDetail.php?act=detailedlease&gid=".$params['list_id']."';</script>";
      }
      break;

    case 'list':
      $params['create_t'] = time();
      foreach ($params as $key => $value) {
        $fieldStr .= $key.',';
        $dataStr .= '"'.$value.'",';
      }
      $fieldStr = substr($fieldStr,0,-1);
      $dataStr = substr($dataStr,0,-1);

      $result = $mysqli->query("INSERT INTO evaluate ({$fieldStr}) VALUES({$dataStr})");
      if ($result) {
        echo "<script>alert('评价成功');window.location.href='goodDetail.php?act=detailedgood&gid=".$params['list_id']."';</script>";
      }else{
        echo "<script>alert('评价失败');window.location.href='goodDetail.php?act=detailedgood&gid=".$params['list_id']."';</script>";
      }
      break;
  }

}

?>

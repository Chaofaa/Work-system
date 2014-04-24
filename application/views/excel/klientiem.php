<?php
$name = date('H:i:s');
header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=atskaiteKlientiem_$name.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1'>
  <tr>
    <td>Klients</td>
    <td>SUM/h</td>
  </tr>
  <tr bgcolor="#ccc">
      <td></td>
      <td><?= $total_time; ?></td>
  </tr>
  <? foreach($atskaite as $row){ ?>
  <tr>
    <td><?= $row->clients_name; ?></td>
    <td><?= $row->total_time; ?></td>
  </tr>
  <? } ?>
  <tr bgcolor="#ccc">
      <td></td>
      <td><?= $total_time; ?></td>
  </tr>
</table>

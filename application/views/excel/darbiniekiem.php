<?php
$name = date('H:i:s');
header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=atskaiteDarbiniekiem_$name.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1'>
  <tr>
    <td>Darbinieks</td>
    <td>SUM/h</td>
    <td>Dienu skaits</td>
    <td>Videja h/diena</td>
  </tr>
  <tr bgcolor="#ccc">
      <td></td>
      <td><?= $total_time; ?></td>
      <td><?= $total_days; ?></td>
      <td><?= $total_sum; ?></td>
  </tr>
  <? foreach($atskaite as $row){ ?>
  <tr>
    <td><?= $row->first_name; ?>&nbsp;<?= $row->last_name; ?></td>
    <td><?= $row->total_time; ?></td>
    <td><?= $row->total_days; ?></td>
    <td><?= $row->total_time/$row->total_days; ?></td>
  </tr>
  <? } ?>
  <tr bgcolor="#ccc">
      <td></td>
      <td><?= $total_time; ?></td>
      <td><?= $total_days; ?></td>
      <td><?= $total_sum; ?></td>
  </tr>
</table>

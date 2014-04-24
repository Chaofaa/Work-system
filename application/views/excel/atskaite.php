<?php
$name = date('H:i:s');
header("Content-type: application/octet-stream; charset=utf-8");
header("Content-Disposition: attachment; filename=atskaite_$name.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1'>
  <tr>
    <td>ID</td>
    <td>Datums</td>
    <td>Izpilditajs</td>
    <td>Sadaļa</td>
    <td>Klients</td>
    <td>Lieta</td>
    <td>Padarītā darba apraksts</td>
    <td>Stundas/h</td>
    <td>Piezīmes</td>
    <td>Papildus izmaksas EUR</td>
  </tr>
  <? foreach($atskaite as $row){ ?>
  <tr>
    <td><?= $row->id; ?></td>
    <td><?= $row->datums; ?></td>
    <td><?= $row->first_name; ?>&nbsp;<?= $row->last_name; ?></td>
    <td><?= $row->sadala_name; ?></td>
    <td><?= $row->clients_name; ?></td>
    <td><?= $row->lieta_name; ?></td>
    <td><?= $row->apraksts; ?></td>
    <td><?= $row->time; ?></td>
    <td><?= $row->piezimes; ?></td>
    <td><?= $row->papildus_izmaksas; ?></td>
  </tr>
  <? } ?>
</table>

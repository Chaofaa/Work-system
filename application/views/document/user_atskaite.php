    <div class="main">
     <? if($this->ion_auth->is_admin()){ ?> 
     <div class="row">  
        <ul class="nav nav-tabs link-button-left">
            <li <?= (($this->nav == false)?'class="active"':''); ?> ><a href="<?= base_url() ?>atskaite"><b>Darba laika uzskaite</b></a></li>
            <li <?= (($this->nav == 'klientiem')?'class="active"':''); ?>><a href="<?= base_url() ?>atskaite/klientiem"><b>Darba laiks klientam</b></a></li>
            <li <?= (($this->nav == 'darbiniekiem')?'class="active"':''); ?>><a href="<?= base_url() ?>atskaite/darbiniekiem"><b>Atskaite par darbiniekiem</b></a></li>
        </ul>
      </div>
      <? } ?>
      <div class="row"> 
        <a class="btn btn-default link-button-left" href="<?= base_url(); ?>atskaite/add" role="button">Pievienot Uzdevumu</a>
      </div>
      <div class="row">
        <form action="<?= base_url(); ?>atskaite/filter/a_filter" class="form-inline left-margin" method="post" >
            <div class="form-group">
                <input type="hidden" name="redirect" value="atskaite" />
                <? if($this->ion_auth->is_admin()){ ?>
                <select name="darbinieks" class="form-control">
                    <option value="0">Izpilditajs</option>
                    <? foreach($filter['darbinieks'] as $darbienieks){ ?>
                    <option value="<?= $darbienieks->id; ?>" <?= ((isset($filter_data['darbinieks']) && ($filter_data['darbinieks'] == $darbienieks->id))?'selected="selected"':''); ?> ><?= $darbienieks->first_name; ?>&nbsp;<?= $darbienieks->last_name; ?></option>
                    <? } ?>
                </select>
                <? }else{ ?>
                <input type="hidden" name="darbinieks" value="0" />
                <? } ?>
                <select name="sadala" class="form-control">
                    <option value="0">Sadaļa</option>
                    <? foreach($filter['sadala'] as $sadala) { ?>
                    <option value="<?= $sadala->id; ?>" <?= ((isset($filter_data['sadala']) && ($filter_data['sadala'] == $sadala->id))?'selected="selected"':'') ?> ><?= $sadala->name; ?></option>
                    <? } ?>
                </select>
                <select name="klients" class="form-control">
                    <option value="0">Klients</option>
                    <? foreach($filter['klients'] as $klients){ ?>
                    <option value="<?= $klients->id; ?>" <?= ((isset($filter_data['klients']) && ($filter_data['klients'] == $klients->id))?'selected="selected"':'') ?> ><?= $klients->name; ?></option>
                    <? } ?>
                </select>
                <select name="lieta" class="form-control">
                    <option value="0">Lieta</option>
                    <? foreach($filter['lieta'] as $lieta){ ?>
                    <option value="<?= $lieta->id; ?>" <?= ((isset($filter_data['lieta']) && ($filter_data['lieta'] == $lieta->id))?'selected="selected"':'') ?> ><?= $lieta->name; ?></option>
                    <? } ?>
                </select>
                <input type="text" name="no-datums" placeholder="No" class="form-control date-time-picker" value="<?= (($filter_data['no-datums'])?$filter_data['no-datums']:''); ?>" />
                <input type="text" name="lidz-datums" placeholder="Lidz" class="form-control date-time-picker" value="<?= (($filter_data['lidz-datums'])?$filter_data['lidz-datums']:''); ?>" />
                <input type="submit" class="btn btn-default" value="Filtret" />
                <a href="<?= base_url() ?>atskaite/reset_filter/a_filter?r=atskaite" class="btn btn-default link-button-left">Reset filter</a>
            </div>
        </form>
      </div>
      <div class="row">
          <a href="<?= base_url(); ?>invoice/createPDFsmall/all" class="btn btn-default link-button-left">Īsais rēķins</a>
          <a href="<?= base_url(); ?>invoice/createPDFbig/all" class="btn btn-default link-button-left">Garais rēķins</a>
          <a href="<?= base_url(); ?>atskaite/excel/main" class="btn btn-default link-button-left">Export to Excel</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover tablesorter table-bordered">
        	<thead>
        		<tr>
                            <th>Datums</th>
                            <th>Izpilditajs</th>
                            <th>Sadaļa</th>
                            <th>Klients</th>
                            <th>Lieta</th>
                            <th>Padarītā darba apraksts</th>
                            <th>Stundas/h</th>
                            <th>Piezīmes</th>
                            <th>Papildus izmaksas EUR</th>
                            <td></td>
        		</tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="info">Kopā: <?= $time ?>h</td>
                            <td></td>
                            <td class="info">Kopā: <?= $izmaksas ?>EUR</td>
                            <td></td>
                        </tr>
        	</thead>
        	<tbody>
                    <? $i = 0; ?>
                    <? if($atskaite){ ?>
                        <?  foreach($atskaite as $row){ ?>
                        <tr class="select" rel="<?= $row->id; ?>">
                            <td><?= $this->main->Date($row->datums); ?></td>
                            <td><?= $row->first_name ?>&nbsp;<?= $row->last_name; ?></td>
                            <td><?= $row->sadala_name; ?></td>
                            <td><?= $row->clients_name; ?></td>
                            <td><?= $row->lieta_name; ?></td>
                            <td><?= $row->apraksts; ?></td>
                            <td><?= $row->time; ?> h</td>
                            <td><?= $row->piezimes; ?></td>
                            <td><?= $row->papildus_izmaksas; ?> EUR</td>
                            <td>
                                <a href="<?= base_url(); ?>atskaite/update/<?= $row->id; ?>" class="tip_link" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Rediģet"><span class="glyphicon glyphicon-pencil" ></span></a>
                                <a href="javascript:;" class="tip_link delete" onclick="check('<?= base_url(); ?>atskaite/delete/<?= $row->id; ?>')" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Dzest"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                        <? } ?>
                    <? }else{ ?>
                    <tr>
                        <td colspan="9">Nekas nav pievienots.</td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="info">Kopā: <?= $time ?>h</td>
                        <td></td>
                        <td class="info">Kopā: <?= $izmaksas ?>EUR</td>
                        <td></td>
                    </tr>
        	</tbody>
        </table>
      </div>
    </div>
    <script>
        $(document).ready(function()
        {
            $(".tablesorter").tablesorter(); 
        });

        function check(data) {
            var answer = confirm('Tiešam dziest šo ierakstu?');
            if (answer) {
                window.location = data;
            } 
        }

        $('.date-time-picker').datepicker(
            {
               dateFormat: 'yy-mm-dd',
               firstDay: 1
            }
        );         

        $('.tip_link').tooltip('hide');

        $(".select").on('dblclick', function() {
            var id = $(this).attr('rel');

            if (id)
                location.href = 'atskaite/update/' + id + '/';
        });
    </script>

  </div>
</div>

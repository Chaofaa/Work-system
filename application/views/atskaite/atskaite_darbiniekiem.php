    <div class="main">
     <div class="row">  
        <ul class="nav nav-tabs link-button-left">
            <li <?= (($this->nav == false)?'class="active"':''); ?> ><a href="<?= base_url() ?>atskaite"><b>Darba laika uzskaite</b></a></li>
            <li <?= (($this->nav == 'klientiem')?'class="active"':''); ?>><a href="<?= base_url() ?>atskaite/klientiem"><b>Darba laiks klientam</b></a></li>
            <li <?= (($this->nav == 'darbiniekiem')?'class="active"':''); ?>><a href="<?= base_url() ?>atskaite/darbiniekiem"><b>Atskaite par darbiniekiem</b></a></li>
        </ul>
      </div>
      <div class="row">
        <form action="<?= base_url(); ?>atskaite/filter/darbiniekiem" class="form-inline left-margin" method="post" >
            <div class="form-group">
                <input type="hidden" name="redirect" value="atskaite/darbiniekiem" />
                <select name="darbinieks" class="form-control">
                    <option value="0">Darbinieks</option>
                    <? foreach($filter['darbinieks'] as $darbienieks){ ?>
                    <option value="<?= $darbienieks->id; ?>" <?= ((isset($filter_data['darbinieks']) && ($filter_data['darbinieks'] == $darbienieks->id))?'selected="selected"':''); ?> ><?= $darbienieks->first_name; ?>&nbsp;<?= $darbienieks->last_name; ?></option>
                    <? } ?>
                </select>
                <input type="text" name="no-datums" placeholder="No" class="form-control date-time-picker" value="<?= (($filter_data['no-datums'])?$filter_data['no-datums']:''); ?>" />
                <input type="text" name="lidz-datums" placeholder="Lidz" class="form-control date-time-picker" value="<?= (($filter_data['lidz-datums'])?$filter_data['lidz-datums']:''); ?>" />
                <input type="submit" class="btn btn-default" value="Filtret" />
                <a href="<?= base_url() ?>atskaite/reset_filter/darbiniekiem?r=atskaite/darbiniekiem" class="btn btn-default link-button-left">Reset filter</a>
            </div>
        </form>
      </div>
      <div class="row">
          <a href="<?= base_url(); ?>atskaite/excel/darbiniekiem" class="btn btn-default link-button-left">Export to Excel</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover tablesorter table-bordered">
        	<thead>
        		<tr>
                            <th>Darbinieks</th>
                            <th>Summa/h</th>
                            <th>Dienu skaits</th>
                            <th>Videja h/diena</th>
        		</tr>
                        <tr>
                            <td></td>
                            <td class="info">Kopā: <?= $total_time ?> h</td>
                            <td class="info">Kopā: <?= $total_days ?> dienas</td>
                            <td class="info">Kopā: <?= $total_sum ?> h/diena</td>
                        </tr>
        	</thead>
        	<tbody>
                    <? $i = 0; ?>
                    <? if($atskaite){ ?>
                        <?  foreach($atskaite as $row){ ?>
                        <tr>
                            <td><?= $row->first_name; ?>&nbsp;<?= $row->last_name; ?></td>
                            <td><?= $row->total_time; ?> h</td>
                            <td><?= $row->total_days; ?></td>
                            <td><?= $row->total_time/$row->total_days; ?> h/diena</td>
                        </tr>
                        <? } ?>
                    <? }else{ ?>
                    <tr>
                        <td colspan="9">Nekas nav pievienots.</td>
                    </tr>
                    <? } ?>
        	</tbody>
            <tfoot>
                    <tr>
                        <td></td>
                        <td class="info">Kopā: <?= $total_time ?> h</td>
                        <td class="info">Kopā: <?= $total_days ?> dienas</td>
                        <td class="info">Kopā: <?= $total_sum ?> h/diena</td>
                    </tr>
            </tfoot>
        </table>
      </div>
    </div>
    <script>
        $(document).ready(function()
        {
            $(".tablesorter").tablesorter(); 
        });

        function check(data) {
            var answer = confirm('Delete this user?');
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
    </script>

  </div>
</div>




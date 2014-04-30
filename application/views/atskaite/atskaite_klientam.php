    <div class="main">
     <? /* if($this->ion_auth->is_admin()){ ?><h1><?= $page['title']; ?></h1><? } */ ?> 
     <div class="row">  
        <ul class="nav nav-tabs link-button-left">
            <li <?= (($this->nav == false)?'class="active"':''); ?> ><a href="<?= base_url() ?>atskaite"><b>Darba laika uzskaite</b></a></li>
            <li <?= (($this->nav == 'klientiem')?'class="active"':''); ?>><a href="<?= base_url() ?>atskaite/klientiem"><b>Darba laiks klientam</b></a></li>
            <li <?= (($this->nav == 'darbiniekiem')?'class="active"':''); ?>><a href="<?= base_url() ?>atskaite/darbiniekiem"><b>Atskaite par darbiniekiem</b></a></li>
        </ul>
      </div>
      <div class="row">
        <form action="<?= base_url(); ?>atskaite/filter/klientiem" class="form-inline left-margin" method="post" >
            <div class="form-group">
                <input type="hidden" name="redirect" value="atskaite/klientiem" />
                <select name="klients" class="form-control">
                    <option value="0">Klients</option>
                    <? foreach($filter['klients'] as $klients){ ?>
                    <option value="<?= $klients->id; ?>" <?= ((isset($filter_data['klients']) && ($filter_data['klients'] == $klients->id))?'selected="selected"':''); ?> ><?= $klients->name; ?></option>
                    <? } ?>
                </select>
                <input type="text" name="no-datums" placeholder="No" class="form-control date-time-picker" value="<?= (($filter_data['no-datums'])?$filter_data['no-datums']:''); ?>" />
                <input type="text" name="lidz-datums" placeholder="Lidz" class="form-control date-time-picker" value="<?= (($filter_data['lidz-datums'])?$filter_data['lidz-datums']:''); ?>" />
                <input type="submit" class="btn btn-default" value="Filtret" />
                <a href="<?= base_url() ?>atskaite/reset_filter/klientiem?r=atskaite/klientiem" class="btn btn-default link-button-left">Reset filter</a>
            </div>
        </form>
      </div>
      <div class="row">
          <a href="<?= base_url(); ?>invoice/createPDFsmall/klientam" class="btn btn-default link-button-left">Īsais rēķins</a>
          <a href="<?= base_url(); ?>atskaite/excel/klientam" class="btn btn-default link-button-left">Export to Excel</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover tablesorter table-bordered">
        	<thead>
        		<tr>
                            <th>Klients</th>
                            <th>Summa/h </th>
        		</tr>
                        <tr>
                            <td></td>
                            <td class="info">Kopā: <?= $total_time ?>/h</td>
                        </tr>
        	</thead>
        	<tbody>
                    <? $i = 0; ?>
                    <? if($atskaite){ ?>
                        <?  foreach($atskaite as $row){ ?>
                        <tr>
                            <td><?= $row->clients_name; ?></td>
                            <td><?= $row->total_time; ?> h</td>
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
                        <td class="info">Kopā: <?= $total_time ?>/h</td>
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



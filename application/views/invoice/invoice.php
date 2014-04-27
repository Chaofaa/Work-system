    <div class="main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
        <form action="<?= base_url(); ?>invoice/filter/invoice" class="form-inline left-margin" method="post" >
            <div class="form-group">
                <input type="hidden" name="redirect" value="invoice" />
                <select name="klients" class="form-control">
                    <option value="0">Klients</option>
                    <? foreach($filter as $klients){ ?>
                    <option value="<?= $klients->id; ?>" <?= ((isset($filter_data['klients']) && $filter_data['klients'] == $klients->id)?'selected="selected"':''); ?>><?= $klients->name; ?></option>
                    <? } ?>
                </select>
                <select name="tips" class="form-control">
                    <option value="0">Tips</option>
                    <option value="1" <?= ((isset($filter_data['tips']) && $filter_data['tips'] == 1)?'selected="selected"':''); ?>>Garais rekins</option>
                    <option value="2" <?= ((isset($filter_data['tips']) && $filter_data['tips'] == 2)?'selected="selected"':''); ?>>Isais rekins</option>
                </select>
                <select name="status" class="form-control">
                    <option value="0">Status</option>
                    <option value="1" <?= ((isset($filter_data['status']) && $filter_data['status'] == 1)?'selected="selected"':''); ?>>Aktivs</option>
                    <option value="2" <?= ((isset($filter_data['status']) && $filter_data['status'] == 2)?'selected="selected"':''); ?>>Pabeigts</option>
                </select>
                <input type="text" name="no-datums" placeholder="No" class="form-control date-time-picker" value="<?= ((isset($filter_data['no-datums']))?$filter_data['no-datums']:''); ?>" />
                <input type="text" name="lidz-datums" placeholder="Lidz" class="form-control date-time-picker" value="<?= ((isset($filter_data['lidz-datums']))?$filter_data['lidz-datums']:''); ?>" />
                <input type="submit" class="btn btn-default" value="Filtret" />
                <a href="<?= base_url() ?>invoice/reset_filter/invoice?r=invoice" class="btn btn-default link-button-left">Reset filter</a>
            </div>
        </form>
      </div>
      <div class="row"> 
		<a class="btn btn-default link-button-left" href="<?= base_url(); ?>invoice/createPDFsmall" role="button">Isais reķins</a>
                <a class="btn btn-default link-button-left" href="<?= base_url(); ?>invoice/createPDFbig" role="button">Garais reķins</a>
      </div>	
      <div class="table-responsive">
        <table class="table table-hover tablesorter table-bordered">
        	<thead>
        		<tr>
        			<th>Rek Nr.</th>
        			<th>Datums</th>
        			<th>Klients</th>
        			<th>Pakalpojumma sniegšanas periods</th>
                                <th>Apmaksas termiņš</th>
        			<th>Summa</th>
                                <th>Tips</th>
                                <th>Status</th>
                                <td></td>
        		</tr>
        	</thead>
        	<tbody>
                <? if(!empty($invoice)){ ?>
                    <? foreach($invoice as $v){ ?>
                    <tr class="<?= (($v->tips == 1)?'selectBig':'selectSmall') ?>" rel="<?= $v->id; ?>">
                        <td><?= $v->rek_nr; ?></td>
                        <td><?= $this->main->Date($v->rek_datums) ?></td>
                        <td><?= $v->client_name; ?></td>
                        <td><?= $this->main->Date($v->no); ?> - <?= $this->main->Date($v->lidz); ?></td>
                        <td><?= $v->apmaksas_termins; ?></td>
                        <td><?= $v->sum_kopa; ?> EUR</td>
                        <td><?= (($v->tips == 1)?'Garais rekins':'Isais rekins') ?></td>
                        <td><?= (($v->status == 1)?'Aktivs':'Pabeigts'); ?></td>
                        <td>
                            <a href="<?= base_url(); ?>invoice/<?= (($v->tips == 1)?'pdfBig':'pdfSmall') ?>/<?= $v->id; ?>" class="tip_link" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Create PDF"><img src="<?= base_url(JADMIN_IMAGES) ?>/system/pdf.png" width="17" /></a>
                            <a href="<?= base_url(); ?>invoice/updateBig/<?= $v->id; ?>" class="tip_link" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Edit"><span class="glyphicon glyphicon-pencil" ></span></a>
                            <a href="javascript:;" class="tip_link delete" onclick="check('<?= base_url(); ?>invoice/delete/<?= $v->id; ?>')" style="margin-left:10px;" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    <? } ?>
                <? }else{ ?>
                    <tr>
                        <td colspan="8">Nekas nav pievienots.</td>
                    </tr>
                <? } ?>    
        	</tbody>
		</table>
      </div>
    </div>
    <script>
        $(document).ready(function()
        {
            $(".tablesorter").tablesorter();
        });

        $('.date-time-picker').datepicker(
            {
               dateFormat: 'yy-mm-dd',
               firstDay: 1
            }
        );  

        function check(data) {
            var answer = confirm('Tiešam dziest šo ierakstu?');
            if (answer) {
                window.location = data;
            }    
        }    

        $('.tip_link').tooltip('hide');
        
        $(".selectBig").on('dblclick', function() {
            var id = $(this).attr('rel');

            if (id)
                location.href = 'invoice/updateBig/' + id + '/';
        });
        
        $(".selectSmall").on('dblclick', function() {
            var id = $(this).attr('rel');

            if (id)
                location.href = 'invoice/updateSmall/' + id + '/';
        });
    </script>
  </div>
</div>
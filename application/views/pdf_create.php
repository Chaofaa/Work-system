    <div class="main">
      <h1><?= $page['title']; ?></h1>
      <div class="row">
      	<a href="<?= base_url(); ?>invoice" class="link-button-left btn btn-default"><span class="glyphicon glyphicon-arrow-left"> Back</span></a>
      </div>
      <div class="table-responsive">
        <form action="<?= base_url(); ?>invoice/createPDFbig/all" method="post" />  
        <input type="hidden" name="tips" value="1" />
        <div class="well well-lg" style="width:900px"> 
            <div class="row">
                <div class="left">
                    <img src="<?= base_url(JADMIN_IMAGES) ?>/design/logo300.png" width="300" />
                    <p class="text-left" style="color:blue; font-size:12px">
                        Juridiskie pakalpojumi. Nodokļu konsultācijas<br />
                        SIA, PVN reģ.nr. LV40003959602<br />
                        Kr.Barona iela 32, Rīga, LV1011<br />
                        Tālrunis +37122500220<br />
                        Fakss +37167286359<br />
                        www.legal-tax.lv
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="left-block">
                    <label>Faktūrrēķins Nr.</label>
                    <input type="text" name="f_nr" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="left-block">
                    <label>Datums:</label>
                    <input type="text" name="f_datums" class="form-control datepicker" value="<?= date('Y-m-d'); ?>" />
                </div>
            </div>
            <div class="row">
                <div class="left-block">
                    <br />
                    <select name="me" class="form-control">
                        <option value="0">Piegadatajs</option>
                    </select>
                    <br />
                </div>
            </div>    
            <div class="row">
                <div class="left-block">
                    <p class="text-left">
                        Pakalpojuma sniedzējs:<br /> 
                        PVN Reģ.Nr.: <br />
                        Adrese: <br />
                        Banka: <br />
                        Kods (SWIFT): <br />
                        <b>Konts (EUR):</b><br />
                        <b>Konts (EUR):</b><br />
                        Bankas adrese: <br />
                        Bankas reģ.nr. <br />
                    </p>
                </div>
                <div class="left-block">
                    <p class="text-left">
                        <b>SIA „Legal & Tax”</b><br />
                        <b>LV40003959602</b><br />
                        Kr.Barona iela 32-8, Rīga, LV-1011<br />
                        A/s DnB Nord Banka<br />
                        RIKOLV2X<br />
                        <b>LV41RIKO0002930045193</b><br />
                        <b>LV45RIKO0002013085594</b><br />
                        Smilšu iela 6, Rīga – 50, LV-1803<br />
                        40003024725<br />
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="left-block">
                    <br />
                    <select name="klients" class="form-control" id="klients">
                        <option value="0">Klients</option>
                        <? foreach($klients as $k => $v){ ?>
                        <option value="<?= $v->id; ?>" <?= ((isset($filter_data['klients']) && $filter_data['klients'] == $v->id)?'selected="selected"':''); ?> ><?= $v->name; ?></option>
                        <? } ?>
                    </select>
                    <br />
                </div>    
            </div>    
            <div class="row">
                <div class="left-block">
                    <p class="text-left">
                        Pakalpojuma saņēmējs:<br /> 
                        PVN Reģ.Nr.: <br />
                        Adrese:<br />
                    </p>
                </div>
                <div class="left-block">
                    <p class="text-left" id="clients">
                        
                    </p>
                </div>
            </div>
            <div class="row">
                <a href="javascript:;" class="btn btn-default invoice_add"><span class="glyphicon glyphicon-plus"> Add pakalpojumu</span></a>
            </div>
            <div class="row" style="padding-bottom:20px; padding-top:10px">
                <table border="1" width="880" id="inv_table">
                    <thead>
                        <tr>
                            <th width="7%">Nr.</th>
                            <th>Pakalpojums</th>
                            <th width="12%">Mērvienība</th>
                            <th width="11%">Daudzums</th>
                            <th width="11%">Cena EUR</th>
                            <th width="11%">Summa</th>
                            <th width="7%"></th>
                        </tr>
                    </thead> 
                    <tbody>
                        <tr class="first_ hidden">
                            <td><input type="text" name="number[]" class="form-control p_nr" /></td>
                            <td>
                                <input type="text" name="lieta[]" class="form-control"  />
                                <input type="text" name="datums[]" class="form-control datepicker"  />
                                <input type="hidden" name="datums-lidz[]" value="" />
                                <input type="text" name="apraksts[]" class="form-control"  />
                            </td>
                            <td><input type="text" name="type[]" class="form-control p_merv"  /></td>
                            <td><input type="text" name="time[]" class="form-control p_count"  /></td>
                            <td><input type="text" name="cena[]" class="form-control p_price" /></td>
                            <td><input type="text" name="sum[]" class="form-control p_total_price" /></td>
                            <td><span style="margin-left:20px;" class="glyphicon glyphicon-trash pointer_"></span></td>
                        </tr>
                        <? if(isset($atskaite) && !empty($atskaite)){ ?>
                            <? foreach($atskaite as $k => $v){ ?>
                            <tr>
                                <td><input type="text" name="number[]" class="form-control p_nr" /></td>
                                <td>
                                    <input type="text" name="lieta[]" class="form-control" placeholder="Lieta" value="<?= $v->lieta_name; ?>" />
                                    <input type="text" name="datums[]" class="form-control datepicker" placeholder="Datums" value="<?= $v->datums; ?>" />
                                    <input type="hidden" name="datums-lidz[]" value="" />
                                    <input type="text" name="apraksts[]" class="form-control" placeholder="Apraksts" value="<?= $v->apraksts; ?>" />
                                </td>
                                <td><input type="text" name="type[]" class="form-control p_merv" value="stunda" /></td>
                                <td><input type="text" name="time[]" class="form-control p_count" value="<?= $v->time; ?>" /></td>
                                <td><input type="text" name="cena[]" class="form-control p_price" /></td>
                                <td><input type="text" name="sum[]" class="form-control p_total_price" /></td>
                                <td><span style="margin-left:20px;" class="glyphicon glyphicon-trash pointer_"></span></td>
                            </tr>
                            <? } ?>
                        <? }else{ ?>
                            
                        <? } ?>
                        <tr class="copy_before">
                            <td colspan="5">Kopā:</td>
                            <td><input type="text" name="kopa" class="form-control total_sum" /></td>
                        </tr>
                        <tr>
                            <td colspan="5">PVN (21%)</td>
                            <td><input type="text" name="pvn" class="form-control pvn_" /></td>
                        </tr>
                        <tr>
                            <td colspan="5">Summa apmaksai eiro</td>
                            <td><input type="text" name="sum_kopa" class="form-control total_sum_pvn" /></td>
                        </tr>
                    </tbody>
                </table>    
            </div>
            <div class="row">
                <div class="left-block">
                        Summa vārdiem (EUR):<br /><br /> 
                        Pakalpojuma sniegšanas periods:<input type="text" name="no" class="form-control datepicker" placeholder="no" value="<?= ((isset($filter_data['no-datums']))?$filter_data['no-datums']:''); ?>" />
                        <input type="text" name="lidz" class="form-control datepicker" placeholder="lidz" value="<?= ((isset($filter_data['lidz-datums']))?$filter_data['lidz-datums']:''); ?>" /><br />
                        Pakalpojuma sniegšanas pamats:<input type="text" name="pamats" class="form-control" /><br /> 
                        Apmaksas veids:<input type="text" name="apmaksas_type" class="form-control" /><br /> 
                        Apmaksas termiņš:<input type="text" name="apmaksas_termins" class="form-control" /><br />
                </div>
            </div>
            <div class="row">
                <div class="left-block">
                    <p class="text-left">
                        Valdes loceklis: <input type="text" name="valde" class="form-control" value="E.Krauklis" />
                    </p>
                </div>
            </div>
            <div class="row">
                <select name="status" class="form-control" style="float:left; margin-right:10px; width:130px">
                    <option value="1">Aktivs</option>
                    <option value="2">Pabeigts</option>
                </select>
                <button type="submit" class="btn btn-default">Saglabat</button>
            </div>
        </div>
        </form>
      </div>
    </div>
    <script>
       $('.datepicker').datepicker(
            {
               dateFormat: 'yy-mm-dd',
               firstDay: 1
            }
       ); 
       
       $("#klients").change(klients);
        
       function klients() {
            $("#clients").load('<?= base_url(); ?>invoice/ajax_clients/'+$("#klients").val());
        }
    
        function getNumbering() {
            var nr = 0;
            $('.p_nr').each(function() {
                $(this).val(nr);
                nr = nr + 1;
            });
        }

        function getSumValue_(val) {
            var sum = 0;
            var rezs = 0;
            var percentage = 0;
            var total = 0;
            $('.' + val).each(function() {
                sum += Number($(this).val());
            });
            percentage = sum * 21 / 100;
            total = sum + percentage
            //  izvada kopejo summu        
            rezs = sum.toFixed(2);
            $('.total_sum').val(rezs);
            
            //percentage = rezs * 21 / 100;
            $('.pvn_').val(percentage.toFixed(2));
            
            //total = rezs + rezs;

            $('.total_sum_pvn').val(total.toFixed(2));
        }
        
        $('.invoice_add').click(function() {
            $('.first_').clone().removeClass('first_').removeClass('hidden').insertBefore(".copy_before");

            // gala funkcijas
            getNumbering();
            getSumValue_('p_total_price');
        });

        $('#inv_table').delegate('.pointer_', 'click', function() {
            $(this).parent().parent().remove();

            // gala funkcijas
            getNumbering();
            getSumValue_('p_total_price');

        });

        //  pec ievaditajiem datiem apreƒ∑ina profit un gala summu    
        $('#inv_table').delegate('.p_price, .p_count', 'change keyup', function() {

            var $p = $(this).closest('tr');
            var p_price = $p.find('.p_price').val();
            var p_count = $p.find('.p_count').val();
            var rez = 0;



            if (p_price && (Number(p_count) || p_count != 0)) {
                rez = p_price * p_count;

                rez = rez.toFixed(2)

                $p.find(".p_total_price").val(rez);
            }

            getSumValue_('p_total_price');

        });
        
        $(document).ready(function() {
            $('.first_').clone().removeClass('first_').removeClass('hidden').insertBefore(".copy_before");
            getNumbering();
            getSumValue_('p_total_price');
            $("#clients").load('<?= base_url(); ?>invoice/ajax_clients/'+$("#klients").val());
        })
        
    </script>    
  </div>
</div>
<?php
$html = ' 
<!DOCTYPE html>
<html>
	<head>
		<title>PDF</title>
		<style>
		*
		{
			margin:0;
			padding:0;
			
		}
                .bottom {
                    margin-bottom:1mm;
                }
		body
		{
			width:100%;
			font-family:"Times New Roman",Times,serif;
            font-size:8pt;
            color:#000;
			margin:0;
			padding:0;
		}
        .desc {
            font-family: Palatino, "Palatino Linotype", "Palatino LT STD", "Book Antiqua", Georgia, serif;
            font-size:6pt;
            color:blue;
            line-height:20pt;
        }
		.wrapper {
			width:150mm;
                        height:150mm;
			margin-top:18mm;
			margin-left:34mm;
		}
                table {
                    width:100%;
                }
                .darbs td {
                    border:1px solid black;
                }
                .darbs {
                    font-size:7pt;
                    border-collapse:collapse;
                }
                
                .center {
                    text-align:center;
                }
                
                .left {
                    text-align:left;
                }
                
                .right {
                    text-align:right;
                }
                
                .1mm {
                    padding-left:1mm;
                }
                .10mm {
                    padding-left:9mm;
                }
                
                .10mm-right {
                    padding-right:9mm;
                    border:1px solid #fff;
                }
                
		</style>
	</head>
	<body>
		<div class="wrapper">
                    <table class="bottom">
                        <tr>
                            <td>
                                <img src="'.base_url(JADMIN_IMAGES).'/design/logopdf90.png" />
                            </td>
                        </tr>
                        <tr>
                            <td class="desc">
                                Juridiskie pakalpojumi. Nodokļu konsultācijas<br />
                                SIA, PVN reģ.nr. LV40003959602<br />
                                Kr.Barona iela 32, Rīga, LV1011<br />
                                Tālrunis +37122500220<br />
                                Fakss +37167286359<br />
                                www.legal-tax.lv
                            </td>
                        </tr>
                    </table>
                    <table class="bottom">
                        <tr>
                            <td style="text-align:center"><b>Faktūrrēķins Nr.</b>'.$data->rek_nr.'</td>
                        </tr>
                    </table>
                    <table class="bottom">
                        <tr>
                            <td>Datums: '.$this->main->ConvertDate($data->rek_datums).'</td>
                        </tr>
                    </table>
                    <table class="bottom">
                        <tr>
                            <td>
                                Pakalpojuma sniedzējs:<br /> 
                                PVN Reģ.Nr.: <br />
                                Adrese: <br />
                                Banka: <br />
                                Kods (SWIFT): <br />
                                <b>Konts (EUR):</b><br />
                                <b>Konts (EUR):</b><br />
                                Bankas adrese: <br />
                                Bankas reģ.nr. <br />
                            </td>
                            <td>
                                <b>SIA „Legal & Tax”</b><br />
                                <b>LV40003959602</b><br />
                                Kr.Barona iela 32-8, Rīga, LV-1011<br />
                                A/s DnB Nord Banka<br />
                                RIKOLV2X<br />
                                <b>LV41RIKO0002930045193</b><br />
                                <b>LV45RIKO0002013085594</b><br />
                                Smilšu iela 6, Rīga – 50, LV-1803<br />
                                40003024725<br />
                            </td>
                        </tr>
                    </table>
                    <table class="bottom">
                        <tr>
                            <td>
                                Pakalpojuma saņēmējs:<br /> 
                                PVN Reģ.Nr.:<br />
                                Adrese:
                            </td>
                            <td>
                                <b>'.$klients->name.'</b><br />
                                '.$klients->reg_nr.'<br />
                                '.$klients->adress.'<br />
                            </td>
                        </tr>
                    </table>
                    <table class="darbs bottom">
                        <tr>
                           <td style="width:8mm" class="left 1mm">
                                Nr.
                           </td>
                           <td style="width:67mm" class="center">
                                Palalpojums
                           </td>
                           <td style="width:21mm" class="left 1mm">
                                Mērvieniba
                           </td>
                           <td style="width:21mm" class="left 1mm">
                                Daudzums
                           </td>
                           <td style="width:15mm" class="left 1mm"> 
                                Cena EUR
                           </td>
                           <td style="width:16mm" class="left 1mm">
                                Summa
                           </td>
                        <tr>
                        ';
foreach($data_list as $v){
      $html .= '<tr>
                    <td class="left 1mm">'.$v->nr.'.</td>
                    <td class="left 1mm">'.$v->lieta.' ('.$this->main->Date($v->datums).' - '.$this->main->Date($v->datums_lidz).')<br /><i>'.$v->apraksts.'</i></td>
                    <td class="left 1mm">'.$v->type.'</td>
                    <td class="center">'.$v->time.'</td>
                    <td class="left 1mm">'.$v->cena.'</td>
                    <td class="left 1mm">'.$v->sum.'</td>
                </tr>';    
    
}
                        
                        
                                
              $html .= '<tr>
                            <td colspan="5" class="left 10mm">Kopā:</td>
                            <td class="left 1mm">'.$data->kopa.'</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="left 10mm">PVN (21%)</td>
                            <td class="left 1mm">'.$data->pvn.'</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="left 10mm">Summa apmaksai eiro</td>
                            <td class="right 10mm-right">EUR</td>
                            <td class="left 1mm"><b>'.$data->sum_kopa.'</b></td>
                        </tr>
                    </table>
                    <table class="bottom">
                        <tr>
                            <td>
                                Summa vārdiem (EUR):<br /> 
                                Pakalpojuma sniegšanas periods:<br />  
                                Pakalpojuma sniegšanas pamats:<br />  
                                Apmaksas veids:<br />  
                                Apmaksas termiņš:
                            </td>
                            <td>
                                '.$sum_text.'.<br /> 
                                '.$this->main->Date($data->no).'-'.$this->main->Date($data->lidz).'<br /> 
                                '.$data->pamats.'<br /> 
                                '.$data->apmaksas_type.'<br /> 
                                '.$data->apmaksas_termins.'<br />
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                Valdes loceklis: '.$data->valde.'
                            </td>
                            <td>
                                <br />
                                <br />
                                z.v
                            </td>
                        </tr>
                    </table>
		</div>
	</body>
</html>';
//echo $html;

?>

<?php

include("mpdf/mpdf.php");

//$_ID_list_count


$mpdf = new mPDF('utf-8', 'A4', '', '', 0, 0, 10, 50, 0, 0);

$mpdf->WriteHTML($html);

$mpdf->Output();

?>
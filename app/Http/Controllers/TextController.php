<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class TextController extends Controller
{
//\r\n \r\n


    public function save_first_text(Request $request)
    {

        $select_zaint_lico = $request->input('select_zaint_lico');
        $lico_v_otnoshenii = $request->input('lico_v_otnoshenii');
        $cel = $request->input('cel');
        $sdelka_soversh = $request->input('sdelka_soversh');
        $sdelka_s_akc = $request->input('sdelka_s_akc');
        $kolichestvo_akcii = $request->input('kolichestvo_akcii');
        $dolia_akcii = $request->input('dolia_akcii');
        $stoimost_akcii = $request->input('stoimost_akcii');
        $sdelka_s_doliami = $request->input('sdelka_s_doliami');
        $razmer_dolei_ust_fonda = $request->input('razmer_dolei_ust_fonda');


        $var_c = Subject::where('polnoe_naimenovanie', '=', $select_zaint_lico)->get();

//        dd($var_c[0]['polnoe_naimenovanie']);
        $var_c_polnoe_naimenovanie=$var_c[0]['polnoe_naimenovanie'];
        $var_c_socrasch_naimenovanie=$var_c[0]['socrasch_naimenovanie'];
        $var_c_FIO=$var_c[0]['FIO'];
        $var_c_mesto_nahozdenia=$var_c[0]['mesto_nahozdenia'];
        $var_c_pochtovyi_adres=$var_c[0]['pochtovyi_adres'];
        $var_c_nomer_rasch_sheta=$var_c[0]['nomer_rasch_sheta'];
        $var_c_naimenovanie_banka=$var_c[0]['naimenovanie_banka'];
        $var_c_BIC=$var_c[0]['BIC'];
        $var_c_razmer_ust_fonda=$var_c[0]['razmer_ust_fonda'];
        $var_c_balansovaja_stoim_aktivov=$var_c[0]['balansovaja_stoim_aktivov'];
        $var_c_vidy_tovarov=$var_c[0]['vidy_tovarov'];

        $var_c_2 = Subject::where('polnoe_naimenovanie', '=', $lico_v_otnoshenii)->get();

        $var_c_2_polnoe_naimenovanie=$var_c_2[0]['polnoe_naimenovanie'];
        $var_c_2_socrasch_naimenovanie=$var_c_2[0]['socrasch_naimenovanie'];
        $var_c_2_FIO=$var_c_2[0]['FIO'];
        $var_c_2_mesto_nahozdenia=$var_c_2[0]['mesto_nahozdenia'];
        $var_c_2_pochtovyi_adres=$var_c_2[0]['pochtovyi_adres'];
        $var_c_2_nomer_rasch_sheta=$var_c_2[0]['nomer_rasch_sheta'];
        $var_c_2_naimenovanie_banka=$var_c_2[0]['naimenovanie_banka'];
        $var_c_2_BIC=$var_c_2[0]['BIC'];
        $var_c_2_razmer_ust_fonda=$var_c_2[0]['razmer_ust_fonda'];
        $var_c_2_balansovaja_stoim_aktivov=$var_c_2[0]['balansovaja_stoim_aktivov'];
        $var_c_2_vidy_tovarov=$var_c_2[0]['vidy_tovarov'];
        $var_c_2_objem_viruchki=$var_c_2[0]['objem_viruchki'];


        $fd = fopen("text/Expertise.doc", 'w') or die("не удалось создать файл");
        $str =
"                                     Министерство антимонопольного
                                     регулирования и торговли Ресублики Беларусь
                                     (территориальный орган Министерства
                                     антимонопольного регулирования и торговли
                                     Республики Беларусь)
            
  Заявление о выдаче документа о согласии на совершение сделки с акциями, долями 
                     в уставных фондах хозяйствующих субъектов
    $var_c_polnoe_naimenovanie

    1. На основании статьи 18 Закона Республики Беларусь <<  О противодействии монополистической деятельности и развитии конкуренции>> просим дать согласие на совершение сделки с $sdelka_soversh
    2. Сведения о заинтересованном лице:
    2.1 наименование юридического лица (фамилия, собственное имя, отчество (если таковое имеется) индивидуального предпринимателя):
    полное $var_c_polnoe_naimenovanie
    сокращённое $var_c_socrasch_naimenovanie
    фамилия, собственное имя, отчество(если таковое имеется) $var_c_FIO
    
    2.2 место нахождения юридического лица (место жительства либо место пребывания индивидуального предпринимателя) $var_c_mesto_nahozdenia
    2.3 почтовый адрес $var_c_pochtovyi_adres
    2.4 расчётный счёт № $var_c_nomer_rasch_sheta в $var_c_naimenovanie_banka банковский идентификационный код $var_c_BIC
    2.5 размер уставного фонда юридического лица $var_c_razmer_ust_fonda
    2.6 балансовая стоимость активов ( для иностранных юридических лиц - стоимость общих активов) $var_c_balansovaja_stoim_aktivov
    2.7 основные виды товаров(работ,услуг) поставляемых на товарный рынок заинтересованным лицом ( в отношении иностранного юридического лица - также его филиалом, представительством, дочерним предприятием) $var_c_vidy_tovarov
    3. Сведения о лице, в отношении которого осуществляется сделка:
    3.1 наименование: 
    полное $var_c_2_polnoe_naimenovanie
    сокращённое $var_c_2_socrasch_naimenovanie
    3.2 место нахождения $var_c_2_mesto_nahozdenia
    3.3 почтовый адрес $var_c_2_pochtovyi_adres
    3.4 расчётный счёт № $var_c_2_nomer_rasch_sheta в $var_c_2_naimenovanie_banka банковский идентификационный код $var_c_2_BIC
    3.5 размер уставного фонда юридического лица $var_c_2_razmer_ust_fonda
    3.6 балансовая стоимость активов (для иностранных юридических лиц - стоимость общих активов ) $var_c_2_balansovaja_stoim_aktivov
    3.7 объём выручки от реализации товаров(работ, услуг) по итогам финансового года, предшествующего году приобретения $var_c_2_objem_viruchki
    
    4 Цель совершаемой сделки $cel
    5 Сведения о сделке:
    5.1 сделка с акциями в уставном фонде юридического лица будет совершена посредством $sdelka_soversh
    количество приобретаемх акций $kolichestvo_akcii
    доля приобретаемх акций $dolia_akcii
    стоимость приобретаемых акций в уставном фонде юридического лица, акции которого приобретаются, составляет $stoimost_akcii
    5.2 сделка с долями в уставном фонде юридического лица будет совершена посредством $sdelka_s_doliami
    размер долей в процентах от уставного фонда лица, в отношении которого осущствляется сделка $razmer_dolei_ust_fonda
    
    
    
    __________________       ________________         _____________________
       (должность)              (подпись)               (инициалы,фамилия)
        
        
        
              ______________________________________________________________________________
    (фамилия, собственное имя, отчество (если таковое имеется) исполнителя)
  
  
   ________________________
      контактный телефон
"

        ;
        fwrite($fd, $str);
        fclose($fd);
    }
}

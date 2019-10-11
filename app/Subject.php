<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $fillable = ['id','UNP','polnoe_naimenovanie','socrasch_naimenovanie',
        'FIO', 'mesto_nahozdenia','pochtovyi_adres','nomer_rasch_sheta','naimenovanie_banka',
        'BIC', 'razmer_ust_fonda','balansovaja_stoim_aktivov','objem_viruchki','vidy_tovarov',
        'rezident', 'status','dominant'];
}

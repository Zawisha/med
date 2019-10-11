<template>
<div>

    <div class="section">
        <div class="div-screen-1">
            <div class="div-block-8">
                <h1 class="heading">Подготовка документов</h1>
                <p class="paragraph exp vopros">Создание заявления для подачи в МАРТ:</p>
                <div class="div-block-10">
                    <div class="text-block-3">Заполните следующие поля:</div>
                    <div class="w-form">
                        <form id="wf-form-Form-Doc" name="wf-form-Form-Doc" data-name="Form Doc" v-on:submit.prevent="save">

                            <label class="field-label">Выберите принадлежность субъекта</label>
                            <div class="div-block-15" v-bind:class="{border_alert: elemInArr(20)}">
                                <label class="radio-button-field w-radio">
                                    <input  type="radio" data-name="Radio1"  name="Radio1" value="Резидент Беларуси" class="w-form-formradioinput w-radio-input" v-model="rezident"/>
                                    <span for="node-2" class="radio-button-label w-form-label">Резидент Беларуси</span>
                                </label>
                                <label class="w-radio">
                                    <input type="radio" checked="checked" data-name="Radio1"  name="Radio1" value="Нерезидент Беларуси" class="w-form-formradioinput w-radio-input" v-model="rezident" />
                                    <span for="node" class="radio-button-label-2 w-form-label">Нерезидент Беларуси</span></label>
                            </div>

                            <label class="field-label">Статус субъекта</label>
                            <div class="div-block-15" v-bind:class="{border_alert: elemInArr(21)}">
                                <label class="radio-button-field w-radio">
                                    <input type="radio" checked="checked" data-name="Radio2" id="node-2" name="Radio2" value="Юридическое лицо" class="w-form-formradioinput w-radio-input" v-model="status"/>
                                    <span for="node-3" class="radio-button-label w-form-label">Юридическое лицо</span>
                                </label>
                                <label class="radio-button-field w-radio">
                                <input type="radio" data-name="Radio2" id="node" name="Radio2" value="Предприниматель" class="w-form-formradioinput w-radio-input" v-model="status"/>
                                <span for="node-3" class="radio-button-label-2 w-form-label">Предприниматель</span>
                            </label>
                                <label class="w-radio"><input type="radio" data-name="Radio2" id="node-3" name="Radio2" value="Физическое лицо" class="w-form-formradioinput w-radio-input" v-model="status"/>
                                    <span for="node-3" class="radio-button-label-2 w-form-label">Физическое лицо</span>
                                </label>
                            </div>

                            <label for="name" class="field-label _1">Учётный номер плательщика</label>
                            <textarea v-bind:class="{border_alert: elemInArr(13)}"  placeholder="УНП" maxlength="5000" id="field13" name="field" class="textarea" v-model="UNP"></textarea>

                            <label for="name" class="field-label _1">Полное наименование юридического лица</label>
                            <textarea v-bind:class="{border_alert: elemInArr(1)}" placeholder="«Общество с ограниченной ответственностью &quot;Ромашка&quot;" maxlength="5000" id="field" name="field" class="textarea " v-model="polnoe_naimenovanie"></textarea>

                            <label for="name-2" class="field-label _1">Сокращённое наименование юридического лица</label>
                            <textarea v-bind:class="{border_alert: elemInArr(2)}" placeholder="ООО &quot;Ромашка&quot;" maxlength="5000" id="field-2" name="field-2" data-name="Field 2" class="textarea " v-model="socrasch_naimenovanie" ></textarea>

                            <label for="name-2" class="field-label _1">Фамилия, имя, отчество индивидуального предпринимателя</label>
                            <textarea v-bind:class="{border_alert: elemInArr(3)}" placeholder="Иванов Пётр Иванович" maxlength="5000" id="field-3" name="field-3" data-name="Field 3" class="textarea " v-model="FIO"></textarea>

                            <label for="name-4" class="field-label _1">Место нахождения юридического лица (место жительства либо место пребывания индивидуального предпринимателя)</label>
                            <textarea v-bind:class="{border_alert: elemInArr(4)}" placeholder="Адрес" maxlength="5000" id="field-4" name="field-4" data-name="Field 4" class="textarea " v-model="mesto_nahozdenia"></textarea>

                            <label for="name-4" class="field-label _1">Почтовый адрес значение</label>
                            <textarea v-bind:class="{border_alert: elemInArr(11)}" placeholder="Индекс" data-name="Field 11" maxlength="5000" id="field-11" name="field-11" class="textarea " v-model="pochtovyi_adres"></textarea>

                            <label for="name-4" class="field-label _1">Расчетный счет № (наименование банка, филиала)</label>
                            <input v-bind:class="{border_alert: elemInArr(5)}" placeholder="Расчётный счёт" type="text" class="textarea" maxlength="256" name="name-3" data-name="Name 3" id="name-5"  v-model="nomer_rasch_sheta"/>

                            <label for="name-4" class="field-label _1">Наименование банка </label>
                            <textarea v-bind:class="{border_alert: elemInArr(9)}" placeholder="Наименование банка" data-name="Field 9" maxlength="5000" id="field-9" name="field-9" class="textarea " v-model="naimenovanie_banka"></textarea>

                            <label for="name-4" class="field-label _1">Банковский идентификационный код (далее – БИК) банка</label>
                            <textarea v-bind:class="{border_alert: elemInArr(8)}" data-name="Field 8" maxlength="5000" id="field-8" name="field-8" class="textarea " v-model="BIC"></textarea>

                            <label for="name-4" class="field-label _1">Размер уставного фонда юридического лица</label>
                            <textarea v-bind:class="{border_alert: elemInArr(10)}" data-name="Field 10" maxlength="5000" id="field-10" name="field-10" class="textarea " v-model="razmer_ust_fonda"></textarea>

                            <label for="name-4" class="field-label _1">Балансовая стоимость активов (для иностранных юридических лиц – стоимость общих активов), бел.руб.</label>
                            <textarea v-bind:class="{border_alert: elemInArr(14)}" placeholder="На 12.10.2019" data-name="Field 10" maxlength="5000" id="field-14" name="field-10" class="textarea " v-model="balansovaja_stoim_aktivov"></textarea>

                            <label for="name-4" class="field-label _1">Объем выручки от реализации товаров (работ, услуг) по итогам финансового года, предшествующего году приобретения, бел.руб.</label>
                            <textarea v-bind:class="{border_alert: elemInArr(15)}" placeholder="За период 1.03.2019-1.06.2019" data-name="Field 10" maxlength="5000" id="field-15" name="field-10" class="textarea " v-model="objem_viruchki"></textarea>

                            <label for="name-4" class="field-label _1">Основные виды товаров (работ, услуг), поставляемых на товарный рынок заинтересованным лицом (в отношении иностранного юридического лица – также его филиалом, представительством, дочерним предприятием)</label>
                            <textarea v-bind:class="{border_alert: elemInArr(7)}" data-name="Field 7" maxlength="5000" id="field-7" name="field-7" class="textarea " v-model="vidy_tovarov"></textarea>

                            <label class="field-label" >Доминант/Естественный монополист (республиканский уровень</label>
                            <div class="div-block-15" v-bind:class="{border_alert: elemInArr(22)}">
                            <label class="radio-button-field w-radio">
                                <input type="radio" data-name="Radio2" id="node-4" name="Radio3" value="Да" class="w-form-formradioinput w-radio-input" v-model="dominant"/>
                                <span for="node-3" class="radio-button-label-2 w-form-label">Да</span>
                            </label>
                            <label class="w-radio"><input type="radio" data-name="Radio2" id="node-5" name="Radio3" value="Нет" class="w-form-formradioinput w-radio-input" v-model="dominant"/>
                                <span for="node-3" class="radio-button-label-2 w-form-label">Нет</span>
                            </label>
                            </div>

                            <div class="div-block-16">
                                <input type="submit" value="Сохранить" data-wait="Please wait..." class="button-5 yes new w-button" />
<!--                                <input type="submit" value="Печать документа" data-wait="Please wait..." class="button-5 yes new w-button"/>-->
<!--                                <input type="submit" value="Выбор из базы" data-wait="Please wait..." class="button-5 yes new w-button"/>-->
                            </div>
                        </form>
                        <div class="w-form-done"><div>Thank you! Your submission has been received!</div></div>
                        <div class="w-form-fail"><div>Oops! Something went wrong while submitting the form.</div></div>
                    </div></div></div></div></div>
    <div class="section-2"><div class="div-block-7"><div class="columns w-row"><div class="w-col w-col-6"><div><div class="text-block">  © Все права защищены</div></div></div><div class="w-col w-col-6"></div></div></div></div>

</div>


<!--    <div>-->
<!--        <button type="button" class="btn btn-primary btn-block procedure_button" v-on:click="test" >TEST</button>-->
<!--    </div>-->

</template>

<script>

    export default {

        data(){

            return {
                rezident:0,
                status:0,
                polnoe_naimenovanie:'',
                socrasch_naimenovanie:'',
                FIO:'',
                mesto_nahozdenia:'',
                pochtovyi_adres:'',
                razmer_ust_fonda:'',
                nomer_rasch_sheta:'',
                naimenovanie_banka:'',
                BIC:'',
                vidy_tovarov:'',
                UNP:'',
                balansovaja_stoim_aktivov:'',
                objem_viruchki:'',
                dominant:'',
                alarm:false,
                alarm_arr:[]
            }
        },
        mounted() {

        },
        methods: {
elemInArr(numb)
{
    return this.alarm_arr.indexOf(numb) === -1 ? false : true
},
save()
{
      this.alarm =false;
      this.alarm_arr=[];

    this.check(this.UNP, 13);
    this.check(this.polnoe_naimenovanie, 1);
    this.check(this.socrasch_naimenovanie, 2);
    this.check(this.FIO, 3);
    this.check(this.mesto_nahozdenia, 4);
    this.check(this.pochtovyi_adres, 11);
    this.check(this.nomer_rasch_sheta, 5);
    this.check(this.naimenovanie_banka, 9);
    this.check(this.BIC, 8);
    this.check(this.razmer_ust_fonda, 10);
    this.check(this.balansovaja_stoim_aktivov, 14);
    this.check(this.objem_viruchki, 15);
    this.check(this.vidy_tovarov, 7);
    this.check(this.rezident, 20);
    this.check(this.status, 21);
    this.check(this.dominant, 22);


if(this.alarm==false)
{
    axios
        .post('/save_subject',{
            UNP:this.UNP,
            polnoe_naimenovanie:this.polnoe_naimenovanie,
            socrasch_naimenovanie:this.socrasch_naimenovanie,
            FIO:this.FIO,
            mesto_nahozdenia:this.mesto_nahozdenia,
            pochtovyi_adres:this.pochtovyi_adres,
            nomer_rasch_sheta:this.nomer_rasch_sheta,
            naimenovanie_banka:this.naimenovanie_banka,
            BIC:this.BIC,
            razmer_ust_fonda:this.razmer_ust_fonda,
            balansovaja_stoim_aktivov:this.balansovaja_stoim_aktivov,
            objem_viruchki:this.objem_viruchki,
            vidy_tovarov:this.vidy_tovarov,
            rezident:this.rezident,
            status:this.status,
            dominant:this.dominant

        }).then( Vue.router.push({name:'doc_subject', params: { notification_sub:true}}))
}



},

check(inp,numb)
{
    if(inp =='')
    {
        this.alarm = true;
        this.alarm_arr.push(numb);
    }

}

        },

    }
</script>

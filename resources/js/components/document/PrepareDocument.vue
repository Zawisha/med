<template>
<div>

    <div class="section">
        <div class="div-screen-1">
            <div class="div-block-8">
                <h1 class="heading">Подготовка документов</h1>
                <p class="paragraph exp vopros">Создание заявления для подачи в МАРТ:</p>
                <div class="div-block-10">
                    <div class="text-block-3">Заполните следующие поля и получите готовый документ:</div>
                    <div class="w-form">
                        <form id="wf-form-Form-Doc" name="wf-form-Form-Doc" data-name="Form Doc" v-on:submit.prevent="save">
                            <label class="field-label">Выберите принадлежность субьекта</label>
                            <div class="div-block-15">
                                <label class="radio-button-field w-radio">
                                    <input type="radio" data-name="Radio1"  name="Radio1" value="Резидент Беларуси" class="w-form-formradioinput w-radio-input" v-model="rezident"/>
                                    <span for="node-2" class="radio-button-label w-form-label">Резидент Беларуси</span>
                                </label>
                                <label class="w-radio">
                                    <input type="radio" data-name="Radio1"  name="Radio1" value="Нерезидент Беларуси" class="w-form-formradioinput w-radio-input" v-model="rezident" />
                                    <span for="node" class="radio-button-label-2 w-form-label">Нерезидент Беларуси</span></label>
                            </div>
                            <label class="field-label">Статус субъекта</label>
                            <div class="div-block-15">
                                <label class="radio-button-field w-radio">
                                    <input type="radio" data-name="Radio2" id="node-2" name="Radio2" value="Юридическое лицо" class="w-form-formradioinput w-radio-input" v-model="status"/>
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
                            <label for="name" class="field-label _1">Введите полное название организационно-правовой формы юридического лица</label>
                            <textarea placeholder="ООО &quot;Конфетка&quot;" maxlength="5000" id="field" name="field" class="textarea w-input" v-model="polnoe_nazvanie"></textarea>
                            <label for="name-2" class="field-label _1">Фирменное наименование / написанное кириллицей фирменное наименование</label>
                            <textarea placeholder="Конфетка" maxlength="5000" id="field-2" name="field-2" data-name="Field 2" class="textarea w-input" v-model="firmennoe_naimenovanie" ></textarea>
                            <label for="name-2" class="field-label _1">Фамилия, имя, отчество индивидуального предпринимателя</label>
                            <textarea placeholder="Иванова Ольга Николаева" maxlength="5000" id="field-3" name="field-3" data-name="Field 3" class="textarea w-input" v-model="FIO"></textarea>
                            <label for="name-4" class="field-label _1">Место нахождения юридического лица</label>
                            <textarea placeholder="Республика Беларусь, г. Минск, ул. Гоголя 14, оф.15" maxlength="5000" id="field-4" name="field-4" data-name="Field 4" class="textarea w-input" v-model="mesto_nahozdenia"></textarea>
                            <label for="name-4" class="field-label _1">Место жительства/пребывания индивидуального предпринимателя</label>
                            <textarea placeholder="ООО &quot;Конфетка&quot;" maxlength="5000" id="field-12" name="field-12" data-name="Field 12" class="textarea w-input" v-model="mesto_zitelstva"></textarea>
                            <label for="name-4" class="field-label _1">Почтовый адрес</label>
                            <textarea data-name="Field 11" maxlength="5000" id="field-11" name="field-11" class="textarea w-input" v-model="pochtovyi_adres"></textarea>
                            <label for="name-4" class="field-label _1">Размер уставного фонда юридического лица</label>
                            <textarea data-name="Field 10" maxlength="5000" id="field-10" name="field-10" class="textarea w-input" v-model="razmer_ust_fonda"></textarea>
                            <label for="name-4" class="field-label _1">Номер расчётного счёта </label>
                            <input type="text" class="w-input" maxlength="256" name="name-3" data-name="Name 3" id="name-3"  v-model="nomer_rasch_sheta"/>
                            <label for="name-4" class="field-label _1">Наименование банка </label>
                            <textarea data-name="Field 9" maxlength="5000" id="field-9" name="field-9" class="textarea w-input" v-model="naimenovanie_banka"></textarea>
                            <label for="name-4" class="field-label _1">BIC-код банка</label>
                            <textarea data-name="Field 8" maxlength="5000" id="field-8" name="field-8" class="textarea w-input" v-model="BIC"></textarea>
                            <label for="name-4" class="field-label _1">Балансовая стоимость активов / стоимость общих активов (для иностранных юридических лиц)</label>
                            <textarea data-name="Field 6" maxlength="5000" id="field-6" name="field-6" class="textarea w-input" v-model="balansov_stoim_aktivov_inostr"></textarea>
                            <label for="name-4" class="field-label _1">Основные виды товаров (работ, услуг), поставляемых на товарный рынок <em>(выбор из справочника)</em></label>
                            <textarea data-name="Field 7" maxlength="5000" id="field-7" name="field-7" class="textarea w-input" v-model="vidy_tovarov"></textarea>
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
                polnoe_nazvanie:'',
                firmennoe_naimenovanie:'',
                FIO:'',
                mesto_nahozdenia:'',
                mesto_zitelstva:'',
                pochtovyi_adres:'',
                razmer_ust_fonda:'',
                nomer_rasch_sheta:'',
                naimenovanie_banka:'',
                BIC:'',
                balansov_stoim_aktivov_inostr:'',
                vidy_tovarov:''
            }
        },
        mounted() {

        },
        methods: {

save()
{
    axios
        .post('/save_first_text',{
            rezident:this.rezident,
            status:this.status,
            polnoe_nazvanie:this.polnoe_nazvanie,
            firmennoe_naimenovanie:this.firmennoe_naimenovanie,
            FIO:this.FIO,
            mesto_nahozdenia:this.mesto_nahozdenia,
            mesto_zitelstva:this.mesto_zitelstva,
            pochtovyi_adres:this.pochtovyi_adres,
            razmer_ust_fonda:this.razmer_ust_fonda,
            nomer_rasch_sheta:this.nomer_rasch_sheta,
            naimenovanie_banka:this.naimenovanie_banka,
            BIC:this.BIC,
            balansov_stoim_aktivov_inostr:this.balansov_stoim_aktivov_inostr,
            vidy_tovarov:this.vidy_tovarov

        }).then( Vue.router.push({name:'get_doc'}))
}
        },

    }
</script>

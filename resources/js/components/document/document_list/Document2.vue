<template>
<div>

    <div class="section">
        <div class="div-screen-1">
            <div class="div-block-8">
                <h1 class="heading">Подготовка документов 2</h1>
                <div class="div-block-10">
                    <div class="text-block-3">Заполните следующие поля:</div>
                    <div class="w-form">
                        <form id="wf-form-Form-Doc" name="wf-form-Form-Doc" data-name="Form Doc" v-on:submit.prevent="save">

                            <label for="name" class="field-label _1">Заинтересованное лицо (которое обращается за согласием)</label>

                            <v-select v-model="select_zaint_lico" :options="arr_m" placeholder="Выберите заинтересованное лицо" @search="getDBrequestAutocomplete"></v-select>
                            <label for="name-2" class="field-label _1">Лицо, в отношении которого осуществляется сделка</label>


                            <v-select v-model="lico_v_otnoshenii" :options="arr_m1" placeholder="Выберите лицо, в отношении которого осуществляется сделка" @search="getDBrequestAutocomplete1"></v-select>

                            <label for="name-2" class="field-label _1">Цель совершаемой сделки</label>
                            <textarea v-bind:class="{border_alert: elemInArr(3)}" maxlength="5000" id="field-3" name="field-3" data-name="Field 3" class="textarea " v-model="cel"></textarea>

                            <label class="field-label">Сделка совершается с</label>
                            <div class="div-block-15" v-bind:class="{border_alert: elemInArr(20)}">
                                <label class="radio-button-field w-radio">
                                    <input  type="radio" data-name="Radio1"  name="Radio1" value="акциями в уставном фонде" class="w-form-formradioinput w-radio-input" v-model="sdelka_soversh"/>
                                    <span for="node-2" class="radio-button-label w-form-label">акциями в уставном фонде</span>
                                </label>
                                <label class="w-radio">
                                    <input type="radio" data-name="Radio1"  name="Radio1" value="долями в уставном фонде" class="w-form-formradioinput w-radio-input" v-model="sdelka_soversh" />
                                    <span for="node" class="radio-button-label-2 w-form-label">долями в уставном фонде</span></label>
                            </div>

<div v-if="sdelka_soversh=='акциями в уставном фонде'">
                            <label for="name-4" class="field-label _1" >Сделка с акциями будет совершена посредством</label>
                            <textarea v-bind:class="{border_alert: elemInArr(4)}" placeholder="заключения договора (купли-продажи, доверительного управления имуществом, поручения, иной договор)" maxlength="5000" id="field-4" name="field-4" data-name="Field 4" class="textarea " v-model="sdelka_s_akc"></textarea>

                            <label for="name-4" class="field-label _1">Количество приобретаемых акций</label>
                            <textarea v-bind:class="{border_alert: elemInArr(11)}"  data-name="Field 11" maxlength="5000" id="field-11" name="field-11" class="textarea " v-model="kolichestvo_akcii"></textarea>

                            <label for="name-4" class="field-label _1">Доля приобретаемых акций</label>
                            <textarea v-bind:class="{border_alert: elemInArr(5)}" placeholder="в процентах от уставного фонда юридического лица, акции которого приобретаются" type="text" class="textarea" maxlength="256" name="name-3" data-name="Name 3" id="name-5"  v-model="dolia_akcii"></textarea>

                            <label for="name-4" class="field-label _1">Стоимость приобретаемых акций</label>
                            <textarea v-bind:class="{border_alert: elemInArr(9)}" data-name="Field 9" maxlength="5000" id="field-9" name="field-9" class="textarea " v-model="stoimost_akcii"></textarea>
</div >

<div v-if="sdelka_soversh=='долями в уставном фонде'">
                            <label for="name-4" class="field-label _1">Сделка с долями будет совершена посредством</label>
                            <textarea v-bind:class="{border_alert: elemInArr(8)}" placeholder="заключения договора (купли-продажи, доверительного управления имуществом, поручения, иной договор" data-name="Field 8" maxlength="5000" id="field-8" name="field-8" class="textarea " v-model="sdelka_s_doliami"></textarea>

                            <label for="name-4" class="field-label _1">Размер долей в процентах от уставного фонда</label>
                            <textarea v-bind:class="{border_alert: elemInArr(10)}" data-name="Field 10" maxlength="5000" id="field-10" name="field-10" class="textarea " v-model="razmer_dolei_ust_fonda"></textarea>
</div>

                            <div class="div-block-16 get_deal_but">
                                <input type="submit" value="Сохранить" data-wait="Please wait..." class="button-5 yes new w-button" />
                            </div>

                        </form>
                        <div class="w-form-done"><div>Thank you! Your submission has been received!</div></div>
                        <div class="w-form-fail"><div>Oops! Something went wrong while submitting the form.</div></div>
                    </div></div></div></div></div>
</div>


<!--    <div>-->
<!--        <button type="button" class="btn btn-primary btn-block procedure_button" v-on:click="test" >TEST</button>-->
<!--    </div>-->

</template>

<script>

    export default {

        data(){

            return {
                cel:'',
                sdelka_soversh:'',
                status:0,
                polnoe_naimenovanie:'',
                socrasch_naimenovanie:'',
                sdelka_s_akc:'',
                kolichestvo_akcii:'',
                razmer_dolei_ust_fonda:'',
                dolia_akcii:'',
                stoimost_akcii:'',
                sdelka_s_doliami:'',
                vidy_tovarov:'',
                balansovaja_stoim_aktivov:'',
                objem_viruchki:'',
                dominant:'',
                alarm:false,
                alarm_arr:[],
                zaint_lico_arr:[
                ],
                select_zaint_lico:'',
                lico_v_otnoshenii:'',
                deal_with:0,
                arr_m:[],
                arr_m1:[]
            }
        },
        mounted() {
            this.render_start_array(this.documents_array);
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

    this.check(this.select_zaint_lico, 30);
    this.check(this.lico_v_otnoshenii, 31);
    this.check(this.cel, 3);
    this.check(this.sdelka_soversh, 20);

    if(this.sdelka_soversh=='акциями в уставном фонде')
    {
    this.check(this.sdelka_s_akc, 4);
    this.check(this.kolichestvo_akcii, 11);
    this.check(this.dolia_akcii, 5);
    this.check(this.stoimost_akcii, 9);
    }
    if(this.sdelka_soversh=='долями в уставном фонде')
    {
    this.check(this.sdelka_s_doliami, 8);
    this.check(this.razmer_dolei_ust_fonda, 10);
    }

if(this.alarm==false)
{
    axios
        .post('/save_first_text',{
            select_zaint_lico:this.select_zaint_lico,
            lico_v_otnoshenii:this.lico_v_otnoshenii,
            cel:this.cel,
            sdelka_soversh:this.sdelka_soversh,
            sdelka_s_akc:this.sdelka_s_akc,
            kolichestvo_akcii:this.kolichestvo_akcii,
            dolia_akcii:this.dolia_akcii,
            stoimost_akcii:this.stoimost_akcii,
            sdelka_s_doliami:this.sdelka_s_doliami,
            razmer_dolei_ust_fonda:this.razmer_dolei_ust_fonda

        }).then( Vue.router.push({name:'get_doc'}))
}



},

check(inp,numb)
{
    if(inp =='')
    {
        this.alarm = true;
        this.alarm_arr.push(numb);
    }

},

            render_star_arr(inp)
            {
                axios
                    .post('/render_documents',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                        id_block:this.$store.state.block_id,
                    }).then(({ data }) =>
                    {
                        if(data.length != 0)
                        {
                            this.text_block_name = data[0].block_name,
                                this.question = data[0].question_text,

                                data.forEach(function(entry) {
                                    if(entry.answer_text!==''){
                                        inp.push({
                                            text:entry.answer_text,
                                            link_id:entry.answer_link_id,
                                            link_name:entry.answer_link_name,

                                        });
                                    }
                                })
                        }

                    }

                );
            },

            getDBrequestAutocomplete (input) {
                this.arr_m = [];
                if(input!='') {
                    let arr_md = [];
                    axios
                        .post('/get_autocomplete', {
                            req_string: input,
                        })
                        .then(({data}) => {
                                data.forEach(function (entry) {
                                    arr_md.push(
                                        // id:entry.id,
                                        entry.polnoe_naimenovanie,
                                    );
                                })
                            }
                        )


                    return this.arr_m = arr_md;
                }
            },

            getDBrequestAutocomplete1 (input) {
                this.arr_m1 = [];
                if(input!='') {
                    let arr_md = [];
                    axios
                        .post('/get_autocomplete', {
                            req_string: input,
                        })
                        .then(({data}) => {
                                data.forEach(function (entry) {
                                    arr_md.push(
                                        // id:entry.id,
                                        entry.polnoe_naimenovanie,
                                    );
                                })
                            }
                        )


                    return this.arr_m1 = arr_md;
                }
            },



        },

    }
</script>

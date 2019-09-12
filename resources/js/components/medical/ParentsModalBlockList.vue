<template>
    <transition name="parents_modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="link">
                            qweeee
                        </slot>
                    </div>
<div> {{ block }} </div>
                    <div> {{ string_par }} </div>
                    <div class="modal-body">
                        <slot name="body">
                            <div v-for="item in modal_blocks">
                                <p class=" bg-success text-white rounded mybtn" style="white-space: pre-line"  @click="$emit('parents_close', {id_block_modal: item.id_block,
                    block_name_modal: item.block_name})">
                                    {{ item.block_name }} => {{ item.id_block }}
                                </p>
                            </div>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            default footer
                            <button class="modal-default-button" @click="$emit('parents_close')">
                                OK
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    export default {
        data(){
            return {
                modal_blocks: [],
            }
        },

        //номер в массиве выбранного вопроса
props:['block','string_par'],

        mounted() {
console.log('qwe');
            //current main_procedure
            this.modal_show_block_list(this.modal_blocks, this.block);


        },
        created(){
        },
        methods:
        {
            modal_show_block_list(inp, block)
            {

                axios
                    .post('/api/render_blocks',{
                        id_post:this.$store.state.post_id,
                        id_procedure:this.$store.state.current_main_procedure,
                    }).then(({ data }) => (
                        data.forEach(function(entry) {
                            if(entry.id_block!= block)
                            {
                                inp.push({
                                    id_block:entry.id_block,
                                    block_name:entry.block_name,
                                });
                            }
                        })
                    )
                );

            },

        }
    }
</script>

<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>

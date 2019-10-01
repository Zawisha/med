<template>
    <transition name="parents_modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="link">
                        </slot>
                    </div>
                    <div class="modal-body">
                        <slot name="body">
                            <div class="alert alert-secondary my_pointer" @click="$emit('parents_close', {id_block_modal:0,
                    block_name_modal:''})" >Ни один из блоков</div>
                            <div v-for="item in modal_blocks">
                                <div class="alert alert-dark my_pointer"  @click="$emit('parents_close', {id_block_modal: item.id_block,
                    block_name_modal: item.block_name})">
                                    {{ item.block_name }}
                                </div>
                            </div>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="modal-default-button" @click="$emit('parents_close')">
                                Закрыть
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
                    .post('/render_blocks',{
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
        overflow: auto;
        height: 400px;
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

    .parents_modal-enter {
        opacity: 0;
    }

    .parents_modal-leave-active {
        opacity: 0;
    }

    .parents_modal-enter .modal-container,
    .parents_modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>

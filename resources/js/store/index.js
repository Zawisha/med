import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        namePost: '',
        lineCounter:0,
        navigation:[0],
        //какой пост находится в работе сейчас
        post_id:0,
        current_main_procedure:0,
    },
    getters: {
        LAST_ELEM: state => {
            return state.navigation[state.navigation.length - 1];
        },
    },
    mutations: {
        removeTv(state, amount)
        {
            state.namePost = amount;
        },
        upLine(state)
        {
            state.lineCounter++;
        },
        setPost(state, numb)
        {
            state.post_id=numb;
        },
        add_to_nav(state,numb)
        {
            state.navigation.push(numb);
        },
        spl_elem(state,numb)
        {
            state.navigation.splice(numb);
        },
        line_setup(state,numb)
        {
            state.lineCounter=numb;
        },
        CurrentMainProcedure_setup(state,numb)
        {
            state.current_main_procedure=numb;
        }
    },
    actions: {
        changeName(context, amount)
        {
        context.commit('removeTv', amount);
        },
        upLineCounter(context)
        {
            context.commit('upLine');
        },
        setPostCounter(context, numb)
        {
            context.commit('setPost', numb);
        },
        change_nav(context, numb)
        {
            context.commit('add_to_nav', numb);
        },
        spliceElem(context, numb)
        {
            context.commit('spl_elem',numb);
        },
        setLineCounter(context,numb)
        {
            context.commit('line_setup',numb);
        },
        setCurrentMainProcedure(context,numb)
        {
            context.commit('CurrentMainProcedure_setup',numb);
        }


    },
});

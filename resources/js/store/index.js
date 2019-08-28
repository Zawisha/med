import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        totalTvCount: '',
        lineCounter:0,
        navigation:[0],
    },
    getters: {},
    mutations: {
        removeTv(state, amount)
        {
            state.totalTvCount = amount;
        },
        upLine(state)
        {
            state.lineCounter++;
        },
        add_to_nav(state,numb)
        {
            state.navigation.push(numb);
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
        change_nav(context, numb)
        {
            context.commit('add_to_nav', numb);
        }


    },
});

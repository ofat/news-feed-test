import Vue from 'vue';
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        comments: []
    },
    mutations: {
        updateComments(state, items) {
            state.comments = items;
        }
    },
    actions: {
        loadComments({ commit }, {postId}) {
            axios.get('/api/comments/'+postId)
                .then(res => {
                    commit('updateComments', res.data);
                })
        },
        addComment({ commit }, data) {
            return new Promise((resolve, reject) => {
                axios.post('/api/save-comment', data).then(res => {
                    resolve()
                })
            });
        }
    }
});

export default store;
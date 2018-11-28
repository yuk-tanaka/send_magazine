import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    //メール送信先リスト['name' => 'email']
    sends: [],
  },
  mutations: {
    /**
     * elementUi uploadから整形済jsonを受け取る
     * @param state
     * @param sends
     */
    sends: (state, sends) => state.sends = sends,
  },
  getters: {
    /**
     * @returns int
     */
    sendsCount: (state) => state.sends.length,

    /**
     * @returns Object
     */
    postValues: (state) => (formValues) => Object.assign(formValues, {sends: state.sends}),
  },
  actions: {}
});
import Vue from 'vue'
import Vuex from 'vuex'
import admin from './modules/admin'
import site from './modules/site'
import slider from './modules/slider'
import plants from './modules/plants'
import sender from './modules/sender'

Vue.use(Vuex);

export default new Vuex.Store({
    modules:
    {
        admin,
        site,
        slider,
        plants,
        sender
    }
});

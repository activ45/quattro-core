import Vue from "vue";
// import {App, plugin} from "@inertiajs/inertia-vue";
import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import {Notyf} from "notyf";


import plug from "./_plugin";
import VueTablerIcons from "vue-tabler-icons";
import VueSweetalert2 from "vue-sweetalert2";
import VueMeta from "vue-meta";
import User from "../Models/User";
import UserPaginate from "../Models/User/UserPaginate";

//region Vue plugins initialize
InertiaProgress.init()
Vue.prototype.$notyf = new Notyf({
    position: {x:'right',y:'bottom'},
    duration: 3500,
    types: [
        {
            type: 'info',
            background: '#4299e1',
            icon: {
                className: 'notyf__icon--info',
                tagName: 'i',
                text: ''
            }
        },
        {
            type: 'warning',
            background: 'orange',
            icon: {
                className: 'notyf__icon--warning',
                tagName: 'i',
                text: ''
            }
        },
    ]
})
Vue.use(plug)
Vue.use(VueTablerIcons)
Vue.use(VueSweetalert2,{confirmButtonText:'Tamam',cancelButtonText:'Vazgeç'});
Vue.use(VueMeta)

//endregion

createInertiaApp({
    resolve: name => require(`../Pages/${name}`),
    setup({ el, app, props }) {
        new Vue({
            metaInfo: {
                titleTemplate: title => (title ? `${title} - Quattro` : 'Quattro'),
                htmlAttrs: {
                    lang: 'tr',
                    amp: false
                }
            },
            render: h => h(app, props),
        }).$mount(el)
    },
})
/*
const el = document.getElementById('app')
new Vue({
    metaInfo: {
        title:'',
        titleTemplate: '%s - Quattro',
        htmlAttrs: {
            lang: 'tr',
            amp: false
        }
    },
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`../Pages/${name}`).default,
            transformProps: props => {
                return {
                    ...props,
                    user: new User(props.user),
                    page_users: new UserPaginate(props.page_users),
                    // errors: new Errors(props.errors),
                }
            },
        },
    })
}).$mount(el)
*/

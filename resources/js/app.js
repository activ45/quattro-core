import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2';
import plug from "./plugin";
import VueTablerIcons, {AlertTriangleIcon} from 'vue-tabler-icons';
import { Notyf } from 'notyf';
import vueFilePond from "vue-filepond";

import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init()

window.notyf = new Notyf();
import User from './Models/User'
import Errors from './Models/Errors'

let moment = require("moment");
require("./quattro");

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
Vue.use(plugin)
Vue.use(plug)
Vue.use(VueTablerIcons)
Vue.use(VueSweetalert2);

const el = document.getElementById('app')
new Vue({
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
            transformProps: props => {
                return {
                    ...props,
                    user: new User(props.user),
                    // errors: new Errors(props.errors),
                }
            },
        },
    }),
}).$mount(el)


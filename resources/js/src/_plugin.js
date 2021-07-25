import * as moment from 'moment';
import 'moment/locale/tr'
import { Inertia } from '@inertiajs/inertia'

export default {
    install: (app, options) => {
        moment.locale('tr')
        app.mixin({
            created() {
                if (this._uid===0) {
                    Inertia.on('error', (errors) => {
                        this.$notyf.error('Bir hata oluştu!')
                    })
                }
            },
            mounted() {
            },
            methods: {
                route: (name, params, absolute) => route(name, params, absolute),
                asset(url){

                    return this.$page.props.app.asset_url+ url;
                },
                userHasRole(role,user=null){
                    user = user === null ? this.$page.props.user : user;
                    return user.roles.some((r)=>r.name === role);
                },
                userHasPermission(perm,user=null){
                    user = user === null ? this.$page.props.user : user;
                    return user.permissions_all.some((p)=>p.name === perm);
                },
                swalConfirm(text){
                    return this.$swal({
                        title: 'Emin misin?',
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Hayır',
                        confirmButtonText: 'Evet'
                    })
                }
            },
            filters: {
                moment: function (date) {
                    return moment(date).format('DD/MM/YYYY HH:mm');
                },
                moments: function (date) {
                    return moment(date).format('DD/MM/YYYY HH:mm:ss');
                },
                momentFromNow: function (date) {

                    return moment(date).fromNow();
                }
            }
        })
    }
}

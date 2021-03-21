import moment from 'moment'


export default {
    install: (app, options) => {
        app.mixin({
            created() {
            },
            methods: {
                route: (name, params, absolute) => route(name, params, absolute),
                asset(url){

                    return this.$page.props.app.asset_url+ url;
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
                }
            }
        })
    }
}

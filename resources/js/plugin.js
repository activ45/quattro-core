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

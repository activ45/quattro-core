<template>
</template>

<script>
export default {
    name: "FlashMessage",
    data() {
        return {

        };
    },
    props:{
        notifications:Array
    },
    mounted() {
        this.flash()
        this.swal()
        this.$inertia.on('finish', (event) => this.flash())

    },
    methods:{
        swal(){
            if(this.$page.props.swal.title != null || this.$page.props.swal.text != null || this.$page.props.swal.html != null)
            this.$swal.fire(this.$page.props.swal)
        },
        flash(){
            this.$notyf.options.position.y = this.$page.props.hasOwnProperty('user.settings.notyf_yposition') ? this.$page.props.user.settings.notyf_yposition : 'bottom';
            this.$notyf.options.position.x = this.$page.props.hasOwnProperty('user.settings.notyf_xposition') ? this.$page.props.user.settings.notyf_xposition : 'right';

            for (let notyf of this.notifications){
                if(notyf.type === 'danger')
                    notyf.type = 'error';
                if(notyf.dismissible){
                    notyf.duration = 0;
                }
                this.$notyf.open(notyf);

            }
            this.notifications.splice(0,this.notifications.length);
        }
    }
}
</script>

<style scoped>

</style>

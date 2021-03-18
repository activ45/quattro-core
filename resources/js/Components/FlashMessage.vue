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
        this.$notyf.options.position.y = this.$page.props.user.settings.notyf_yposition;
        this.$notyf.options.position.x = this.$page.props.user.settings.notyf_xposition;

        for (let notyf of this.notifications){

            if(notyf.type === 'danger')
                notyf.type = 'error';
            if(notyf.dismissible){
                notyf.duration = 0;
            }
            this.$notyf.open(notyf);

        }
    }
}
</script>

<style scoped>

</style>

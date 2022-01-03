<template>
    <avatar username="Jane Doe"></avatar>
</template>

<script>
import Avatar from 'vue-avatar'

export default {
    name: "Avatar",
    props: {
        src:String,
        user:Object
    },
    components:{
        Avatar
    },
    methods:{
        getSrc(){
            if(this.user)
                return this.user.profile_photo_url;
            else
                return this.src;
        }
    }
}
</script>

<style scoped>

</style>

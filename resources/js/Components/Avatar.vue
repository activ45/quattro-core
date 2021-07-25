<template>
<span class="avatar"
      :style="'background-image: url('+getSrc()+')'">
    <slot></slot>
</span>
</template>

<script>
export default {
    name: "Avatar",
    props: {
        src:String,
        user:Object
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

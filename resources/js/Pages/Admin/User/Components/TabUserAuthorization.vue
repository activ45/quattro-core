<template>
    <div>
        yetkilendirme
    </div>
</template>

<script>
export default {
    name: "TabUserAuthorization",
    props:{
        user:{
            type: Object,
            required: true
        }
    },
    data(){
        return {
            process_name: null
        }
    }
}
</script>

<style scoped>

</style>

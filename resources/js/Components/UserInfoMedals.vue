<template>
    <div class="d-inline ms-1">
        <hash-icon v-if="userHasRole('super-admin',user)"
           class="text-danger"
           v-b-tooltip.bottom="'Sistem Yöneticisi'"/>

        <shield-icon v-if="userHasRole('admin',user)"
             class="text-primary"
             v-b-tooltip.bottom="'Yetkili'"/>

        <checkbox-icon v-if="user.email_verified_at"
               v-b-tooltip.bottom="'E-Posta Onaylı'"
                       class="text-primary"/>
        <user-check-icon v-if="user.tc_verified_at"
             v-b-tooltip.bottom="'T.C. Onaylı'"
             class="text-primary"/>
            <user-exclamation-icon v-else
               v-b-tooltip.bottom="'T.C. Onaysız!'"
               class="text-warning"/>

        <hand-stop-icon v-if="user.deleted_at"
            v-b-tooltip.bottom="'Hesap Engelli'"
            class="text-red"
        />
    </div>
</template>

<script>
export default {
    name: "UserInfoMedals",
    props:{
        user:{
            type : Object,
            required : true
        }
    }
}
</script>

<style scoped>

</style>

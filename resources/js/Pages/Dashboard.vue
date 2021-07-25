<template>
    <AppLayout>
        <div class="row row-cards">
            <h3>Tüm Kullanıcılar</h3>
            <div class="col-md-3 col-lg-2" v-for="user in page_users">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <Avatar :src="user.profile_photo_url" class="avatar-xl mb-3 border-5 border-bottom"
                                :class="[user.is_online?'border-success':'border-danger']">
<!--                            <span class="badge small" :class="[user.is_online?'bg-success':'bg-red']"></span>-->
                        </Avatar>
                        <h3 class="m-0" :class="userHasRole('admin',user)?'text-azure':''"><a href="#">{{ user.full_name }}</a></h3>
                        <div class="text-muted">{{ user.email }}</div>
                        <div class="mt-3">
                            <span class="badge bg-azure-lt" v-if="userHasRole('admin',user)">Yetkili</span>
                            <span class="badge bg-red-lt" v-else-if="userHasRole('super-admin',user)">Sistem Yöneticisi</span>
                            <span class="badge bg-dark-lt" v-else>Kullanıcı</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import Avatar from "../Components/Avatar";
export default {
    metaInfo:{title:'Ana Sayfa'},
    name: "Dashboard",
    components: {Avatar, AppLayout},
    props:{
        page_users:Object
    },
    mounted(){
    }
}
</script>

<style scoped>

</style>

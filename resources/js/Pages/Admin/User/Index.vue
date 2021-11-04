<template>
    <AppLayout>
        <PageHeader>
            <div class="col">
                <h3 class="page-title">Kullanıcılar</h3>
            </div>
            <div class="col-auto ms-auto">
                <Link :href="route('admin.user.create')" class="btn btn-primary"><plus-icon/> Yeni Kullanıcı</Link>
            </div>
        </PageHeader>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="table-responsive mb-0">
                        <table class="table table-vcenter table-nowrap table-hover">
                            <thead>
                            <tr>
                                <th class="text-muted font-italic w-1">#ID</th>
                                <th>Ad Soyad</th>
                                <th>E-Posta</th>
                                <th>Yetki</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in page_users.data" class="cursor-pointer" @click="$inertia.get(route('admin.user.show',user))">
                                <td class="text-muted font-italic">#{{user.id}}</td>
                                <td class="">
                                    <Avatar class="avatar-sm" :src="user.profile_photo_url"></Avatar>
                                    {{user.full_name}}
                                </td>
                                <td class="text-muted" >{{user.email}}</td>
                                <td class="text-muted" >
                                    <span class="badge bg-azure-lt" v-if="userHasRole('admin',user)">Yetkili</span>
                                    <span class="badge bg-red-lt" v-else-if="userHasRole('super-admin',user)">Sistem Yöneticisi</span>
                                    <span class="badge bg-dark-lt" v-else>Kullanıcı</span>
                                </td>
                                <td>
                                    <Link :href="route('admin.user.show',user)" class=""><pencil-icon/> Düzenle</Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "../../../Layouts/AppLayout";
import PageHeader from "../../../Components/PageHeader";
import UserInfo from "../../../Components/UserInfo";
import Avatar from "../../../Components/Avatar";
import {Link} from "@inertiajs/inertia-vue";
export default {
    metaInfo:{
        title : 'Kullanıcılar'
    },
    components: {Avatar, UserInfo, PageHeader, AppLayout, Link},
    props:{
        page_users:Object
    }
}
</script>

<style scoped>

</style>

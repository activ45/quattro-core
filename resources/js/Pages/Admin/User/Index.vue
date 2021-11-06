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
        <div class="row mb-3">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="search" method="post">
                            <label for="userara" class="form-label">Kullanıcı Ara</label>
                            <div class="input-group input-group-flat">
                                <input type="text" v-model="searchText" id="userara" class="form-control" autocomplete="off">
                                <span class="input-group-text" v-if="searchText">
                                  <a href="#" @click.prevent="searchText=null;search()" class="input-group-link text-danger">Temizle</a>
                                </span>
                                <button class="btn" type="submit">Ara</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="table-responsive mb-0">
                        <table class="table table-vcenter table-nowrap table-hover">
                            <thead>
                            <tr>
                                <th class="text-muted font-italic w-1">#ID</th>
                                <th>Kullanıcı</th>
                                <th>E-Posta</th>
                                <th>Yetki</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in page_users.data" class="cursor-pointer" @click="$inertia.get(route('admin.user.show',user))">
                                <td class="text-muted font-italic">#{{user.id}}</td>
                                <td class="">
                                    <UserInfo avatar :link="false" :user="user"></UserInfo>
                                </td>
                                <td class="text-muted" >{{user.email}}</td>
                                <td class="text-muted" >
                                    <span class="badge bg-azure-lt" v-if="userHasRole('admin',user)">Yetkili</span>
                                    <span class="badge bg-red-lt" v-else-if="userHasRole('super-admin',user)">Sistem Yöneticisi</span>
                                    <span class="badge bg-dark-lt" v-else>Kullanıcı</span>
                                </td>
                                <td>
                                    <Link :href="route('admin.user.show',user)" class="btn btn-link"><chevron-right-icon/> Düzenle</Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer" v-if="page_users.links.length > 3">
                        <Pagination :links="page_users.links"></Pagination>
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
import Pagination from "../../../Components/Pagination";
export default {
    metaInfo:{
        title : 'Kullanıcılar'
    },
    components: {Pagination, Avatar, UserInfo, PageHeader, AppLayout, Link},
    props:{
        page_users:Object
    },
    data(){
        return {
            searchText:this.route().params.q
        }
    },
    mounted(){
    },
    methods:{
        search(){
            if( this.searchText != null){
                this.$inertia.reload({
                    data:{
                        'q':this.searchText
                    }
                })
            }else{
                this.$inertia.reload({
                    data:{
                        'q':undefined
                    }
                })
            }
        }
    }
}
</script>

<style scoped>

</style>

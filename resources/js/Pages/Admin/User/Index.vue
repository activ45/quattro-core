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
        <div class="row mb-2">
            <div class="col-xl-4 col-lg-6">
                <div class="row g-2">
                    <div class="col">
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" @keypress.enter="search" v-model="searchText" autocomplete="off" placeholder="Kullanıcılarda ara…">
                                <span class="input-group-text" v-if="searchText">
                                  <a href="#" @click.prevent="searchText=null;search()" class="input-group-link bg-white text-danger">Temizle</a>
                                </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="btn btn-white btn-icon" @click.prevent="search" aria-label="Button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-auto  mt-2">
                <div class="nav-item dropdown d-inline-block">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                        <button type="button" v-if="route().params.hasOwnProperty('tcverified') && route().params.tcverified > 0"
                                class="btn dropdown-toggle btn-link text-decoration-none p-1 text-info dropdown-toggle-no-caret"
                        >T.C. Onaylılar</button>
                        <button type="button" v-else-if="route().params.hasOwnProperty('tcverified') && route().params.tcverified == 0"
                                class="btn dropdown-toggle btn-link text-decoration-none p-1 text-danger dropdown-toggle-no-caret"
                        >T.C. Onaysızlar</button>
                        <button type="button" v-else
                                class="btn dropdown-toggle btn-link text-decoration-none p-1  dropdown-toggle-no-caret"
                        >Filtrele</button>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <Link :href="route('admin.user.index',{tcverified: 1})"
                              class="dropdown-item text-primary"><user-check-icon class="dropdown-item-icon text-primary" /> T.C. Onaylılar</Link>
                        <Link :href="route('admin.user.index',{tcverified: 0})"
                              class="dropdown-item text-danger"><user-x-icon class="dropdown-item-icon text-danger"/> T.C. Onaysızlar</Link>
                    </div>
                </div>
                <Link :href="route(route().current())"
                      v-b-tooltip="'Filtreyi temizle'"
                      v-if="route().params.hasOwnProperty('tcverified')"
                      class="text-danger p-1 rounded-end"><x-icon class="align-middle"/></Link>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="table-responsive mb-0">
                        <table class="table table-vcenter table-nowrap">
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
                            <tr v-for="user in page_users.data">
                                <td class="text-muted font-italic"
                                ><span>#{{ user.id }}</span></td>
                                <td class="p-1 d-flex">
                                    <UserInfo avatar medals :user="user"></UserInfo>
<!--                                    <small v-if="!user.status" class=" badge bg-danger mt-auto ms-2 mb-auto">Hesap engelli</small>-->
                                </td>
                                <td class="text-muted" >{{user.email}}</td>
                                <td class="text-muted" >
                                    <BadgeUserRole :user="user" />
                                </td>
                                <td>
                                    <Link :href="route('admin.user.edit',user)"
                                          class="btn btn-light"><ChevronRightIcon/> Düzenle</Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer" v-if="page_users.links.length > 3">
                        <Pagination :links="page_users.links"></Pagination>
                    </div>
                </div>

                <div class="row">
                    <div class="col pt-2">
                <span class="text-muted ps-2" v-show="page_users.total>0"><span >{{ page_users.from }} - {{ page_users.to }} arası kullanıcı gösteriliyor.</span>
                    Toplam {{page_users.total}} kullanıcı mevcut.</span>
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
import Alert from "../../../Components/Alert";
import BadgeUserRole from "../../../Components/BadgeUserRole";
export default {
    name:'UserIndex',
    metaInfo:{
        title : 'Kullanıcılar'
    },
    components: {BadgeUserRole, Pagination, Avatar, UserInfo, PageHeader, AppLayout, Link , Alert},
    props:{
        page_users:Object
    },
    data(){
        return {
            searchText:route().params['q']
        }
    },
    methods:{
        search(clear=false){
            let page = undefined
            if( this.route().params.page > 0 ){
                let page = this.route().params.page
            }

            if( this.searchText != null && this.searchText.length > 0){
                this.$inertia.reload({
                    data:{
                        page,
                        q:this.searchText
                    }
                })
            }else{
                this.$inertia.reload({
                    data:{
                        page,
                        q:undefined
                    }
                })
            }
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <AppLayout>
        <PageHeader>
            <div class="col">
                <h3 class="page-title">Quattro Bildirim Paneli</h3>
            </div>
        </PageHeader>
        <div class="row" v-if="tc_verified_users > 0 && userHasPermission('user.show')">
            <Alert type="danger" icon class="alert-important"><strong>{{tc_verified_users}}</strong> adet T.C. Kimlik numarası onaylanmamış kullanıcı mevcut.
                — <Link :href="route('admin.user.index',{'tcverified':0})" class="alert-link">Görüntüle</Link>!
            </Alert>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import Avatar from "vue-avatar";
import PageHeader from "../Components/PageHeader";
import UserInfo from "@/Components/UserInfo";
import BadgeTicketStatus from "@/Components/BadgeTicketStatus";
import {Link} from "@inertiajs/inertia-vue";
import Alert from "@/Components/Alert"

export default {
    metaInfo:{title:'Ana Sayfa'},
    name: "Dashboard",
    components: {BadgeTicketStatus, UserInfo, PageHeader, Avatar, AppLayout, Link, Alert},
    props:{
        tc_verified_users:Number,
    },
    data(){
        return {
        }
    },
    mounted(){
    }
}
</script>

<style scoped>

</style>

<template>
    <AppLayout>
        <div class="row justify-content-center" v-if="!$page.props.user.email_verified_at">
            <div class="col">
                <Alert type="warning" icon>Hesabınızın onaylanması gerekli. Lütfen E-Postanızı kontrol ediniz. — <Link :href="route('verification.send')"
                                                                                                                       method="post"
                                                                                                                       class="alert-link">Yeniden gönder</Link>.</Alert>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-3 col-3">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a aria-current="page" class="nav-link active" data-bs-toggle="tab" href="#tabs-profile"><user-icon class="me-2"></user-icon> Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabs-security"><shield-icon class="me-2"/> Güvenlik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabs-settings"><adjustments-icon class="me-2"/> Tercihler</a>
                    </li>
                </ul>
            </div>

            <div class="col">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-profile">
                        <TabProfile :user="page_user" :process_name="process_name"/>
                    </div>
                    <div class="tab-pane" id="tabs-security">
                        <TabSecurity :sessions="page_sessions"/>
                    </div>
                    <div class="tab-pane" id="tabs-settings">
                        <TabSettings/>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import FilledCircleCheckIcon from "../../Components/Icons/FilledCircleCheckIcon";
import {Link} from "@inertiajs/inertia-vue";
import Avatar from "vue-avatar";
import TabProfile from "./Components/TabProfile";
import TabSecurity from "./Components/TabSecurity";
import TabSettings from "./Components/TabSettings";
import Alert from '@/Components/Alert'

export default {
name: "Profile",
    metaInfo:{title:'Hesabım'},
    props:{
        page_sessions:Array,
        errors:Object,
        page_user:Object
    },
    data(){
    return {
        process_name:null,
    }
    },
    components: {TabSettings, TabSecurity, TabProfile, FilledCircleCheckIcon, AppLayout, Link, Avatar,Alert},
    methods:{
    }
}
</script>

<template>
    <AppLayout>
        <PageHeader :back-url="back_url == route(route().current(),route().params) ? route('admin.user.index') : back_url">
            <div class="col">
                <h3 class="page-title"><UserIcon/> – Kullanıcı Düzenle</h3>
                <div class="page-subtitle"><span class="text-muted">#{{ page_user.id }}</span> - <strong>{{ page_user.full_name }} —
                    <BadgeUserRole :user="page_user"/>
                </strong> — {{page_user.email}}</div>
            </div>
        </PageHeader>
        <div class="row" v-if="!page_user.tc_verified_at">
            <div class="col">
                <Alert type="danger" class="alert-important" icon>Kullanıcı T.C. Kimlik numarası onaylı <strong>değil</strong> !</Alert>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-3 col-3">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a aria-current="page" class="nav-link active" data-bs-toggle="tab"
                           href="#tabs-profile"
                        ><user-icon class="me-2"></user-icon> Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab"
                           href="#tabs-authorization"
                        ><shield-icon class="me-2"/> Yetkilendirme</a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-profile">
                        <TabUserEdit :user="page_user"></TabUserEdit>
                    </div>
                    <div class="tab-pane" id="tabs-authorization">
                        <TabUserAuthorization :user="page_user"></TabUserAuthorization>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "../../../Layouts/AppLayout";
import PageHeader from "../../../Components/PageHeader";
import TablerSwitch from "../../../Components/TablerSwitch";
import Alert from "../../../Components/Alert";
import TextareaAutosize from "vue-textarea-autosize"
import Avatar from "vue-avatar";
import BadgeUserRole from "../../../Components/BadgeUserRole";
import TabUserEdit from "@/Pages/Admin/User/Components/TabUserEdit";
import TabUserAuthorization from "@/Pages/Admin/User/Components/TabUserAuthorization";

export default {
    metaInfo:{
        title : 'Kullanıcı Düzenle'
    },
    name: "AdminUserEdit",
    components: {
        TabUserAuthorization,
        TabUserEdit, BadgeUserRole, Alert, TablerSwitch, PageHeader, AppLayout, TextareaAutosize, Avatar},
    props:{
        page_user:Object,
        page_permissions:Array,
        page_roles:Array,
        page_departments:Array
    },
    data(){
        return {
                back_url:null,
                process_name:null,
        }
    },
    mounted() {
        this.back_url = this.$page.props.app.back_url;
        this.$inertia.on('finish',()=>this.process_name = null)
    },
    methods:{
        submitDepartmentUpdate(){
            this.process_name = "department_update"
            this.$inertia.put(route('admin.user.update_department',this.page_user),{departments:this.form_departments},{
                preserveScroll : true,
                onFinish:()=>{
                    this.form_departments = this.$page.props.page_user.departments.map(dep=>dep.id)
                }
            })
        },
        submitPermissionUpdate(){
            this.process_name = "permission_update"
            this.$inertia.put(route('admin.user.update_permission',this.page_user),{permissions:this.form_permissions},{
                preserveScroll : true,
                onFinish:()=>{
                    this.form_permissions = this.$page.props.page_user.permissions_all.map(per=>per.name)
                }
            })
        },
        submitRoleUpdate(){
            this.process_name = "role_update"
            this.$inertia.put(route('admin.user.update_role',this.page_user),{role:this.form_role},{
                preserveScroll : true,
                onFinish:()=>{
                    this.form_role = this.$page.props.page_user.roles[0].name
                    this.form_permissions = this.$page.props.page_user.permissions_all.map(per=>per.name)
                }
            })
        },


    }
}
</script>

<style scoped>

</style>

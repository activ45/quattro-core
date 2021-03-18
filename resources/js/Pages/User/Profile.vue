<template>
    <AppLayout>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <form @submit.prevent="submitProfileUpdate" class="card">
                    <div class="card-header">
                        <div class="card-title"><user-icon/> Hesap Bilgisi</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Ad</label>
                            <input type="text" v-model="form_user.first_name"
                                   :class="errors.updateProfileInformation && errors.updateProfileInformation.first_name?'is-invalid':''"
                                   class="form-control"/>
                            <div v-if="errors.updateProfileInformation" class="invalid-feedback">
                                {{errors.updateProfileInformation.first_name}}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Soyad</label>
                            <input type="text" v-model="form_user.last_name"
                                   :class="errors.updateProfileInformation &&
                                   errors.updateProfileInformation.last_name?'is-invalid':''"
                                   class="form-control"/>
                            <div v-if="errors.updateProfileInformation" class="invalid-feedback">
                                {{errors.updateProfileInformation.last_name}}</div>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-Posta</label>
                            <input type="text" v-model="form_user.email" readonly
                                   class="form-control"/>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary" :class="form_user_process?'disabled':''">
                            <span v-if="form_user_process" class="spinner-border border-2 spinner-border-sm me-2" role="status"></span>
                            <FilledCircleCheckIcon v-else/>
                            Güncelle</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <form @submit.prevent="submitPasswordUpdate" class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <lock-icon/> Şifre Değiştir
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Mevcut şifre</label>
                            <input type="password" class="form-control"
                                   :class="errors.updatePassword && errors.updatePassword.current_password?'is-invalid':''"
                                   v-model="form_password.current_password">
                            <div v-if="errors.updatePassword" class="invalid-feedback">
                                {{errors.updatePassword.current_password}}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yeni şifre</label>
                            <input type="password" class="form-control"
                                   :class="errors.updatePassword && errors.updatePassword.password?'is-invalid':''"
                                   v-model="form_password.password">
                            <div v-if="errors.updatePassword" class="invalid-feedback">
                                {{errors.updatePassword.password}}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yeni şifre tekrar</label>
                            <input type="password" class="form-control"
                                   :class="errors.updatePassword && errors.updatePassword.password_confirmation?'is-invalid':''"
                                   v-model="form_password.password_confirmation">
                            <div v-if="errors.updatePassword" class="invalid-feedback">
                                {{errors.updatePassword.password_confirmation}}</div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary" :class="form_password_process?'disabled':''">
                            <span v-if="form_password_process" class="spinner-border border-2 spinner-border-sm me-2" role="status"></span>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="icon" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26 26" fill="#FFFFFF">
                                <path d="M13 1C6.371094 1 1 6.371094 1 13C1 19.628906 6.371094 25 13 25C19.628906 25 25 19.628906 25 13C25 6.371094 19.628906 1 13 1 Z M 13 6C15.394531 6 17 7.605469 17 10L15.75 10C15.75 8.480469 14.519531 7.25 13 7.25C11.480469 7.25 10.25 8.480469 10.25 10L9 10C9 7.605469 10.605469 6 13 6 Z M 9.5 11L16.5 11C17.328125 11 18 11.671875 18 12.5L18 17.5C18 18.328125 17.328125 19 16.5 19L9.5 19C8.671875 19 8 18.328125 8 17.5L8 12.5C8 11.671875 8.671875 11 9.5 11 Z M 13 12.9375C12.335938 12.9375 11.8125 13.457031 11.8125 14.09375C11.8125 14.519531 12.046875 14.894531 12.40625 15.09375L12.40625 16.40625C12.40625 16.726563 12.667969 17 13 17C13.332031 17 13.59375 16.753906 13.59375 16.4375L13.59375 15.09375C13.953125 14.894531 14.21875 14.550781 14.21875 14.125C14.21875 13.484375 13.664063 12.9375 13 12.9375Z" fill="#FFFFFF" />
                            </svg>
                            Güncelle</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <form @submit.prevent="submitSettingsUpdate" class="card">
                    <div  class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Anlık bildirim <span class="strong text-primary">
                                <arrows-vertical-icon/>
                            </span> dikey konumu</label>
                            <div class="form-selectgroup">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="yposition" v-model="form_settings.notyf_yposition" value="top" class="form-selectgroup-input" checked="">
                                    <span class="form-selectgroup-label">
                                        <strong> top</strong> <arrow-bar-to-up-icon/> Ekranın üst kısmında.</span>
                                </label>
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="yposition" v-model="form_settings.notyf_yposition" value="bottom" class="form-selectgroup-input" checked="">
                                    <span class="form-selectgroup-label">
                                        <strong> bottom</strong> <arrow-bar-to-down-icon/> Ekranın alt kısmında.</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Anlık bildirim <span class="strong text-primary">
                                <arrows-horizontal-icon/>
                            </span> yatay konumu</label>
                            <div class="form-selectgroup">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="xposition" v-model="form_settings.notyf_xposition" value="left" class="form-selectgroup-input" checked="">
                                    <span class="form-selectgroup-label">
                                        <strong> left</strong> <arrow-bar-to-left-icon/> Ekranın sol tarafında.</span>
                                </label>
                                <label class="form-selectgroup-item ms-auto me-auto">
                                    <input type="radio" name="xposition" v-model="form_settings.notyf_xposition" value="center" class="form-selectgroup-input" checked="">
                                    <span class="form-selectgroup-label">
                                        <strong> center</strong> <dots-icon/> Ekranın ortasında.</span>
                                </label>
                                <label class="form-selectgroup-item ms-1 ms-lg-auto">
                                    <input type="radio" name="xposition" v-model="form_settings.notyf_xposition" value="right" class="form-selectgroup-input" checked="">
                                    <span class="form-selectgroup-label">
                                        <strong> right</strong> <arrow-bar-to-right-icon/> Ekranın sağ tarafında.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary" :class="form_settings_process?'disabled':''">
                            <span v-if="form_settings_process" class="spinner-border border-2 spinner-border-sm me-2" role="status"></span>
                            <FilledCircleCheckIcon v-else/>
                            Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import FilledCircleCheckIcon from "../../Components/Icons/FilledCircleCheckIcon";
export default {
name: "Profile",
    props:{
        page_sessions:Array,
        errors:Object
    },
    data(){
    return {
        form_user_process:false,
        form_password_process:false,
        form_settings_process:false,

        form_settings:{
            notyf_yposition:this.$page.props.user.settings.notyf_yposition,
            notyf_xposition:this.$page.props.user.settings.notyf_xposition,
        },
        form_user:{...this.$page.props.user},
        form_password:{
            current_password:null,
            password:null,
            password_confirmation:null,
        }
    }
    },
    components: {FilledCircleCheckIcon, AppLayout},

    methods:{
        submitSettingsUpdate(){
            this.$inertia.put(route('user-settings.update'),this.form_settings,{
                errorBag:'updateUserSettings',
                onStart:()=>this.form_settings_process=true,
                onFinish:() => this.form_settings_process=false,
                onSuccess: (respon) => {
                    this.$notyf.success('Hesap ayarları güncellendi')
                },
                onError: ()=>{
                    this.$notyf.error('Bir hata oluştu.')
                }
            })
        },
        submitProfileUpdate(){
            this.$inertia.put(route('user-profile-information.update'),this.form_user,{
                errorBag:'updateProfileInformation',
                onStart:()=>this.form_user_process=true,
                onFinish:() => this.form_user_process=false,
                onSuccess: (respon) => {
                    this.form_user = {...this.$page.props.user}
                    this.$notyf.success('Hesap bilgileri güncellendi')
                },
                onError: ()=>{
                    this.$notyf.error('Bir hata oluştu.')
                }
            })
        },
        submitPasswordUpdate(){
            this.$inertia.put(route('user-password.update'),this.form_password,{
                errorBag:'updatePassword',
                onStart:()=>this.form_password_process=true,
                onFinish:() => this.form_password_process=false,
                onSuccess: (respon) => {
                    this.form_password.current_password=null;
                    this.form_password.password=null;
                    this.form_password.password_confirmation=null;
                    this.$notyf.success('Hesap şifresi güncellendi')
                },
                onError: ()=>{
                    this.$notyf.error('Bir hata oluştu.')
                }
            })
        },
    }
}
</script>

<style scoped>

</style>

<template>
    <AuthLayout>
        <div class="text-center mb-4">
            <a href=""><img :src="asset('static/logo.svg')" height="36" alt=""></a>
        </div>
        <form class="card card-md animate__animated animate__fadeInRight animate__faster" @submit.prevent="submit" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Şifre hatırlatma</h2>
                <div class="mb-3">
                    <label class="form-label">E-Posta</label>
                    <input type="email" class="form-control" v-model="form.email"
                           placeholder="E-Posta adresiniz">
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100"><check-icon/> Gönder</button>
                </div>
            </div>

        </form>
        <div class="text-center text-muted mt-3">
            Giriş sayfasına <inertia-link :href="route('login')"  tabindex="-1" class=""><arrow-back-icon/> Dön</inertia-link>
        </div>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/AuthLayout";
export default {
    name: "ForgotPassword",
    components: {AuthLayout},
    data(){
        return {
            form:{
                email:null,
            }
        }
    },
    methods:{
        submit(){

        }
    }
}
</script>

<style scoped>

</style>

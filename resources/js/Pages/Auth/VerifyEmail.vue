<template>
    <AuthLayout>
        <div class="text-center mb-4">
            <a href=""><img :src="asset('static/logo.svg')" height="36" alt=""></a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h3 class="card-title">Doğrulama gerekli</h3>
                <div class="markdown">
                    Hesabınızı doğrulamanız için e-posta adresinize bir link gönderildi.
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/AuthLayout";
export default {
    metaInfo:{
      title:'Hesabını Doğrula'
    },
    name: "VerifyEmail",
    components: {AuthLayout}
}
</script>

<style scoped>

</style>

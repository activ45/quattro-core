<template>
    <div class="wrapper">
        <TopNavbar></TopNavbar>
<!--        <Navbar></Navbar>-->
        <div class="page-wrapper">
            <div class="container-xl pt-3" style="min-height: 350px">
                <div class="row">
                    <Alert v-if="!this.$page.props.user.tc_verified_at" type="warning" icon="">TC Kimlik bilgilerinizi doğrulamanız gerekmektedir!  — <Link
                        :href="route('profile.edit')" class="alert-link">doğrula!</Link></Alert>
                </div>
                <slot/>
            </div>
            <Footer></Footer>
        </div>
        <FlashMessage :notifications="this.$page.props.flash"/>
    </div>
</template>

<script>

import FlashMessage from "../Components/FlashMessage";
import Footer from "./_Footer";
import Navbar from "./_Navbar";
import TopNavbar from "./_TopNavbar";
import Alert from "@/Components/Alert"
import {Link} from "@inertiajs/inertia-vue";

export default {
    name: "AppLayout",
    components: {TopNavbar, Navbar, Footer, FlashMessage, Alert, Link},
    mounted() {
        window.addEventListener('focus',function(){
            // setTimeout(function(){ window.location.reload(); }, 700);
        })
    }
}
</script>

<style scoped>

</style>

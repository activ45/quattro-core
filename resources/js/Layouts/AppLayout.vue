<template>
    <div class="wrapper">
        <TopNavbar></TopNavbar>
        <Navbar></Navbar>
        <div class="page-wrapper">
            <div class="container-xl pt-3" style="min-height: 350px">
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
export default {
    name: "AppLayout",
    components: {TopNavbar, Navbar, Footer, FlashMessage},
    mounted() {
        window.addEventListener('focus',function(){
            // setTimeout(function(){ window.location.reload(); }, 700);
        })
    }
}
</script>

<style scoped>

</style>

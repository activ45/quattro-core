<template>
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <inertia-link class="nav-link" :href="route('dashboard')">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <smart-home-icon/>
                                </span>
                                    <span class="nav-link-title">
                                  Ana Sayfa
                                </span>
                                </inertia-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    name: "Navbar"
}
</script>

<style scoped>

</style>

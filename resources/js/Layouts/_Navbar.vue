<template>
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <nav-bar-link tag="dashboard" active="dashboard">
                                 <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <smart-home-icon/>
                                </span>
                                <span class="nav-link-title">
                                  Ana Sayfa
                                </span>
                            </nav-bar-link>
                            <nav-bar-link tag="admin.user.index"
                                          v-if="userHasPermission('user.show')"
                                          active="admin.user.">
                                 <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <users-icon></users-icon>
                                </span>
                                <span class="nav-link-title">
                                  Kullanıcılar
                                </span>
                            </nav-bar-link>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import NavBarLink from "../Components/NavBarLink";
export default {
    name: "Navbar",
    components: {NavBarLink}
}
</script>

<style scoped>

</style>

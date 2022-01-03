<template>
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a :href="route('index')">
                    <img :src="asset('static/logo.svg')" width="110" height="32" alt="Tabler"
                         class="navbar-brand-image">
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                       aria-label="Show notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path
                                d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"/>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"/>
                        </svg>
                        <span class="badge bg-red"
                              v-show="$page.props.user.unread_notifications.length">{{ $page.props.user.unread_notifications.length }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-card" style="min-width: 18rem">
                        <div class="card d-flex flex-column">
                            <div class="card-body p-1 pt-0 d-flex flex-column">
                                <div class="p-1 mb-1 border-bottom">
                                    <Link class="btn btn-link"
                                          :class="{'disabled':!$page.props.user.notifications.length}"
                                          :href="route('notifications.markread',0)">Hepsini Oku</Link>
                                    <Link class="btn btn-link text-danger float-end"
                                          :class="{'disabled text-muted':!$page.props.user.notifications.length}"
                                          :href="route('notifications.markread',-1)">Temizle</Link>
                                </div>
                                <div v-for="notification in $page.props.user.notifications" v-bind:key="notification.id">
                                    <Link class="dropdown-item mb-1"
                                          :title="notification.created_at|momentH"
                                                  :class="notification.read_at===null?'bg-lime-lt  animate__animated animate__jackInTheBox animate__faster':''"
                                                  :href="route('notifications.markread',notification.id)" >
                                        <span class="w-100">
                                            <span class="">{{ notification.data.title }}</span>
                                            <small class="text-muted float-end pl-1"> {{
                                                    notification.created_at | momentFromNow
                                                }}</small>
                                            <br>
                                            <small class="text-muted " v-html="notification.data['message']"></small>
                                        </span>
                                    </Link>
                                </div>
                                <div v-if="!$page.props.user.notifications.length" class="p-2 text-center">
                                    <span class="text-muted">
                                      <info-circle-icon></info-circle-icon>
                                        Henüz bildirim yok.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 p-0" data-bs-toggle="dropdown"
                       :class="userHasRole('admin')?'text-primary':userHasRole('super-admin')?'text-danger':'text-reset'"
                       aria-label="Open user menu">
                            <avatar class="avatar avatar-sm"
                                    background-color="#f0f2f6"
                                    color="#656d77"
                                    :username="$page.props.user.full_name"
                            :src="$page.props.user.profile_photo_url"></avatar>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ $page.props.user.full_name }}</div>
                            <div class="mt-1 small text-muted">{{ $page.props.user.email }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <Link :href="route('profile.edit')" class="dropdown-item">
                            <user-icon class="dropdown-item-icon"/>
                            Hesabım
                        </Link>
                        <Link :href="route('profile.edit')" v-if="userHasRole('super-admin')" class="dropdown-item">
                            <settings-icon class="dropdown-item-icon"/>
                            Sistem Ayarları
                        </Link>
                        <div class="dropdown-divider"></div>
                        <Link :href="route('logout')" method="post" as="button" class="dropdown-item">
                            <logout-icon class="dropdown-item-icon"/>
                            Çıkış
                        </Link>
                    </div>
                </div>
            </div>
            <Navbar/>
        </div>
    </header>
</template>

<script>
import NavBarLink from "../Components/NavBarLink";
import {Link} from "@inertiajs/inertia-vue";
import Avatar from "vue-avatar";
import Navbar from "./_Navbar";
export default {
    name: "TopNavbar",
    components: {Navbar, NavBarLink, Link, Avatar}
}
</script>

<style scoped>

</style>

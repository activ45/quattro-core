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
                            <div class="card-body p-1 d-flex flex-column">
                                <a class="dropdown-item mb-1"
                                   :class="notification.read_at===null?'bg-lime-lt  animate__animated animate__jackInTheBox animate__faster':''"
                                   :href="route('notifications.markread',notification.id)"
                                   v-for="notification in $page.props.user.notifications">
                                        <span class="w-100">
                                            <span class="">{{ notification.data.title }}</span>
                                            <small class="text-muted float-end pl-1"> {{
                                                    notification.created_at|moment
                                                }}</small>
                                            <br>
                                            <small class="text-muted " v-html="notification.data['message']"></small>
                                        </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                            <span class="avatar avatar-sm"
                                  :style="'background-image: url('+$page.props.user.profile_photo_url+')'"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ $page.props.user.full_name }}</div>
                            <div class="mt-1 small text-muted">{{ $page.props.user.email }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <inertia-link :href="route('profile.edit')" class="dropdown-item">
                            <user-icon class="dropdown-item-icon"/>
                            Hesabım
                        </inertia-link>
                        <div class="dropdown-divider"></div>
                        <inertia-link :href="route('logout')" method="post" as="button" class="dropdown-item">
                            <logout-icon class="dropdown-item-icon"/>
                            Çıkış
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "TopNavbar"
}
</script>

<style scoped>

</style>

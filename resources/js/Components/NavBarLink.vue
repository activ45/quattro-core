<template>
    <li class="nav-item" :class="{'active':$page.props.app.current_route.indexOf(active)!==-1}">
        <inertia-link class="nav-link" :href="href?href:route(tag)">
            <slot/>
        </inertia-link>
    </li>
</template>

<script>
export default {
name: "NavBarLink",
    props:{
        active:String,
        tag:String,
        href:String
    }
}
</script>

<style scoped>

</style>

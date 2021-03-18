<template>
    <ul class="pagination m-0 ml-auto">
        <li v-for="(link, key) in links" class="page-item" :class="{'active': link.active,'disabled':link.url === null}">
            <div v-if="link.url === null" class="page-link"  :key="key">
                <svg v-if="link.label === 'Önceki'" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><polyline points="15 6 9 12 15 18"></polyline></svg>
                {{ link.label }}
                <svg v-if="link.label === 'Sonraki'" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><polyline points="9 6 15 12 9 18"></polyline></svg>

            </div>
            <inertia-link v-else :key="key" class="page-link"  :href="link.url">
                <svg v-if="link.label === 'Önceki'" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><polyline points="15 6 9 12 15 18"></polyline></svg>
                {{ link.label }}
                <svg v-if="link.label === 'Sonraki'" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><polyline points="9 6 15 12 9 18"></polyline></svg>

            </inertia-link>
        </li>
    </ul>
</template>

<script>
export default {
  props: {
    links: Array,
  },
}
</script>

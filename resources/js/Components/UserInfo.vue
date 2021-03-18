<template>
    <div class="d-flex align-items-center" v-if="user">
        <span class="avatar me-2" v-if="avatar">
            {{user.short_name}}
            <span class="badge" :class="[user.is_online?'bg-success':'bg-red']"></span>
        </span>
        <div class="flex-fill">
            <template v-if="$page.props.user.permissions_all.some(p=>p.name === 'user.show')">
                <inertia-link v-if="user.id !== $page.props.user.id"
                              :href="route('admin.user.show',user.id)"
                              class="text-body d-block text-truncate">{{ user.full_name}}</inertia-link>
                <inertia-link v-else :href="route('profile')"
                              class="text-body d-block text-truncate">{{ user.full_name}} <small class="text-muted">(Siz)</small></inertia-link>
            </template>
            <template v-else>
                <div class="font-weight-medium">{{user.full_name}}</div>
            </template>

            <div class="text-muted small">
                <span v-if="$page.props.user.permissions_all.some(p=>p.name === 'user.show')">#{{ user.id }}  - </span>{{user.email}} {{user.phone?' - '+user.phone:''}}</div>
        </div>
    </div>
    <div v-else class="d-flex align-items-center">
        <span v-if="nulltext !== null">
            <slot name="null-body">
                {{nulltext}}
            </slot>
        </span>
    </div>
</template>

<script>
export default {
    name: "UserInfo",
    props:{
        user:Object,
        avatar: {
            type: Boolean,
            default: false
        },
        nulltext: {
            type: String,
            default: '-'
        },
    },
    computed:{
      getAvatarShow(){
          if( this.avatar === 'false' )
              return false;
          else
            return this.avatar;
      }
    }
}
</script>

<style scoped>

</style>

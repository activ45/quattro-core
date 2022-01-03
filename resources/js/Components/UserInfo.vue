<template>
    <div class="d-flex align-items-center" v-if="user">
        <avatar class="me-2" v-if="avatar || avatarSm"
                background-color="#f0f2f6"
                color="#656d77"
                :rounded="!avatarSquare"
                :size="avatarSm?32:undefined"

                :class="{'avatar-sm':avatarSm,'rounded-2':avatarSquare}"
                :username="user.full_name" :src="user.profile_photo_url">
        </avatar>
        <div class="flex-fill">
            <template v-if="userHasPermission('user.show') && link">
                <Link :class="{
                            // 'text-red':userHasRole('super-admin',user),
                            // 'text-azure':userHasRole('admin',user),
                            'text-decoration-line-through text-muted':user.deleted_at,
                            'text-body':!user.deleted_at
                        }"
                            v-b-tooltip.bottom="user.deleted_at?'Hesap Engelli':undefined"
                            :href="user.id !== $page.props.user.id ? route('admin.user.edit',user.id) : route('profile.edit')"
                            class="text-truncate">
                    <span class="badge" v-show="user.is_online"
                          :class="[user.is_online?'bg-success':'bg-red']"></span> <span class="me-1">{{ user.full_name }}</span>
                </Link>
                <UserInfoMedals v-if="medals" :user="user"></UserInfoMedals>
            </template>
            <template v-else>
                <span class="text-body d-block text-truncate"
                      :class="{
                                    // 'text-red':userHasRole('super-admin',user),
                                    // 'text-azure':userHasRole('admin',user)
                                }"
                    ><span class="badge" v-show="user.is_online" :class="[user.is_online?'bg-success':'bg-red']"></span> <span class="me-1">{{ user.full_name }}</span>

                    <UserInfoMadals :user="user"></UserInfoMadals>
                </span>
            </template>
            <div class="text-muted small" v-if="!noEmail">
                <span v-if="$page.props.user.permissions_all.some(p=>p.name === 'user.show')">#{{ user.id }}  - </span>{{user.email}} {{user.phone?' - '+user.phone:''}}
            </div>
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
import Avatar from "vue-avatar";
import {Link} from "@inertiajs/inertia-vue";
import UserInfoMedals from "@/Components/UserInfoMedals";
export default {
    name: "UserInfo",
    components: {UserInfoMedals, Avatar, Link},
    props:{
        user:Object,
        link: {
          type: Boolean,
          default: true
        },
        avatar: {
            type: Boolean,
            default: false
        },
        medals: {
            type: Boolean,
            default: false
        },
        avatarSm: {
            type: Boolean,
            default: false
        },
        avatarSquare: {
            type: Boolean,
            default: false
        },
        noEmail: {
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

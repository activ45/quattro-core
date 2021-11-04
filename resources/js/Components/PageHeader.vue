<template>
    <div class="page-header">
        <div class="row align-items-center">
            <slot></slot>
            <!-- Page title actions -->
            <div class="col-auto ms-auto text-end d-print-none " style="text-align: right;" v-if="backUrl !== null">
                <span class="d-none d-sm-inline">
                  <Link :href="backUrl" :class="backText===''?'btn-icon':''" class="btn btn-dark">
                      <ArrowBackUpIcon></ArrowBackUpIcon>
                    {{ backText }}
                  </Link>
                </span>
                <span class="d-sm-none">
                  <Link :href="backUrl" class="btn btn-dark btn-icon">
                      <ArrowBackUpIcon></ArrowBackUpIcon>
                  </Link>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {
        Link
    },
    props:{
        backUrl:{
            type:String,
            default:null
        },
        backText:{
            type:String,
            default:'Geri dön'
        },
        backColor:{
            type:String,
            default:'dark'
        }
    }
}
</script>

<style scoped>

</style>

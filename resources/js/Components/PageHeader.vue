<template>
    <div class="page-header">
        <div class="row">
            <slot></slot>
            <!-- Page title actions -->
            <div class="col ml-auto text-end d-print-none " style="text-align: right;" v-if="backUrl !== null">
                <span class="d-none d-sm-inline">
                  <inertia-link :href="backUrl" :class="backText===''?'btn-icon':''" class="btn btn-dark">
                      <ArrowBackUpIcon></ArrowBackUpIcon>
                    {{ backText }}
                  </inertia-link>
                </span>
                <span class="d-sm-none">
                  <inertia-link :href="backUrl" class="btn btn-dark btn-icon">
                      <ArrowBackUpIcon></ArrowBackUpIcon>
                  </inertia-link>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
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

<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="card-title"><user-icon class="align-text-bottom" /> Profil Bilgisi</div>
            </div>
            <div class="card-body">
                <div class="mb-3 text-center">
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal-small">
                        <avatar :size="100" class="avatar-upload cursor-pointer d-inline-flex"
                                background-color="#f0f2f6"
                                color="#656d77"
                                :rounded="true"
                                :username="$page.props.user.full_name"
                                :src="$page.props.user.profile_photo_url"></avatar>
                    </a>
                    <Link href="#"
                          @click.prevent="deleteProfilePhoto"
                          :class="{'btn-loading':process_name === 'photo_delete','disabled':process_name != null}"
                          v-show="$page.props.user.profile_photo_path !==  null"
                          class="btn btn-sm btn-danger">Kaldır</Link>
                </div>
                <div class="text-center">
                    <h3>
                        {{user.full_name}}<span class="font-weight-light">, {{ user.birth_year }}</span>
                    </h3>
                    <div class="h5 font-weight-300">
                        <BadgeUserRole :user="user"/>
                    </div>
                    <div class="h5 mt-4" v-if="user.departments.length">
                        <ArtboardIcon/> {{user.departments.join(',')}}
                    </div>
                    <div class="mt-2">
                        <mail-icon style="stroke-width: 1.25 !important;" /> {{user.email}}
                    </div>
                    <div class="mt-2">
                        <id-icon style="stroke-width: 1.25 !important;" /> {{user.tc_kn}}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" ref="modalSmall" id="modal-small" tabindex="-1"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <form @submit.prevent="submitPhotoFile" enctype="multipart/form-data"
                      ref="formUpload" class="modal-content">
                    <div class="modal-body">
                        <div class="modal-title">Fotoğraf yükle</div>
                        <div>
                            <input type="file" ref="upload" name="photoFile" id="upload"
                                   accept="image/x-png,image/gif,image/jpeg"
                                   :class="errors.updateProfilePhoto && errors.updateProfilePhoto.photo?'is-invalid':''"
                                   class="form-control" />
                            <div v-if="errors.updateProfilePhoto" class="invalid-feedback">
                                {{errors.updateProfilePhoto.photo}}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-danger me-auto"
                                ref="modalCancel"
                                @click="uploadPhotoCancel" data-bs-dismiss="modal">Vazgeç</button>
                        <button type="submit"
                                :class="{'btn-loading':process_name === 'photo_update','disabled':process_name != null}"
                                class="btn btn-primary">Yükle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Avatar from "vue-avatar";
import Alert from "@/Components/Alert"
import BadgeUserRole from "@/Components/BadgeUserRole";

export default {
    name: "TabProfile",
    components: {BadgeUserRole, Avatar,Alert },
    props:{
        errors:{
            type: Object,
            default: () => ({})
        },
        user: Object
    },
    data() {
        return {
            process_name:null
        }
    },
    mounted() {
        this.$inertia.on('finish', () => this.process_name = null)
        this.$refs.modalSmall.addEventListener('hidden.bs.modal',(event)=>{
            this.uploadPhotoCancel();
        })


    },
    methods:{
        /**
         * @deprecated
         */
        submitProfileUpdate(){
            // this.form_user.put(route('user-profile-information.update'),{
            //     errorBag:'updateProfileInformation',
            //     onStart:()=>this.process_name='profile_update',
            //     onFinish:() => this.process_name=null,
            // })
        },

        deleteProfilePhoto(){
            this.swalConfirm('Profil fotoğrafını silmek istediğine emin misin?').then((result) => {
                if (result.isConfirmed) {
                    this.process_name = "photo_delete";
                    this.$inertia.delete(route('profile.delete-profile-photo'))
                }
            })
        },
        submitPhotoFile(){
            const formData= new FormData()
            formData.append('photo', this.$refs.upload.files[0])
            formData.append('type', 'photo')
            formData.append('_method', 'PUT');

            this.process_name = "photo_update";
            this.$inertia.post(route('user-profile-photo.update'), formData,{
                onSuccess:()=>{
                    this.$refs.modalCancel.click()
                }
            })
            // this.$inertia.put(route('user-profile-photo.update'), formData)
        },
        uploadPhotoCancel(){
            this.$refs.formUpload.reset()
            this.$refs.upload.value=null;
        },
    }
};
</script>



<style scoped>
div.fileinputs {
    position: relative;
}

div.fakefile {
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 1;
}

input.file {
    position: relative;
    text-align: right;
    -moz-opacity:0 ;
    filter:alpha(opacity: 0);
    opacity: 0;
    z-index: 2;
}

</style>

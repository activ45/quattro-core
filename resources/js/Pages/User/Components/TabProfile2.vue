<template>
    <div>
        <form @submit.prevent="submitProfileUpdate" class="card">
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
                <div class="mb-3">
                    <label class="form-label">Ad</label>
                    <input type="text" v-model="form_user.first_name"
                           :class="form_user.errors.first_name?'is-invalid':''"
                           class="form-control"/>
                    <div v-if="form_user.errors.first_name" class="invalid-feedback">
                        {{form_user.errors.first_name}}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Soyad</label>
                    <input type="text" v-model="form_user.last_name"
                           :class="form_user.errors.last_name?'is-invalid':''"
                           class="form-control"/>
                    <div v-if="form_user.errors.last_name" class="invalid-feedback">
                        {{form_user.errors.last_name}}</div>
                </div>
                <Alert type="warning" v-if="!$page.props.user.tc_verified_at">TC Kimlik bilgilerini doğrulamak için profilinizi güncelleyin.</Alert>
                <div class="mb-3">
                    <label class="form-label">TC Kimlik Numarası</label>
                    <input type="text" v-model="form_user.tckn"
                           :class="{'is-invalid':form_user.errors.tckn,'border-warning':!$page.props.user.tc_verified_at}"
                           class="form-control"/>
                    <div v-if="form_user.errors.tckn" class="invalid-feedback">
                        {{form_user.errors.tckn}}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Doğum Tarihi</label>
                    <input type="text" v-model="form_user.birth_year"
                           :class="{'is-invalid':form_user.errors.birth_year,'border-warning':!$page.props.user.tc_verified_at}"
                           class="form-control"/>
                    <div v-if="form_user.errors.birth_year" class="invalid-feedback">
                        {{form_user.errors.birth_year}}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">E-Posta</label>
                    <input type="text"
                           :class="form_user.errors.email?'is-invalid':''"
                           v-model="form_user.email"
                           class="form-control"/>
                    <div v-if="form_user.errors.email" class="invalid-feedback">
                        {{form_user.errors.email}}</div>
                    <Alert type="info" icon class="mt-2">Yeni E-Posta adresinizi doğrulamanız gerekli.</Alert>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit"
                        class="btn btn-primary"
                        :class="{'btn-loading':process_name === 'profile_update','disabled':process_name != null || !form_user.isDirty}"><check-icon/> Güncelle</button>
            </div>
        </form>

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

export default {
    name: "TabProfile",
    components: {Avatar,Alert },
    props:{
        errors:{
            type: Object,
            default: () => ({})
        }

    },
    data() {
        return {
            form_user: this.$inertia.form({
                first_name:this.$page.props.user.first_name,
                last_name:this.$page.props.user.last_name,
                tc_kn:this.$page.props.user.tc_kn,
                birth_year:this.$page.props.user.birth_year,
                email:this.$page.props.user.email
            }),
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
            this.form_user.profile_photo_url = this.$page.props.user.profile_photo_url;
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

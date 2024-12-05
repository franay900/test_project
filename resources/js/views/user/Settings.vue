<script>
import api from "../../api.js";
import { Modal } from 'bootstrap'


export default {
    name: "Settings",

    data(){
        return {
            settings: null,
            user: null,
            setting: null,
            verificationType: 'email',
            code: null,
            errors: []
        }
    },

    methods: {
        getSettings(){

            api.get('settings')
                .then(res => {
                    this.settings = res.data.data
                    this.getUser()
                })
        },

        getUser(){
            api.post('auth/me')
                .then(res => {
                    this.user = res.data.data

                    this.settings = this.settings.map(setting => ({
                        ...setting,
                        value: this.user.settings.find(p => setting.id === p.id)?.value
                    }))



                })
        },
        getCode(setting){
            this.errors = []
            setting.value = !setting.value
            api.post('verification_code', {setting_id: setting.id, method: this.verificationType})
                .then(res => {

                })
            this.setting = setting

            this.modal.show()
        },
        updateSetting(setting){
            api.post('user_settings', {setting_id: this.setting.id, code: this.code})
                .then(res => {

                    this.setting.value = !this.setting.value
                    this.code = null
                    this.modal.hide()
                })
                .catch(e => {
                    this.code = null
                    this.errors = e.response.data.errors
                })

        },

        changeVerificationType(verificationType){
            this.verificationType = verificationType
            this.setting.value = !this.setting.value
            this.getCode(this.setting)
        }
    },

    mounted() {
        this.getSettings()

        this.modal = new Modal(this.$refs.exampleModal)
    }
}
</script>

<template>

    <div v-if="user && settings" class="container-xl px-4 mt-4">

        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link  ms-0" href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details" target="__blank">Profile</a>

            <a class="nav-link active" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"  target="__blank">Notifications</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-12">
                <!-- Email notifications preferences card-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                         Settings

                    </div>
                    <div class="card-body">
                        <form>


                            <!-- Form Group (email updates checkboxes)-->
                            <div class="mb-0">

                                <div class="form-check mb-2"  v-for="setting in settings">
                                    <input v-model="setting.value" class="form-check-input" id="checkAccountChanges" type="checkbox"  @change="getCode(setting)">
                                    <label class="form-check-label" for="checkAccountChanges">{{ setting.name }}</label>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="modal modal-lg fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" ref="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Сonfirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row  mt-7">
                        <div class="col text-center">
                            <a href="index.html">
                                <img src="assets/img/svg/logo.svg" alt="">
                            </a>
                            <div class="card mt-5">
                                <div class="card-body py-5 px-lg-5">
                                    <div class="svg-icon svg-icon-xl text-purple">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><title>ionicons-v5-g</title><path d="M336,208V113a80,80,0,0,0-160,0v95" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><rect x="96" y="208" width="320" height="272" rx="48" ry="48" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></rect></svg>
                                    </div>
                                    <h3 class="fw-normal text-dark mt-4">
                                        2-step verification
                                    </h3>
                                    <p class="mt-4 mb-1">
                                        We sent a verification code to your email.
                                    </p>
                                    <p>
                                        Please enter the code in the field below.
                                    </p>

                                    <div class="row mt-4 pt-2">
                                        <div class="col">
                                            <input v-model="code" type="text"
                                                   class="form-control form-control-lg text-center py-4 "
                                                   maxlength="6" autofocus="">
                                        </div>

                                        <div v-if="errors">
                                            <p class="text-danger" v-for="error in errors.code">{{ error }}</p>
                                        </div>
                                    </div>

                                    <a @click.prevent="updateSetting" href="#!" class="btn btn-primary btn-lg w-100 hover-lift-light mt-4">
                                        Continue
                                    </a>
                                </div>
                            </div>

                            <p class="text-center text-muted mt-4">

                                <a v-if="verificationType !== 'telegram'" @click.prevent="changeVerificationType('telegram')" href="#!" class="text-decoration-none ms-2">
                                    Send to Telegram
                                </a>

                                <a v-if="verificationType !== 'sms'"   @click.prevent="changeVerificationType('sms')" href="#!" class="text-decoration-none ms-2">
                                    Send to Sms
                                </a>

                                <a v-if="verificationType !== 'email'"  @click.prevent="changeVerificationType('email')" href="#!" class="text-decoration-none ms-2">
                                    Send to Email
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<style scoped>
body{margin-top:20px;
    background-color:#f2f6fc;
    color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}

.btn-danger-soft {
    color: #000;
    background-color: #f1e0e3;
    border-color: #f1e0e3;
}


body{margin-top:20px;
    background:#f6f9fc;
}
.icon-circle[class*=text-] [fill]:not([fill=none]), .icon-circle[class*=text-] svg:not([fill=none]), .svg-icon[class*=text-] [fill]:not([fill=none]), .svg-icon[class*=text-] svg:not([fill=none]) {
    fill: currentColor!important;
}
.svg-icon-xl>svg {
    width: 3.25rem;
    height: 3.25rem;
}

.hover-lift-light {
    transition: box-shadow .25s ease,transform .25s ease,color .25s ease,background-color .15s ease-in;
}
.mt-4 {
    margin-top: 1.5rem!important;
}
.w-100 {
    width: 100%!important;
}
.btn-group-lg>.btn, .btn-lg {
    padding: 0.8rem 1.85rem;
    font-size: 1.1rem;
    border-radius: 0.3rem;
}


.text-center {
    text-align: center!important;
}
.py-4 {
    padding-top: 1.5rem!important;
    padding-bottom: 1.5rem!important;
}
.form-control-lg {
    min-height: calc(1.5em + 1rem + 2px);
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    border-radius: 0.3rem;
}
.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #1e2e50;
    background-color: #f6f9fc;
    background-clip: padding-box;
    border: 1px solid #dee2e6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

</style>

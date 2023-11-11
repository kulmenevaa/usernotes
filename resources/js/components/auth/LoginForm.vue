<template>
    <div class="row auth">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <form @submit.prevent="login">
                <div>
                    <label for="ip">Введите Email</label>
                    <input type="email" id="email" v-model="form.email" :class="{'is-invalid':errors.email}"> 
                </div>
                <div>
                    <label for="password">Введите Пароль</label>
                    <input type="password" id="password" v-model="form.password" :class="{'is-invalid':errors.password}">
                </div>
                <button type="submit" class="auth-btn" ref="btnSubmit">Войти</button>
            </form>
        </div>
    </div>
</template>

<script>
    import * as auth from '../../services/auth'

    const formData = {email: '', password: ''}
    
    export default {
        data() {
            return {
                form: Object.assign({}, formData),
                errors: false,
            }
        },
        methods: {
            disableSubmission(btn) {
                btn.setAttribute('disabled', 'disabled')
                this.btnHtml = btn.innerHTML
                btn.innerHTML = 'Загрузка...'
            },
            enableSubmission(btn) {
                btn.removeAttribute('disabled')
                btn.innerHTML = this.btnHtml
            },
            resetForm() {
                this.enableSubmission(this.$refs.btnSubmit)
                this.modal = false
                this.form = Object.assign({}, formData)
            },
            login() {
                this.disableSubmission(this.$refs.btnSubmit)
                auth.login(this.form).then(response => {
                    this.errors = false
                    this.resetForm()
                    this.$router.push({name:'note'})
                }).catch(error => {
                    this.errors = error.response.data.errors
                    this.enableSubmission(this.$refs.btnSubmit)
                })
            },
            logout() {
                auth.logout()
            }
        }
    }
</script>

<style scoped>
    .auth {
        margin-top: 20vh;
        justify-content: center;
    }
    .auth-btn {
        width: 100%;
        background-color: #272727;
        color: #fff;
        padding: 15px;
        font-weight: 600;
        font-size: 18px
    }
</style>
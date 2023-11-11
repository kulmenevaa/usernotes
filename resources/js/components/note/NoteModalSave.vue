<template>
    <div class="modal" :class="{'view':modalSave}">
        <div class="shadow-window"></div>
        <div class="modal-container">
            <div class="modal-content">
                <button type="button" class="modal-close" @click="showModalSave">
                    <i class="fa fa-close"></i>
                </button>
                <div class="modal-body">
                    <h3>{{ titleModal }}</h3>
                    <form @submit.prevent="saveNote">
                        <div>
                            <label for="title">Введите Название</label>
                            <input type="text" id="title" v-model="formSave.title">
                        </div>
                        <div>
                            <label for="description">Введите Описание</label>
                            <textarea id="description" rows="10" v-model="formSave.description"></textarea>
                        </div>
                        <button type="submit" class="save" ref="btnSubmit">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</template>

<script>
import * as note from '../../services/note'

export default {
    props: ['modalSave', 'showModalSave', 'titleModal', 'formSave', 'noteList'],
    methods: {
        saveNote() {
            this.disableSubmission(this.$refs.btnSubmit)

            let data = new FormData()
            data.append('title', this.formSave.title ?? '')
            data.append('description', this.formSave.description ?? '')
            if(this.formSave.id) {
                data.append('_method', 'put')
                note.updateNote(this.formSave.id, data).then(response => {
                    this.resetForm()
                    this.noteList.map(note => {
                        if(note.id == response.data.id) {
                            for (let key in response.data) {
                                note[key] = response.data[key]
                            }
                        }
                    })
                    this.$toast.success(response.message)
                }).catch(errors => {
                    console.log(errors)
                })
            } else {
                note.createNote(data).then(response => {
                    this.resetForm()
                    this.noteList.unshift(response.data)
                    this.$toast.success(response.message)
                }).catch(errors => {
                    console.log(errors)
                })
            }
        },
        resetForm() {
            this.enableSubmission(this.$refs.btnSubmit)
            this.showModalSave()
            this.formSave = {}
        },
        disableSubmission(btn) {
            btn.setAttribute('disabled', 'disabled')
            this.btnHtml = btn.innerHTML
            btn.innerHTML = 'Загрузка...'
        },
        enableSubmission(btn) {
            btn.removeAttribute('disabled')
            btn.innerHTML = this.btnHtml
        },
    }
}
</script>

<style scoped>
    .save {
        width: 100%;
        background-color: #272727;
        color: #fff;
        padding: 15px;
        font-weight: 600;
        font-size: 18px
    }
</style>
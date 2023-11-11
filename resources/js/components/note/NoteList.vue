<template>
    <v-row>
        <div>
            <v-btn @click="showModalSave" dark>Создать</v-btn>
        </div>
        <NoteModalSave
            :modalSave="modalSave"
            :showModalSave="showModalSave"
            :titleModal="titleModal"
            :formSave="formSave"
            :noteList="noteList"
        />
        <NoteModalShare
            :modalShare="modalShare"
            :showModalShare="showModalShare"
            :formShare="formShare"
        />
        <div class="col-md-4 item-note" v-for="(item, index) in noteList">
            <v-card class="mx-auto py-3" style="width: 100%;">
                <div class="close">
                    <i class="fa fa-share" title="Поделиться" @click="showModalShare(item)"></i>
                    <i class="fa fa-edit" title="Изменить" @click="showModalSave(item)"></i>
                    <i class="fa fa-close" title="Удалить" @click="deleteNote(item)"></i>
                </div>
                <v-card-title class="mt-6" style="line-height: 1.75rem;">{{ item.title }}</v-card-title>
                <v-card-text>
                    <div>{{ item.description }}</div>
                </v-card-text>
            </v-card>
        </div>
    </v-row>
</template>

<script>
import * as note from '../../services/note'
import NoteModalSave from './NoteModalSave'
import NoteModalShare from './NoteModalShare'

export default {
    data() {
        return {
            modalSave: false,
            modalShare: false,
            titleModal: '',
            formSave: {},
            formShare: {},
            noteList: {},
            errors: false,
        }
    },
    components: {
        NoteModalSave,
        NoteModalShare
    },
    mounted() {
        this.listNote()
    },
    methods: {
        listNote() {
            note.getNotesList().then(response => {
                this.noteList = response.data
            }).catch(errors => {
                console.log(errors)
            })
        },
        deleteNote(value) {
            if (!window.confirm('Вы действительно хотитете удалить эту заметку?')) {
                return
            }
            note.deleteNote(value.id).then(response => {
                this.noteList = this.noteList.filter(obj => {
                    return obj.id != value.id
                })
                this.$toast.success(response.message)
            }).catch(errors => {
                console.log(errors)
            })
        },
        showModalSave(data) {
            this.modalSave = !this.modalSave
            this.formSave = {...data}
            if(this.formSave.id) {
                this.titleModal = 'Изменение заметки' 
            } else {
                this.formSave = {}
                this.titleModal = 'Создание заметки'
            }
        }, 
        showModalShare(data) {
            this.modalShare = !this.modalShare
            this.formShare = {...data}
        }
    }
}
</script>

<style scoped>
    .close {
        position: absolute; 
        top: 10px;
        right: 15px;
    }
    .close i {
        cursor: pointer;
    }
    .close i:not(:last-child) {
        margin-right: 10px;
    }
    .close i:hover {
        opacity: 0.4;
    }
    .item-note {
        display: flex;
        align-items: stretch;

    }
</style>
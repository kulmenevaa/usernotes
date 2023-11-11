<template>
    <div class="modal" :class="{'view':modalShare}">
        <div class="shadow-window"></div>
        <div class="modal-container">
            <div class="modal-content">
                <button type="button" class="modal-close" @click="showModalShare">
                    <i class="fa fa-close"></i>
                </button>
                <div class="modal-body">
                    <h3 style="margin-bottom: 0;">Поделиться заметкой</h3>
                    <h3>{{ formShare.title }}</h3>
                    <form @submit.prevent="shareUserNote">
                        <div>
                            <label for="users">Выберите пользователей</label>
                            <select id="users" v-model="usersShare" style="height: 240px" multiple>
                                <option v-for="(item, index) in userList" :value="item.id">{{ `${item.fio} - ${item.email}` }}</option>
                            </select>
                        </div>
                        <button type="submit" class="save">Поделиться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import * as user from '../../services/user'
import * as user_note from '../../services/user_note'

export default {
    props: ['modalShare', 'showModalShare', 'formShare'],
    data() {
        return {
            usersShare: [],
            userList: {}
        }
    },
    mounted() {
        this.listUser()
    },
    methods: {
        listUser() {
            user.getUsersList().then(response => {
                this.userList = response.data
            }).catch(errors => {
                console.log(errors)
            })
        },
        shareUserNote() {
            let data = new FormData()
            data.append('noteID', this.formShare.id ?? '')
            data.append('usersShare', this.usersShare ?? '')
            user_note.shareUserNote(data).then(response => {
                this.showModalShare()
                this.$toast.success(response.message)
            }).catch(errors => {
                console.log(errors)
            })
        }
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
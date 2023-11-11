<template>
    <div>
        <v-toolbar flat>
            <v-toolbar-title class="grey--text">{{ title }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <div class="profile_info">
                <!--<h1>{{ $store.state.profile.email }}</h1>-->
                <v-btn @click="logout">Выйти</v-btn>
            </div>
        </v-toolbar>
        <v-divider></v-divider>
    </div>
</template>

<script>
import * as auth from '../../services/auth'

export default {
    data() {
        return {
            title: '[SE]: ТЕСТОВОЕ - Заметки пользователя'
        }
    },
    beforeCreate() {
        if (auth.isLoggedIn()) {
            auth.getProfile().then(response => {
                this.$store.dispatch('authenticate', response)
            }).catch(errors => {
                auth.logout();
            })
        }
    },
    methods: {
        logout() {
            auth.logout()
            this.$router.push({name:'login'})
        },
    }
}
</script>

<style scoped>
    .profile_info {
        display: flex;
        align-items: center;
    }
    .profile_info > h1 {
        margin: 0 20px;
    }
    .profile_info > button:not(:last-child) {
        margin: 0 10px;
    }
    .v-application .grey--text {
        color: #000 !important
    }
</style>
<template>
    <v-app>
        <v-row class="app">
            <v-card flat>
                <v-toolbar dark extended flat></v-toolbar>
                <v-card class="mx-auto" max-width="1200" style="margin-top: -70px;">
                    <Toolbar/>
                    <main class="main">
                        <!--<GlobalLoading/>-->
                        <router-view></router-view>
                    </main>
                </v-card>
            </v-card>
        </v-row>
    </v-app>
</template>

<script>
import GlobalLoading from './components/app/GlobalLoading'
import Toolbar from './components/app/Toolbar'

export default {
    name: 'App',
    components: { 
        GlobalLoading,
        Toolbar
    },
    created () {
        document.title = "[SE]: ТЕСТОВОЕ";
    }
}
</script>

<style scoped>
    .app {
        margin: -10px -15px 30px;
    }
    .main {
        min-height: calc(100vh - 140px);
        padding: 20px 15px;
    }
</style>
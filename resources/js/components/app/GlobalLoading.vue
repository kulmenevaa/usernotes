<template>
    <div v-if="isLoading" class="loading">
        <img :src="'/img/load.gif'">
    </div>
</template>

<script>
    import { mapState } from "vuex"
    export default {
        computed: {
            ...mapState("loading", ["isLoading"]),
        },
    }
</script>

<style scoped>
    .loading {
        display: flex;
        justify-content: center;
    }
</style>
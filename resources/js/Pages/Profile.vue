<script setup>
import Main from './Layout/Main.vue';


const userId = window.AuthUser?.id || null;


</script>

<template>
    <Main>
        <h1>Hello World</h1>
    </Main>
</template>
<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3'
    // import { ref } from 'vue'
    import GuestLayout from '@/Layouts/GuestLayout.vue'

    defineOptions({
        name: 'Profile'
    })



</script>

<template>
    <GuestLayout>
        <Head title="Profile" />
        <template #title>Профиль</template>
        <p>{{  $page.props.auth }}</p>
    </GuestLayout>
</template>


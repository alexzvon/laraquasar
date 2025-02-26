<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

import GuestLayout from '@/Layouts/GuestLayout.vue'
import Login from './LoginRegister/Login.vue'
import Register from './Register.vue'

defineOptions({
    name: 'TabLoginRegister'
})

const props = defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const tab = ref('login')

// console.log(props)
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
            <q-toolbar class="bg-mutan text-gries">
                <q-toolbar-title>Вход по почте</q-toolbar-title>
                <q-btn outline round class="text-size-8" href="/">
                    <q-icon>
                        <svg id="Close--Streamline-Carbon" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="-0.5 -0.5 16 16" height="16" width="16">
                            <desc>Close Streamline Icon: https://streamlinehq.com</desc>
                            <defs></defs>
                            <path d="M8.162859375 7.5 11.25 4.412859375 10.587140625 3.75 7.5 6.837140625 4.4129531250000005 3.75 3.75 4.412859375 6.837140625 7.5 3.75 10.587140625 4.4129531250000005 11.25 7.5 8.162859375 10.587140625 11.25 11.25 10.587140625 8.162859375 7.5z" stroke-width="1"></path>
                        </svg>
                    </q-icon>
                </q-btn>
            </q-toolbar>


            <q-tabs v-model="tab" dense class="">
                <q-tab name="login" label="Вход" />
                <q-tab name="register" label="Регистрация" />
            </q-tabs>
            <q-tab-panels v-model="tab" animated>
                <q-tab-panel name="login" class="q-pa-none">
                    <Login />
                </q-tab-panel>
                <q-tab-panel name="register" class="q-pa-none">
                    <Register />
                </q-tab-panel>
            </q-tab-panels>
    </GuestLayout>
</template>

<style lang="sass" scoped>
.q-field__control
    color: $gries
    background: $mutan !important
</style>

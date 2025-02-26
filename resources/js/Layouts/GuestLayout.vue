<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="window-height window-width row justify-center items-center">
        <q-card class="login-card">
            <div class="full-height full-width border">
                <q-toolbar class="bg-mutan text-gries">
                    <q-toolbar-title>
                        <slot name="title" />
                    </q-toolbar-title>
                    <Link :href="route('index')">
                        <q-btn outline round class="text-size-8">
                            <q-icon>
                                <svg id="Close--Streamline-Carbon" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="-0.5 -0.5 16 16" height="16" width="16">
                                    <desc>Close Streamline Icon: https://streamlinehq.com</desc>
                                    <defs></defs>
                                    <path d="M8.162859375 7.5 11.25 4.412859375 10.587140625 3.75 7.5 6.837140625 4.4129531250000005 3.75 3.75 4.412859375 6.837140625 7.5 3.75 10.587140625 4.4129531250000005 11.25 7.5 8.162859375 10.587140625 11.25 11.25 10.587140625 8.162859375 7.5z" stroke-width="1"></path>
                                </svg>
                            </q-icon>
                        </q-btn>
                    </Link>
                    </q-toolbar>
                <slot />
            </div>
        </q-card>
    </div>
</template>

<style lang="sass" scoped>
.login-card
    width: 320px

</style>

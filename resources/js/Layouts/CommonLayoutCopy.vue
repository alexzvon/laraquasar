<script setup>
    import { ref } from 'vue'
    import { usePage, Head, Link } from "@inertiajs/vue3";

    defineOptions ({
        name: 'CommonLayout'
    })

    const leftDrawerOpen = ref(false)
    const rightDrawerOpen = ref(false)

    const toggleLeftDrawer = () => leftDrawerOpen.value = !leftDrawerOpen.value
    const toggleRightDrawer = () => rightDrawerOpen.value = !rightDrawerOpen.value
</script>

<template>
    <!--<q-layout view="hhh lpr fff">-->
    <!--<q-layout view="lHh Lpr lFf">-->
    <q-layout view="lHh lpr lFf">

      <q-page-scroller expand position="top" :scroll-offset="150" :offset="[0, 0]">
        <div class="col cursor-pointer q-pa-sm bg-accent text-white text-center">
          Scroll back up...
        </div>
      </q-page-scroller>

      <!--<q-header reveal bordered class="bg-primary text-white" height-hint="98">-->
      <q-header reveal="1000px" bordered class="bg-gries text-mutan" height-hint="98">
        <q-toolbar>
          <q-btn flat icon="location_on" label="Орловский" />
          <q-toolbar-title>Интернет - магазин</q-toolbar-title>
          <q-tabs align="left">
            <Link href="/" ><q-tab label="О нас" /></Link>
            <Link href="/" ><q-tab label="Новости" /></Link>
            <Link href="/" ><q-tab label="Оплата" /></Link>
            <Link href="/" ><q-tab label="Доставка" /></Link>
          </q-tabs>
        </q-toolbar>
      </q-header>

      <q-drawer v-model="leftDrawerOpen" side="left" overlay>
        <!-- drawer content -->
      </q-drawer>

      <q-drawer v-model="rightDrawerOpen" side="right" overlay>
        <!-- drawer content -->
      </q-drawer>

      <q-page-container>
        <slot />
      </q-page-container>

      <q-footer reveal bordered class="bg-grey-8 text-white">
        <q-toolbar>
          <q-toolbar-title>
            <q-avatar>
              <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
            </q-avatar>
            <div>Title</div>
          </q-toolbar-title>
        </q-toolbar>
      </q-footer>

    </q-layout>
  </template>

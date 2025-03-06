<script setup>
    import { usePage, Link, router } from '@inertiajs/vue3'
    import { ref, toRaw } from 'vue'

    const widthLeftDrawer = ref(300)

    const leftDrawerOpen = ref(false)
    const rightDrawerOpen = ref(false)

    const toggleLeftDrawer = () => leftDrawerOpen.value = !leftDrawerOpen.value
    const toggleRightDrawer = () => rightDrawerOpen.value = !rightDrawerOpen.value

    const page = usePage()

    // const catalog_id = page.props.catalog_id ?? 0
    // const chapter_id = page.props.chapter_id ?? 0
    const location = page.props.ziggy.location

    const onActiveUsers = () => {
      let id = usePage().props.user == undefined ? 0 : usePage().props.user.id

      return route('dashboard.users.index') == location ||
        route('dashboard.users.create') == location ||
        route('dashboard.users.edit', { 'user': id }) == location
    }

    const onActiveCategory = () => {
      // let category_id = usePage().props.category == undefined ? 0: usePage().props.category.id
      // let characteristic_id = usePage().props.characteric == undefined ? 0: usePage().props.characteric.id
      // let location_page = page.props.ziggy.location

      let category_id = page.props.category == undefined ? 0: page.props.category.id
      // let characteristic_id = page.props.characteric == undefined ? 0: page.props.characteric.id
      let location_page = page.props.ziggy.location

      return route('dashboard.category.index', { category_id: category_id }) == location_page
    }

    const onActiveCharacteristic = () => {
      return route('dashboard.characteristic.index', 
        { 'characteristic_id': page.props.characteristic == undefined ? 0: page.props.characteristic.id }
      ) == location
    }

    const visible = ref(false)

    const loadItem = (r, p, m) => {
        visible.value = true
        router.visit(route(r, p), { method: m})
        // visible.value = false
    }

    const expUseful = ref(
      route('dashboard.brand.index') == location || 
      route('dashboard.color.index') == location || 
      route('dashboard.dimension.index') == location
    )
</script>

<template>
  <q-layout view="hHh Lpr fFf">
    <q-header class="bg-gries text-white" height-hint="98">
      <q-toolbar>
        <div class="row items-center text-mutan" :style="{ width: widthLeftDrawer - 12 + 'px' }">
          <q-btn dense flat round @click="toggleLeftDrawer" class="text-mutan q-mr-md">
            <q-icon>
              <svg id="Table--Streamline-Carbon" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="-0.5 -0.5 16 16" height="16" width="16">
                <desc>Table Streamline Icon: https://streamlinehq.com</desc>
                <defs></defs>
                <title>table</title>
                <path d="M13.59375 2.34375a0.9375 0.9375 0 0 0 -0.9375 -0.9375H2.34375a0.9375 0.9375 0 0 0 -0.9375 0.9375v10.3125a0.9375 0.9375 0 0 0 0.9375 0.9375h10.3125a0.9375 0.9375 0 0 0 0.9375 -0.9375Zm-0.9375 0v1.875H2.34375V2.34375Zm0 10.3125H2.34375v-1.875h10.3125Zm0 -2.8125H2.34375v-1.875h10.3125Zm0 -2.8125H2.34375v-1.875h10.3125Z" stroke-width="1"></path>
                <path id="_Transparent_Rectangle_" d="M0 0h15v15H0Z" fill="none" stroke-width="1"></path>
              </svg>
            </q-icon>
          </q-btn>
          <q-avatar class="q-mr-md">
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          <div class="q-mr-md">
            <span class="text-h4">
              {{ $page.props.auth.user.name }}
            </span>
          </div>
        </div>
        <q-separator dark vertical inset />
        <slot name="select" />
        <q-space />
          <q-tabs align="left">
            <q-btn :href="route('index')" label="В Магазине" flat />
            <q-route-tab to="/page2" label="Page Two" />
            <q-route-tab to="/page3" label="Page Three" />
          </q-tabs>
          <q-btn dense flat round @click="toggleRightDrawer" class="text-mutan">
            <q-icon>
              <svg id="Table--Streamline-Carbon" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="-0.5 -0.5 16 16" height="16" width="16">
                <desc>Table Streamline Icon: https://streamlinehq.com</desc>
                <defs></defs>
                <title>table</title>
                <path d="M13.59375 2.34375a0.9375 0.9375 0 0 0 -0.9375 -0.9375H2.34375a0.9375 0.9375 0 0 0 -0.9375 0.9375v10.3125a0.9375 0.9375 0 0 0 0.9375 0.9375h10.3125a0.9375 0.9375 0 0 0 0.9375 -0.9375Zm-0.9375 0v1.875H2.34375V2.34375Zm0 10.3125H2.34375v-1.875h10.3125Zm0 -2.8125H2.34375v-1.875h10.3125Zm0 -2.8125H2.34375v-1.875h10.3125Z" stroke-width="1"></path>
                <path id="_Transparent_Rectangle_" d="M0 0h15v15H0Z" fill="none" stroke-width="1"></path>
              </svg>
            </q-icon>
          </q-btn>
      </q-toolbar>
    </q-header>
      <q-drawer show-if-above v-model="leftDrawerOpen" side="left" :width="widthLeftDrawer">
        <q-scroll-area class="fit bg-gries text-mutan">
          <q-list dense padding>
            <q-item
              dense
              clickable
              v-ripple
              @click="loadItem('dashboard.dashboard', {}, 'get')"
              :active="route('dashboard.dashboard') == location"
              active-class="text-gries bg-mutan"
            >
              <q-item-section avatar>
                <q-icon size="sm">
                  <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="0 0 24 24" id="Dashboard-2--Streamline-Outlined-Expansion" height="24" width="24">
                    <desc>Dashboard 2 Streamline Icon: https://streamlinehq.com</desc>
                    <g id="dashboard-2">
                      <path id="Union" d="M15.92 10.6933H23.76V0.24H15.92V10.6933ZM10.6933 23.76H23.76V13.3067H10.6933V23.76ZM0.24 10.6933H13.3067V0.24H0.24V10.6933ZM0.24 23.76H8.08V13.3067H0.24V23.76ZM13.3067 21.1467V15.92H21.1467V21.1467H13.3067ZM2.8533 8.08V2.8533H10.6933V8.08H2.8533ZM18.5333 8.08V2.8533H21.1467V8.08H18.5333ZM2.8533 21.1467V15.92H5.4667V21.1467H2.8533Z" stroke-width="1"></path>
                    </g>
                  </svg>
                </q-icon>
              </q-item-section>
              <q-item-section>
						    Панель
              </q-item-section>
            </q-item>
            <q-item
              dense
              clickable
              v-ripple
              @click="loadItem('dashboard.users.index', {}, 'get')"
              :active="onActiveUsers()"
              active-class="text-gries bg-mutan"
            >
              <q-item-section avatar>
                <q-icon size="sm">
                  <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="0 0 24 24" id="Multiple-Users-1--Streamline-Ultimate" height="24" width="24">
                    <desc>Multiple Users 1 Streamline Icon: https://streamlinehq.com</desc>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6c0 0.59674 0.23705 1.16903 0.65901 1.59099 0.42196 0.42196 0.99425 0.65901 1.59099 0.65901 0.59674 0 1.16903 -0.23705 1.59099 -0.65901C6.51295 7.16903 6.75 6.59674 6.75 6c0 -0.59674 -0.23705 -1.16903 -0.65901 -1.59099C5.66903 3.98705 5.09674 3.75 4.5 3.75c-0.59674 0 -1.16903 0.23705 -1.59099 0.65901C2.48705 4.83097 2.25 5.40326 2.25 6Z" stroke-width="1.5"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 9.75c-0.99456 0 -1.94839 0.3951 -2.65165 1.0983C1.14509 11.5516 0.75 12.5054 0.75 13.5v2.25h1.5l0.75 6h3" stroke-width="1.5"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6c0 0.59674 0.2371 1.16903 0.659 1.59099 0.422 0.42196 0.9943 0.65901 1.591 0.65901s1.169 -0.23705 1.591 -0.65901c0.4219 -0.42196 0.659 -0.99425 0.659 -1.59099 0 -0.59674 -0.2371 -1.16903 -0.659 -1.59099 -0.422 -0.42196 -0.9943 -0.65901 -1.591 -0.65901s-1.169 0.23705 -1.591 0.65901c-0.4219 0.42196 -0.659 0.99425 -0.659 1.59099Z" stroke-width="1.5"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 9.75c0.9946 0 1.9484 0.3951 2.6517 1.0983 0.7032 0.7033 1.0983 1.6571 1.0983 2.6517v2.25h-1.5l-0.75 6h-3" stroke-width="1.5"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75c0 0.79565 0.31607 1.55871 0.87868 2.12132C10.4413 6.43393 11.2044 6.75 12 6.75c0.7956 0 1.5587 -0.31607 2.1213 -0.87868C14.6839 5.30871 15 4.54565 15 3.75s-0.3161 -1.55871 -0.8787 -2.12132C13.5587 1.06607 12.7956 0.75 12 0.75c-0.7956 0 -1.5587 0.31607 -2.12132 0.87868C9.31607 2.19129 9 2.95435 9 3.75Z" stroke-width="1.5"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 13.5c0 -1.3924 -0.5531 -2.7277 -1.5377 -3.71231C14.7277 8.80312 13.3924 8.25 12 8.25c-1.3924 0 -2.72774 0.55312 -3.71231 1.53769C7.30312 10.7723 6.75 12.1076 6.75 13.5v2.25H9l0.75 7.5h4.5l0.75 -7.5h2.25V13.5Z" stroke-width="1.5"></path>
                  </svg>
                </q-icon>
              </q-item-section>
              <q-item-section>
                Пользователи
              </q-item-section>
            </q-item> 
            <q-item
              dense
              clickable
              v-ripple
              @click="loadItem('dashboard.category.index', { category_id: 1 }, 'get')"
              :active="onActiveCategory()"
              active-class="text-gries bg-mutan"
            >
              <q-item-section avatar>
						    <q-icon size="sm">
                  <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="0 0 24 24" id="Wallet-1--Streamline-Cyber" height="24" width="24">
                    <desc>Wallet 1 Streamline Icon: https://streamlinehq.com</desc>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M19.5 15.5v6H0.5v-17h19v5" stroke-width="1"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M21.5 15.5v4h-2" stroke-width="1"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m0.5 4.5 2.5 -2h18.5v7" stroke-width="1"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.5 12.5h1" stroke-width="1"></path>
                    <path stroke-linejoin="round" stroke-miterlimit="10" d="M16.5 15.5h7v-6h-7l-2.5 3 2.5 3Z" stroke-width="1"></path>
                  </svg>
                </q-icon>
              </q-item-section>
              <q-item-section>
                Категории
              </q-item-section>
            </q-item>                    
            <q-item
              dense
              clickable
              v-ripple
              @click="loadItem('dashboard.slides.index', {}, 'get')"
              :active="route('dashboard.slides.index') == location"
              active-class="text-gries bg-mutan"
            >
              <q-item-section avatar>
						    <q-icon size="sm">
                  <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="-0.5 -0.5 24 24" id="Slide-Library-Fill--Streamline-Sharp-Fill-Material" height="24" width="24">
                    <desc>Slide Library Fill Streamline Icon: https://streamlinehq.com</desc>
                    <path fill="#000000" d="M1.9166666666666667 19.166570833333335v-12.458333333333334h1.4375v11.020833333333334h13.895833333333334v1.4375H1.9166666666666667Zm3.8333333333333335 -3.8333333333333335v-11.5h10.014583333333333l-1.4375 1.4375H7.1875v8.625h12.458333333333334v-7.139583333333333l1.4375 -1.4375v10.014583333333333H5.75Zm7.1875 -4.048958333333333c-0.33541666666666664 0 -0.6468750000000001 -0.071875 -0.9343750000000001 -0.215625 -0.2875 -0.14375 -0.5350854166666666 -0.35137291666666665 -0.7427083333333334 -0.6229166666666667 0.22362708333333334 0 0.41927083333333337 -0.08385416666666666 0.5869791666666667 -0.2515625 0.16770833333333332 -0.16770833333333332 0.2515625 -0.36335208333333335 0.2515625 -0.5869791666666667 0 -0.35137291666666665 0.12376875 -0.6468750000000001 0.3713541666666667 -0.8864583333333335s0.5470645833333333 -0.359375 0.8984375 -0.359375c0.35137291666666665 0 0.6468750000000001 0.11979166666666667 0.8864583333333335 0.359375s0.359375 0.5350854166666666 0.359375 0.8864583333333335c0 0.4632104166666667 -0.16373125 0.8585229166666667 -0.49114583333333334 1.1859375 -0.32741458333333334 0.32741458333333334 -0.7227270833333334 0.49114583333333334 -1.1859375 0.49114583333333334Zm2.8510416666666667 -2.73125 -1.365625 -1.365625 4.456250000000001 -4.408333333333333 1.3416666666666666 1.3416666666666666 -4.432291666666667 4.432291666666667Z" stroke-width="1"></path>
                  </svg>
							</q-icon>
              </q-item-section>
              <q-item-section>
                Слайды
              </q-item-section>
            </q-item>

            <q-item
              dense
              clickable
              v-ripple
              @click="loadItem('dashboard.characteristic.index', { 'characteristic_id': 0 }, 'get')"
              :active="onActiveCharacteristic()"
              active-class="text-gries bg-mutan"
            >
              <q-item-section avatar>
						    <q-icon size="sm">
                  <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="-0.5 -0.5 24 24" id="Slide-Library-Fill--Streamline-Sharp-Fill-Material" height="24" width="24">
                    <desc>Slide Library Fill Streamline Icon: https://streamlinehq.com</desc>
                    <path fill="#000000" d="M1.9166666666666667 19.166570833333335v-12.458333333333334h1.4375v11.020833333333334h13.895833333333334v1.4375H1.9166666666666667Zm3.8333333333333335 -3.8333333333333335v-11.5h10.014583333333333l-1.4375 1.4375H7.1875v8.625h12.458333333333334v-7.139583333333333l1.4375 -1.4375v10.014583333333333H5.75Zm7.1875 -4.048958333333333c-0.33541666666666664 0 -0.6468750000000001 -0.071875 -0.9343750000000001 -0.215625 -0.2875 -0.14375 -0.5350854166666666 -0.35137291666666665 -0.7427083333333334 -0.6229166666666667 0.22362708333333334 0 0.41927083333333337 -0.08385416666666666 0.5869791666666667 -0.2515625 0.16770833333333332 -0.16770833333333332 0.2515625 -0.36335208333333335 0.2515625 -0.5869791666666667 0 -0.35137291666666665 0.12376875 -0.6468750000000001 0.3713541666666667 -0.8864583333333335s0.5470645833333333 -0.359375 0.8984375 -0.359375c0.35137291666666665 0 0.6468750000000001 0.11979166666666667 0.8864583333333335 0.359375s0.359375 0.5350854166666666 0.359375 0.8864583333333335c0 0.4632104166666667 -0.16373125 0.8585229166666667 -0.49114583333333334 1.1859375 -0.32741458333333334 0.32741458333333334 -0.7227270833333334 0.49114583333333334 -1.1859375 0.49114583333333334Zm2.8510416666666667 -2.73125 -1.365625 -1.365625 4.456250000000001 -4.408333333333333 1.3416666666666666 1.3416666666666666 -4.432291666666667 4.432291666666667Z" stroke-width="1"></path>
                  </svg>
							</q-icon>
              </q-item-section>
              <q-item-section>
                Характеристики
              </q-item-section>
            </q-item>

            <q-expansion-item 
              v-model="expUseful"
              expand-icon-class="text-mutan"
              dense
            >
              <template v-slot:header="{ expUseful }">
                <q-item-section avatar>
                  <q-icon size="sm">
                    <svg id="Layers-External--Streamline-Carbon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"  stroke="currentColor" fill="none" height="16" width="16">
                      <desc>Layers External Streamline Icon: https://streamlinehq.com</desc>
                      <defs></defs>
                      <path d="M8 12c-0.08155 0 -0.1631 -0.0199 -0.23705 -0.0598l-6.5 -3.5 0.4741 -0.88035L8 10.93215l6.26295 -3.3723 0.4741 0.88035 -6.5 3.5c-0.07395 0.0399 -0.1555 0.0598 -0.23705 0.0598Z" stroke-width="0.5"></path>
                      <path d="M8 15c-0.08155 0 -0.1631 -0.0199 -0.23705 -0.0598l-6.5 -3.5 0.4741 -0.88035L8 13.93215l6.26295 -3.3723 0.4741 0.88035 -6.5 3.5c-0.07395 0.0399 -0.1555 0.0598 -0.23705 0.0598Z" stroke-width="0.5"></path>
                      <path d="M14.73705 4.5598 8 0.93215v1.13575l5.4453 2.93215L8 7.9322v1.13575l6.73705 -3.6277c0.162 -0.08715 0.26295 -0.2561 0.26295 -0.4402s-0.10095 -0.35305 -0.26295 -0.4402Z" stroke-width="0.5"></path>
                      <path d="M2.20705 4.70705 4 2.91405V7l1 0V2.91405l1.79295 1.79295L7.5 4 4.5 1 1.5 4l0.70705 0.70705Z" stroke-width="0.5"></path>
                      <path id="_Transparent_Rectangle_" d="M0 0h16v16H0Z" stroke-width="0.5"></path>
                    </svg>                  
                  </q-icon>
                </q-item-section>

                <q-item-section>
                  Справочники
                </q-item-section>
              </template>
              <q-item
                dense
                clickable
                v-ripple
                @click="loadItem('dashboard.brand.index', {}, 'get')"
                :active="route('dashboard.brand.index') == location"
                active-class="text-gries bg-mutan"
                class="q-ml-xl"
              >
                <q-item-section avatar>
                  <q-icon size="sm">
                      <svg role="img" viewBox="0 0 24 24" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg" id="Xdotorg--Streamline-Simple-Icons" height="24" width="24">
                        <desc>Xdotorg Streamline Icon: https://streamlinehq.com</desc>
                        <title>X.Org</title>
                        <path d="m19.94 1.9 -9.092 11.874 4.598 6.392a14.29 14.29 0 0 1 -2.56 0.228c-2.387 0 -4.582 -0.577 -6.316 -1.542l6.556 -8.627 -6.031 -8.311L2.23 1.91 9.8 12.48l-4.332 5.66c-1.692 -1.266 -2.729 -2.965 -2.729 -4.832 0 -2.13 1.348 -4.042 3.48 -5.342l-0.655 -0.999C2.22 8.386 0 10.876 0 13.71c0 2.432 1.635 4.61 4.212 6.075l-1.765 2.307h1.661l1.299 -1.709c1.892 0.83 4.158 1.314 6.592 1.314a17.43 17.43 0 0 0 4.188 -0.501l0.65 0.903h4.865l-1.729 -2.422C22.443 18.214 24 16.082 24 13.71c0 -2.94 -2.39 -5.512 -5.948 -6.9l-0.217 0.311c3.099 1.214 5.195 3.531 5.195 6.188 0 2.202 -1.44 4.17 -3.698 5.47l-5.153 -7.22 7.382 -9.658zM12 5.755c-0.586 0 -1.212 0.046 -1.775 0.1 1.004 1.309 1.836 2.417 2.795 3.676 -0.538 -1.157 -1.644 -2.268 -1.261 -2.839 0.378 -0.565 1.075 -0.47 1.128 -0.47 1.118 0 2.194 0.127 3.2 0.36l0.235 -0.324C14.98 5.91 13.523 5.754 12 5.754z"></path>
                      </svg>
                    </q-icon>
                </q-item-section>
                <q-item-section>
                  Бренд
                </q-item-section>
              </q-item>

              <q-item
                dense
                clickable
                v-ripple
                @click="loadItem('dashboard.color.index', {}, 'get')"
                :active="route('dashboard.color.index') == location"
                active-class="text-gries bg-mutan"
                class="q-ml-xl"
              >
                <q-item-section avatar>
                  <q-icon size="sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16" stroke="currentColor" fill="none" id="Color--Streamline-Atlas" height="16" width="16">
                      <desc>Color Streamline Icon: https://streamlinehq.com</desc>
                      <defs></defs>
                      <g id="roll_brush">
                        <path d="M3.28125 8.40625a0.3 0.3 0 1 0 0.6 0 0.3 0.3 0 1 0 -0.6 0" stroke-miterlimit="10" stroke-width="1"></path>
                        <path d="M4.48125 11.399999999999999a0.3 0.3 0 1 0 0.6 0 0.3 0.3 0 1 0 -0.6 0" stroke-miterlimit="10" stroke-width="1"></path>
                        <path d="M3.88125 5.40625a0.3 0.3 0 1 0 0.6 0 0.3 0.3 0 1 0 -0.6 0" stroke-miterlimit="10" stroke-width="1"></path>
                        <path d="M6.2749999999999995 3.6125000000000003a0.3 0.3 0 1 0 0.6 0 0.3 0.3 0 1 0 -0.6 0" stroke-miterlimit="10" stroke-width="1"></path>
                        <path d="M9.275 4.2125a0.3 0.3 0 1 0 0.6 0 0.3 0.3 0 1 0 -0.6 0" stroke-miterlimit="10" stroke-width="1"></path>
                        <path d="M11.075 6.60625a0.3 0.3 0 1 0 0.6 0 0.3 0.3 0 1 0 -0.6 0" stroke-miterlimit="10" stroke-width="1"></path>
                        <path d="M14.068750000000001 7.4125a3.04375 3.04375 0 0 1 -3.0375 3.09375h-0.91875a2.6750000000000003 2.6750000000000003 0 0 0 -2.2312499999999997 1.1937499999999999l-0.71875 1.075a2.9625000000000004 2.9625000000000004 0 0 1 -2.5 1.3250000000000002 2.88125 2.88125 0 0 1 -2.41875 -1.25 8.16875 8.16875 0 0 1 -1.3625 -4.5375V7.5a6.59375 6.59375 0 0 1 13.1875 -0.09375Z" stroke-miterlimit="10" stroke-width="1"></path>
                      </g>
                    </svg>
                  </q-icon>
                </q-item-section>
                <q-item-section>
                  Цвет
                </q-item-section>
              </q-item>

              <q-item
                dense
                clickable
                v-ripple
                @click="loadItem('dashboard.dimension.index', {}, 'get')"
                :active="route('dashboard.dimension.index') == location"
                active-class="text-gries bg-mutan"
                class="q-ml-xl"
              >
                <q-item-section avatar>
                  <q-icon size="sm">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="0 0 24 24" id="Package-Dimension--Streamline-Ultimate" height="24" width="24">
                      <desc>Package Dimension Streamline Icon: https://streamlinehq.com</desc>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M21.25 7.25v16" stroke-width="1.5"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m19.25 9.25 2 -2 2 2" stroke-width="1.5"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m23.25 21.25 -2 2 -2 -2" stroke-width="1.5"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M16.75 2.75h-16" stroke-width="1.5"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m14.75 0.75 2 2 -2 2" stroke-width="1.5"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m2.75 4.75 -2 -2 2 -2" stroke-width="1.5"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M15.75 7.25h-14c-0.6 0 -1 0.4 -1 1v14c0 0.6 0.4 1 1 1h14c0.6 0 1 -0.4 1 -1v-14c0 -0.6 -0.4 -1 -1 -1Z" stroke-width="1.5"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M11.25 7.25h-5v6h5v-6Z" stroke-width="1.5"></path>
                    </svg>
                  </q-icon>
                </q-item-section>
                <q-item-section>
                  Размер
                </q-item-section>
              </q-item>

            </q-expansion-item>
            <q-separator class="q-my-md"/>
          </q-list>
        </q-scroll-area>
      </q-drawer>
      <q-drawer v-model="rightDrawerOpen" side="right" overlay bordered>
        <p>{{  $page.props.auth }}</p>
      </q-drawer>

      <q-page-container>
        <slot />
        <q-inner-loading :showing="router.processing">
          <q-spinner-gears size="50px" color="gries" />
        </q-inner-loading>
      </q-page-container>

      <q-footer elevated class="bg-grey-8 text-white">
        <q-toolbar>
          <q-toolbar-title>
            <q-avatar>
              <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
            </q-avatar>
            <div>Title</div>
            <slot name="footer" />
          </q-toolbar-title>
        </q-toolbar>
      </q-footer>
    </q-layout>
</template>

<style lang="sass">
body
    overflow: hidden !important
</style>

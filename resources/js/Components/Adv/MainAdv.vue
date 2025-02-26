<script setup>
    import { ref } from 'vue'
    import { Platform } from 'quasar'
    import { router } from "@inertiajs/vue3"

    defineOptions({
        name: 'MainAdv'
    })

    const props = defineProps({
        slides: Array
    })

    const slide = ref(1)
    const autoplay = ref(true)
    const isMobile = ref(!Platform.is.mobile)

    //this.$inertia.get('/')
    // console.log(props.slides)

</script>

<template>
    <div class="q-pa-md">
        <q-carousel
            animated
            v-model="slide"
            ref="carousel"
            swipeable
            :thumbnails="isMobile"
            infinite
            arrows
            :autoplay="autoplay"
            transition-prev="slide-right"
            transition-next="slide-left"
            @mouseenter="autoplay = false"
            @mouseleave="autoplay = true"
            class="carusel-height-screen"
        >

            <q-carousel-slide
                v-for="(slide, index) in slides"
                :key="index"
                :name="index"
                :img-src="slide.picture"
                @click="router.visit(slide.href, { method: 'get' })"/>
<!--
            <q-carousel-slide :name="1" img-src="https://cdn.quasar.dev/img/mountains.jpg" @click="router.visit('/', { method: 'get' })"/>

            <q-carousel-slide :name="2" img-src="https://cdn.quasar.dev/img/parallax1.jpg" @click="router.visit('/about', { method: 'get' })"/>

            <q-carousel-slide :name="3" img-src="https://cdn.quasar.dev/img/parallax2.jpg" @click="router.visit('/', { method: 'get' })"/>

            <q-carousel-slide :name="4" img-src="https://cdn.quasar.dev/img/quasar.jpg" @click="router.visit('/', { method: 'get' })"/>
-->
            <!--
            <template v-slot:control>
                <q-carousel-control position="right">
                    <q-btn flat round dense text-color="text-mutan" @click="$refs.carousel.next()">
                        <q-icon>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16" stroke="currentColor" fill="none" id="Caret-Circle-Right-Light--Streamline-Phosphor" height="16" width="16">
                                <desc>Caret Circle Right Light Streamline Icon: https://streamlinehq.com</desc>
                                <path d="M7.5 0.15C1.84196484375 0.14974804687499998 -1.6942499999999998 6.274587890625 1.13455078125 11.174712890625c2.828794921875 4.900130859375 9.9013359375 4.900447265625 12.730570312500001 0.00057421875C14.510326171875 10.057875000000001 14.85 8.790304687499999 14.85 7.5 14.845236328125 3.442681640625 11.557318359375 0.154763671875 7.5 0.15Zm0 13.835291015625c-4.992380859375 0.00022851562499999999 -8.11257421875 -5.404048828125 -5.61657421875 -9.7276875C4.37942578125 -0.06603515625 10.619900390625 -0.06631640625 13.11628125 4.2570996093749995c0.5692968749999999 0.9859511718749999 0.869009765625 2.10439453125 0.869009765625 3.242900390625C13.98132421875 11.080078125 11.080078125 13.981318359374999 7.5 13.985291015625Zm2.034943359375 -6.790822265625c0.1685859375 0.168802734375 0.1685859375 0.442259765625 0 0.6110625000000001l-2.88235546875 2.8823496093750003c-0.24349218749999998 0.2268984375 -0.6413027343750001 0.105123046875 -0.7160566406250001 -0.21919921875 -0.032255859375 -0.139951171875 0.007083984375 -0.286787109375 0.105 -0.391857421875L8.617634765624999 7.5l-2.576103515625 -2.57682421875c-0.226904296875 -0.24349218749999998 -0.105123046875 -0.6413027343750001 0.21919921875 -0.7160566406250001 0.139951171875 -0.032255859375 0.286787109375 0.007083984375 0.391857421875 0.105Z" stroke-width="1"></path>
                            </svg>
                        </q-icon>
                    </q-btn>
                </q-carousel-control>
                <q-carousel-control position="left" :offset="[18, 190]">
                    <q-btn flat round dense text-color="text-mutan" @click="$refs.carousel.previous()" class="q-btn-bg-none">
                        <q-icon>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16" stroke="currentColor" fill="none" id="Caret-Circle-Left-Light--Streamline-Phosphor" height="16" width="16">
                                <desc>Caret Circle Left Light Streamline Icon: https://streamlinehq.com</desc>
                                <path d="M7.5 0.15C1.84196484375 0.14974804687499998 -1.6942499999999998 6.274587890625 1.13455078125 11.174712890625c2.828794921875 4.900130859375 9.9013359375 4.900447265625 12.730570312500001 0.00057421875C14.510326171875 10.057875000000001 14.85 8.790304687499999 14.85 7.5 14.845236328125 3.442681640625 11.557318359375 0.154763671875 7.5 0.15Zm0 13.835291015625c-4.992380859375 0.00022851562499999999 -8.11257421875 -5.404048828125 -5.61657421875 -9.7276875C4.37942578125 -0.06603515625 10.619900390625 -0.06631640625 13.11628125 4.2570996093749995c0.5692968749999999 0.9859511718749999 0.869009765625 2.10439453125 0.869009765625 3.242900390625C13.98132421875 11.080078125 11.080078125 13.981318359374999 7.5 13.985291015625Zm1.45846875 -9.062115234375L6.382365234375 7.5l2.576103515625 2.57682421875c0.243498046875 0.2268984375 0.150052734375 0.632302734375 -0.168193359375 0.729720703125 -0.15816796875 0.048421875 -0.330099609375 0.0023496093749999997 -0.44286328125 -0.1186640625l-2.88235546875 -2.8823496093750003c-0.168591796875 -0.168802734375 -0.168591796875 -0.442259765625 0 -0.6110625000000001l2.88235546875 -2.8823496093750003c0.24349218749999998 -0.226904296875 0.6413027343750001 -0.105123046875 0.7160566406250001 0.21919921875 0.032255859375 0.139951171875 -0.007083984375 0.286787109375 -0.105 0.391857421875Z" stroke-width="1"></path>
                            </svg>
                        </q-icon>
                    </q-btn>
                </q-carousel-control>

            </template>
        -->
        </q-carousel>
    </div>
</template>

<script setup>
  import DashboardLayout from '@/Layouts/DashboardLayout.vue'
  import Slide from '@/Components/Adv/Slide.vue'

  defineOptions({
    name: 'Slides'
  })

  const props = defineProps({
	 	slides: Array,
	});

  const slide_new =
  {
    id: 0,
    name: null,
    href: null,
    picture: null,
  }

  // const thumbStyle = {
  //   right: '5px',
  //   borderRadius: '5px',
  //   backgroundColor: '#59656F',
  //   width: '3px',
  //   opacity: 0.75
  // }

  // const thumbStyle = {
  //   right: '4px',
  //   borderRadius: '5px',
  //   backgroundColor: '#027be3',
  //   width: '5px',
  //   opacity: 0.75
  // }


  // const barStyle = {
  //   right: '2px',
  //   borderRadius: '9px',
  //   backgroundColor: '#027be3',
  //   width: '9px',
  //   opacity: 0.2
  // }


    // :thumb-style="thumbStyle"
    //   :bar-style="barStyle"


  // const contentStyle = {
  //   backgroundColor: 'rgba(0,0,0,0.02)',
  //   color: '#555'
  // }

  // const contentActiveStyle = {
  //   backgroundColor: '#eee',
  //   color: 'black'
  // }

  // :content-style="contentStyle"
  //     :content-active-style="contentActiveStyle"


  const thumbStyle = {
    right: '2px',
    borderRadius: '5px',
    backgroundColor: '#59656F',
    width: '5px',
    opacity: '0.75'
  }


</script>

<template>
  <DashboardLayout>
    <q-scroll-area
      :thumb-style="thumbStyle"
      style="height: calc(100vh - 120px);"
    >
      <q-list>
        <q-item v-for="(slide, index) in slides" :key="slide.id">
          <q-item-section>
            <slide
              :slide="slide"
              :urlUpdate="route('dashboard.slides.update', { slide: slide.id })"
              :urlDelete="route('dashboard.slides.destroy', { slide: slide.id })"
            />
          </q-item-section>
        </q-item>
        <q-item>
          <q-item-section>
            <slide
              :slide="slide_new"
              :urlCreate="route('dashboard.slides.store')"
            />
          </q-item-section>
        </q-item>
      </q-list>
    </q-scroll-area>  
  </DashboardLayout>
</template>



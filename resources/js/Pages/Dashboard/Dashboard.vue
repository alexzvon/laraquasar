<script setup>
    import DashboardLayout from '@/Layouts/DashboardLayout.vue'

defineOptions({
    name: 'Dashboard'
})

</script>

<template>
    <DashboardLayout>
      <q-scroll-area style="height: calc(100vh - 120px)">

        <p>{{ $page }}</p>
        <!--
        <template v-slot:footer>
            <h3>dashboard fiiter</h3>
        </template>
      -->
      </q-scroll-area>
    </DashboardLayout>
</template>

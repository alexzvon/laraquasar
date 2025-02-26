<script setup>
import Dashboard from '@/Layouts/DashboardLayout.vue'

defineOptions({
    name: 'User'
})

</script>

<template>
    <dashboard>
        <h1>User</h1>
        <p>$page.props.location</p>
        <p>{{ $page.props.ziggy.location }}</p>
    </dashboard>
</template>


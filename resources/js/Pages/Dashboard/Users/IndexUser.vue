<script setup>
    import DashboardLayout from '@/Layouts/DashboardLayout.vue'
    import ListUser from './ListUser.vue'
    import EditUser from './EditUser.vue'
    import CreateUser from './CreateUser.vue'
    import { ref, toRaw } from 'vue'

    defineOptions({
        name: 'IndexUser'
    })

    const props = defineProps({
        users: Array
    })

    const panel = ref('list')
    const userid = ref(0)
    const rows = toRaw(props.users)

</script>

<template>
    <DashboardLayout>
        <q-tab-panels v-model="panel" animated class="text-gries bg-mutan">
            <q-tab-panel name="list">
                <list-user :rows="rows" v-model:panel="panel" v-model:userid="userid" />
            </q-tab-panel>
            <q-tab-panel name="create">
                <create-user v-model:panel="panel" />
            </q-tab-panel>
            <q-tab-panel name="edit">
                <edit-user v-model:panel="panel" v-model:userid="userid" />
            </q-tab-panel>
        </q-tab-panels>
    </DashboardLayout>
</template>

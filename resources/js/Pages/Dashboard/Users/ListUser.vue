<script setup>
    import { ref, toRaw } from 'vue'
    import { router } from '@inertiajs/vue3'
    import DashboardLayout from '@/Layouts/DashboardLayout.vue'
    import { Notify } from 'quasar'

    defineOptions({
        name: 'ListUser',
    })

    const props = defineProps({
        rows: Array
    })

    const tableRef = ref()
    const selected = ref([])
    const initPaginate = ref({page: 1})
    const filter = ref()

    const columns = [
        {
            label: 'Id',
            name: 'id',
            field: 'id',
            align: 'center',
            headerStyle: 'font-weight: 505; font-size: 12px;',
            sortable: true,
        },
        {
            label: 'Имя',
            name: 'name',
            field: 'name',
            align: 'center',
            headerStyle: 'font-weight: 505; font-size: 12px;',
            sortable: true,
        },
        {
            label: 'Почта',
            name: 'email',
            field: 'email',
            align: 'center',
            headerStyle: 'font-weight: 505; font-size: 12px;',
            sortable: true,
        },
        {
            label: 'Проверка',
            name: 'email_verified_at',
            field: 'email_verified_at',
            align: 'center',
            headerStyle: 'font-weight: 505; font-size: 12px;',
            sortable: true,
        },
        {
            label: 'Создан',
            name: 'createdAt',
            field: 'created_at',
            align: 'center',
            headerStyle: 'font-weight: 505; font-size: 12px;',
            sortable: true,
        },
        {
            label: 'Изменен',
            name: 'updateAt',
            field: 'updated_at',
            align: 'center',
            headerStyle: 'font-weight: 505; font-size: 12px;',
            sortable: true,
        },
    ]

    const onEdit = () => {
        let selectObj = toRaw(selected.value)

        if (! selectObj.length) {
            Notify.create({
                type: 'negative',
                message: 'Небходимо выбрать пользователя',
                position: 'top'
            })

            return
        }

        router.visit(route('dashboard.users.edit', { user: selectObj[0].id }), { method: 'get'})
    }

    const onCreate = () => router.visit(route('dashboard.users.create'), { method: 'get'})

    const onDestroy = () => {
        let selectObj = toRaw(selected.value)

            if (! selectObj.length) {
                Notify.create({
                    type: 'negative',
                    message: 'Небходимо выбрать пользователя',
                    position: 'top'
                })

                return
            }

        router.visit(route('dashboard.users.destroy', { user: selectObj[0].id }), { method: 'delete'})
    }

    const onProba = () => {
        let id = 31

        console.log(props.rows)
        console.log(props.rows.length)
        console.log(props.rows[30])

        for (let i = 0; i < props.rows.length; i++) {
            if (props.rows[i].id == id) {
                selected.value = [ props.rows[i] ]        
            }
        }
    }
</script>

<template>
    <dashboard-layout>
        <q-table
            flat bordered
            ref="tableRef"
            dense
            :rows="rows"
            :columns="columns"
            row-key="id"
            :pagination="initPaginate"
            :rows-per-page-options="[20,10,0]"
            rows-per-page-label="Записей на странице"
            selection="single"
            :filter="filter"
            v-model:selected="selected"
            class="text-gries bg-mutan"
        >
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="filter" placeholder="Поиск">
                    <template v-slot:append>
                        <q-icon name="fa-solid fa-magnifying-glass" />
                    </template>
                </q-input>
            </template>
            <template v-slot:top-left>
                <q-btn flat no-caps label="Создать" @click.stop.prevent="onCreate" />
                <q-btn flat no-caps label="Изменить" @click.stop.prevent="onEdit"/>
                <q-btn flat no-caps color="dbrem" label="Удалить" @click.stop.prevent="onDestroy" />
                <q-btn flat no-caps label="Проба" @click.stop.prevent="onProba" />
            </template>
        </q-table>
    </dashboard-layout>
</template>


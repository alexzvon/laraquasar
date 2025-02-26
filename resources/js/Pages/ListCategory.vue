<script setup>
	import { Link } from '@inertiajs/vue3'
	// import { toRaw } from 'vue'
	import CommonLayout from '@/Layouts/CommonLayout.vue'

  defineOptions({
    name: 'ListCategory'
  })

	const props = defineProps({
    catalog: Object,
    chapter: Object,
		categories: Array,
	})

  // console.log('ListCategory')
  // console.log(toRaw(props.catalog))
  // console.log(toRaw(props.chapter))
  // console.log(toRaw(props.categories))

</script>

<template>
	<CommonLayout>
		<div class="q-pa-md q-gutter-sm">
			<q-breadcrumbs class="text-gries text-caption">
				<div class="q-breadcrumbs__separator">/</div>
				<Link href="/">
						<q-breadcrumbs-el label="Главная страница" icon="fa-solid fa-house" />
				</Link>
				<div class="q-breadcrumbs__separator">/</div>
				<Link href="/catalog">
						<q-breadcrumbs-el label="Каталог" icon="fa-solid fa-table-list" />
				</Link>
        <div class="q-breadcrumbs__separator">/</div>
				<Link :href="'/catalog/' + catalog.slug">
						<q-breadcrumbs-el :label="catalog.title" icon="fa-solid fa-list" />
				</Link>
        <div class="q-breadcrumbs__separator">/</div>
				<Link :href="'/catalog/' + catalog.slug+ '/' + chapter.slug">
						<q-breadcrumbs-el :label="chapter.title" icon="fa-solid fa-table-columns" />
				</Link>
			</q-breadcrumbs>
		</div>

		<!--
    <q-banner inline-actions class="text-gried">
      {{ catalog.title }}
    </q-banner>
		-->
    
		<div class="row items-start justify-between">
			<q-intersection v-for="category in categories" :key="category.id" transition="scale" class="inter-section">
				<Link :href="'/catalog/' + catalog.slug + '/' + chapter.slug + '/' + category.slug">
					<q-card class="q-ma-none q-mb-md card-catalog">
						<q-card-section class="card-img__catalog no-border q-pa-xs">
							<img :src="category.image">
						</q-card-section>
						<q-card-section>
							<div class="text-h6">{{ category.title }}</div>
							<div class="text-subtitle2">{{ category.slug }}</div>
						</q-card-section>
						<q-card-section class="q-pt-none">
							Описание
						</q-card-section>
					</q-card>
				</Link>
			</q-intersection>
		</div>
	</CommonLayout>
</template>

<style lang="sass" scoped>
.inter-section
	height: 410px
	width: 270px
.card-catalog
	width: 270px
	height: 394px
	overflow: hidden
.card-img__catalog
	width: 100%
	height: 270px
	img
		object-fit: cover
		width: 100%
		height: 100%
</style>

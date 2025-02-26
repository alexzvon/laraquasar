<script setup>
	import { Link } from '@inertiajs/vue3'
	// import { toRaw } from 'vue'
	import CommonLayout from '@/Layouts/CommonLayout.vue'

  defineOptions({
    name: 'ListChapter'
  })

	const props = defineProps({
    catalog: Object,
		chapters: Array,
	})

  // console.log('ListChapter')
  // console.log(toRaw(props.catalog))

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
			</q-breadcrumbs>
		</div>

		<!--
    <q-banner inline-actions class="text-gried">
      {{ catalog.title }}
    </q-banner>
		-->
    
		<div class="row items-start justify-between">
			<q-intersection v-for="chapter in chapters" :key="chapter.id" transition="scale" class="inter-section">
				<Link :href="'/catalog/' + catalog.slug + '/' + chapter.slug">
					<q-card class="q-ma-none q-mb-md card-catalog">
						<q-card-section class="card-img__catalog no-border q-pa-xs">
							<img :src="chapter.image">
						</q-card-section>
						<q-card-section>
							<div class="text-h6">{{ chapter.title }}</div>
							<div class="text-subtitle2">{{ chapter.slug }}</div>
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

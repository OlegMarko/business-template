<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';

defineProps({
    aboutContent: { type: String, default: '' },
});
const page = usePage();
const t = page.props.translations || {};
</script>

<template>
    <AppLayout>
        <section class="bg-primary-50/20 py-16 sm:py-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        {{ t.about?.title ?? 'About us' }}
                    </h1>
                    <div
                        v-if="aboutContent"
                        class="rich-content about-content mt-6"
                        v-html="aboutContent"
                    />
                    <p v-else class="mt-6 text-lg leading-relaxed text-slate-600">
                        {{ t.about?.placeholder ?? 'Content can be edited in the admin panel (Site content → About).' }}
                    </p>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

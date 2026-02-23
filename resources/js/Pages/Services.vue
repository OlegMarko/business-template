<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    servicesIntro: { type: String, default: '' },
    services: { type: Array, default: () => [] },
});
</script>

<template>
    <AppLayout>
        <section class="bg-primary-50/20 py-16 sm:py-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        Our services
                    </h1>
                    <div
                        class="mt-6 text-lg text-slate-600 [&_p]:my-2 [&_a]:text-primary-600 [&_a]:underline"
                        v-html="servicesIntro"
                    />
                </div>

                <div class="mt-16 space-y-12">
                    <article
                        v-for="(service, index) in services"
                        :key="service.id ?? index"
                        class="flex flex-col gap-6 rounded-2xl border border-primary-200/60 bg-primary-50/30 p-8 sm:flex-row sm:items-start sm:gap-8"
                    >
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold text-slate-900">{{ service.title }}</h2>
                            <p class="mt-3 text-slate-600">{{ service.description }}</p>
                        </div>
                    </article>
                </div>

                <div class="mt-16 rounded-2xl border border-primary-200/60 bg-primary-800 p-8 text-center text-white sm:p-12">
                    <h2 class="text-xl font-semibold sm:text-2xl">Ready to get started?</h2>
                    <p class="mt-3 text-primary-200">Tell us about your needs and we'll propose a tailored approach.</p>
                    <Link
                        href="/contact"
                        class="mt-6 inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-sm font-semibold text-primary-800 shadow-sm transition hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary-800"
                    >
                        Contact us
                    </Link>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

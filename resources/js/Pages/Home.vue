<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    heroTitle: { type: String, default: 'Professional services for businesses across Europe' },
    heroDescription: { type: String, default: 'We help companies grow with tailored solutions, local expertise, and a commitment to quality and compliance across the EU.' },
    heroImage: { type: String, default: null },
    homeBlocks: { type: Array, default: () => [] },
});

const heroImageSrc = computed(() => props.heroImage || '/images/hero-truck.png');
</script>

<template>
    <AppLayout>
        <section class="relative min-h-[70vh] w-full">
            <img
                :src="heroImageSrc"
                alt="Our fleet — priority freight and logistics across Europe"
                class="absolute inset-0 h-full w-full object-cover object-center"
            />
            <div class="absolute inset-0 bg-slate-900/40" aria-hidden="true" />
            <div class="relative z-10 flex min-h-[70vh] items-center">
                <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                    <div class="max-w-2xl">
                        <h1 class="text-4xl font-bold tracking-tight text-white drop-shadow-sm sm:text-5xl">
                            {{ heroTitle }}
                        </h1>
                        <div
                            class="mt-6 text-lg text-white/95 drop-shadow-sm [&_p]:my-2 [&_a]:underline [&_a]:decoration-white/70"
                            v-html="heroDescription"
                        />
                        <div class="mt-10 flex flex-wrap gap-4">
                            <Link
                                href="/services"
                                class="inline-flex items-center justify-center rounded-lg bg-primary px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 focus:ring-offset-slate-900/50"
                            >
                                Our services
                            </Link>
                            <Link
                                href="/contact"
                                class="inline-flex items-center justify-center rounded-lg border-2 border-white bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-slate-900/50"
                            >
                                Get in touch
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="border-t border-primary-200/60 bg-white py-16 sm:py-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-center text-2xl font-semibold text-slate-900 sm:text-3xl">
                    Why work with us
                </h2>
                <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="(block, index) in homeBlocks"
                        :key="index"
                        class="rounded-xl border border-primary-200/60 bg-primary-50/30 p-6"
                        :class="{ 'sm:col-span-2 lg:col-span-1': index === 2 && homeBlocks.length === 3 }"
                    >
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0h.5a2.5 2.5 0 002.5-2.5V3.935M12 12a2 2 0 104 0 2 2 0 00-4 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-slate-900">{{ block.title }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ block.description }}</p>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

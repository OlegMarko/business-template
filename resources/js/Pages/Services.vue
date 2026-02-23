<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout>
        <section class="bg-primary-50/20 py-16 sm:py-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        Our services
                    </h1>
                    <p class="mt-6 text-lg text-slate-600">
                        We offer a range of professional services designed for businesses operating in the European Union. 
                        Each service is delivered with attention to local requirements and EU-wide standards.
                    </p>
                </div>

                <div class="mt-16 space-y-12">
                    <article class="flex flex-col gap-6 rounded-2xl border border-primary-200/60 bg-primary-50/30 p-8 sm:flex-row sm:items-start sm:gap-8">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold text-slate-900">Consulting & strategy</h2>
                            <p class="mt-3 text-slate-600">
                                Strategic advice tailored to your market and goals. We help you navigate regulation, market entry, 
                                and growth across the EU with practical, actionable plans.
                            </p>
                        </div>
                    </article>

                    <article class="flex flex-col gap-6 rounded-2xl border border-primary-200/60 bg-primary-50/30 p-8 sm:flex-row sm:items-start sm:gap-8">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold text-slate-900">Compliance & governance</h2>
                            <p class="mt-3 text-slate-600">
                                Support with GDPR, sector-specific rules, and corporate governance. We help you stay compliant 
                                and reduce risk while operating across multiple jurisdictions.
                            </p>
                        </div>
                    </article>

                    <article class="flex flex-col gap-6 rounded-2xl border border-primary-200/60 bg-primary-50/30 p-8 sm:flex-row sm:items-start sm:gap-8">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold text-slate-900">Training & development</h2>
                            <p class="mt-3 text-slate-600">
                                Workshops and training programmes for your team on compliance, processes, and best practices. 
                                Delivered in English and adaptable to your organisation’s needs.
                            </p>
                        </div>
                    </article>
                </div>

                <div class="mt-16 rounded-2xl border border-primary-200/60 bg-primary-800 p-8 text-center text-white sm:p-12">
                    <h2 class="text-xl font-semibold sm:text-2xl">Ready to get started?</h2>
                    <p class="mt-3 text-primary-200">Tell us about your needs and we’ll propose a tailored approach.</p>
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

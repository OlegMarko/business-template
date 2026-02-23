<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout>
        <section class="bg-primary-50/20 py-16 sm:py-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        About us
                    </h1>
                    <p class="mt-6 text-lg leading-relaxed text-slate-600">
                        We are a European business services company built on integrity, expertise, and long-term partnerships. 
                        Our team works with organisations across the EU to deliver solutions that meet local and regional requirements 
                        while maintaining the highest standards of quality and compliance.
                    </p>
                    <p class="mt-4 text-lg leading-relaxed text-slate-600">
                        Founded with a focus on the single market, we understand the opportunities and obligations of operating 
                        across member states. Whether you are expanding into new countries or strengthening your current operations, 
                        we are here to support your growth with clear advice and practical execution.
                    </p>
                </div>

                <div class="mt-16 border-t border-primary-200/60 pt-16">
                    <h2 class="text-2xl font-semibold text-slate-900">Our values</h2>
                    <ul class="mt-8 space-y-6 sm:grid sm:grid-cols-2 sm:gap-8 sm:space-y-0">
                        <li class="flex gap-4">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-100 text-primary-800 font-medium">1</span>
                            <div>
                                <h3 class="font-semibold text-slate-900">Transparency</h3>
                                <p class="mt-1 text-sm text-slate-600">We communicate openly and set clear expectations with every client.</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-100 text-primary-800 font-medium">2</span>
                            <div>
                                <h3 class="font-semibold text-slate-900">Excellence</h3>
                                <p class="mt-1 text-sm text-slate-600">We aim for the highest quality in delivery and client experience.</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-100 text-primary-800 font-medium">3</span>
                            <div>
                                <h3 class="font-semibold text-slate-900">Integrity</h3>
                                <p class="mt-1 text-sm text-slate-600">We act ethically and in line with EU regulations and best practices.</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-100 text-primary-800 font-medium">4</span>
                            <div>
                                <h3 class="font-semibold text-slate-900">Partnership</h3>
                                <p class="mt-1 text-sm text-slate-600">We build lasting relationships and grow together with our clients.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

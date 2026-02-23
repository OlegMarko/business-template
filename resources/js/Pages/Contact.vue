<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    company: '',
    subject: '',
    message: '',
});
</script>

<template>
    <AppLayout>
        <section class="bg-primary-50/20 py-16 sm:py-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl">
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        Contact us
                    </h1>
                    <p class="mt-6 text-lg text-slate-600">
                        Get in touch for a no-obligation conversation. We typically respond within one business day 
                        and will treat your information in line with our privacy policy.
                    </p>

                    <form
                        class="mt-10 space-y-6"
                        @submit.prevent="form.post('/contact', { preserveScroll: true })"
                    >
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    required
                                    autocomplete="name"
                                    class="mt-1 block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-900 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"
                                    :class="{ 'border-red-500': form.errors.name }"
                                />
                                <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    required
                                    autocomplete="email"
                                    class="mt-1 block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-900 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"
                                    :class="{ 'border-red-500': form.errors.email }"
                                />
                                <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                            </div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="company" class="block text-sm font-medium text-slate-700">Company (optional)</label>
                                <input
                                    id="company"
                                    v-model="form.company"
                                    type="text"
                                    autocomplete="organization"
                                    class="mt-1 block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-900 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"
                                />
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-slate-700">Subject</label>
                                <select
                                    id="subject"
                                    v-model="form.subject"
                                    required
                                    class="mt-1 block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-900 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"
                                    :class="{ 'border-red-500': form.errors.subject }"
                                >
                                    <option value="">Select...</option>
                                    <option value="general">General enquiry</option>
                                    <option value="services">Services</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="other">Other</option>
                                </select>
                                <p v-if="form.errors.subject" class="mt-1 text-sm text-red-600">{{ form.errors.subject }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-700">Message</label>
                            <textarea
                                id="message"
                                v-model="form.message"
                                rows="5"
                                required
                                class="mt-1 block w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-900 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"
                                :class="{ 'border-red-500': form.errors.message }"
                                placeholder="How can we help?"
                            />
                            <p v-if="form.errors.message" class="mt-1 text-sm text-red-600">{{ form.errors.message }}</p>
                        </div>

                        <p class="text-xs text-slate-500">
                            By submitting this form you agree to our use of your data to respond to your enquiry. 
                            We do not use your information for marketing without your consent. See our <Link href="/privacy" class="font-medium text-primary-600 underline hover:text-primary-700">privacy policy</Link> for details.
                        </p>

                        <div class="flex items-center gap-4">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="inline-flex items-center justify-center rounded-lg bg-primary px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-70"
                            >
                                {{ form.processing ? 'Sending...' : 'Send message' }}
                            </button>
                            <span v-if="form.recentlySuccessful || $page.props.flash?.success" class="text-sm text-green-600">Message sent successfully.</span>
                        </div>
                    </form>

                    <div class="mt-16 border-t border-primary-200/60 pt-10">
                        <h2 class="text-lg font-semibold text-slate-900">Other ways to reach us</h2>
                        <p class="mt-3 text-slate-600">
                            For general enquiries you can also email us at the address listed in the footer. 
                            We serve clients across the European Union and respond in English by default.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

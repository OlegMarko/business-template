<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';

defineProps({
    posts: { type: Array, required: true },
});
const page = usePage();
const t = page.props.translations?.blog || {};
</script>

<template>
    <AppLayout>
        <section class="bg-primary-50/20 py-16 sm:py-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                    {{ t.title ?? 'Blog' }}
                </h1>
                <p class="mt-4 text-lg text-slate-600">
                    {{ t.intro ?? 'News and updates.' }}
                </p>

                <ul class="mt-12 space-y-8 border-t border-primary-200/60 pt-12">
                    <li
                        v-for="post in posts"
                        :key="post.id"
                        class="rounded-2xl border border-primary-200/60 bg-white p-6 shadow-sm transition hover:shadow-md sm:p-8"
                    >
                        <Link :href="`/blog/${post.slug}`" class="block group">
                            <h2 class="text-xl font-semibold text-slate-900 group-hover:text-primary-700 sm:text-2xl">
                                {{ post.title }}
                            </h2>
                            <time :datetime="post.published_at" class="mt-2 block text-sm text-slate-500">
                                {{ new Date(post.published_at).toLocaleDateString(undefined, { dateStyle: 'long' }) }}
                            </time>
                            <p class="mt-3 text-slate-600 line-clamp-2">
                                {{ post.excerpt }}
                            </p>
                            <span class="mt-3 inline-block text-sm font-medium text-primary-600 group-hover:underline">
                                {{ t.read_more ?? 'Read more' }} →
                            </span>
                        </Link>
                    </li>
                </ul>
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    post: { type: Object, required: true },
});
const page = usePage();
const t = page.props.translations?.blog || {};

const pageTitle = computed(() => props.post.meta_title || props.post.title);
const pageDescription = computed(() => props.post.meta_description || null);
const ogImageUrl = computed(() => props.post.og_image_url || null);
const canonicalUrl = computed(() => props.post.canonical_url || '');
</script>

<template>
    <Head>
        <title>{{ pageTitle }}</title>
        <meta v-if="pageDescription" name="description" :content="pageDescription">
        <meta property="og:type" content="article">
        <meta property="og:title" :content="pageTitle">
        <meta v-if="pageDescription" property="og:description" :content="pageDescription">
        <meta v-if="ogImageUrl" property="og:image" :content="ogImageUrl">
        <meta v-if="canonicalUrl" property="og:url" :content="canonicalUrl">
        <link v-if="canonicalUrl" rel="canonical" :href="canonicalUrl">
        <meta name="twitter:card" :content="ogImageUrl ? 'summary_large_image' : 'summary'">
        <meta name="twitter:title" :content="pageTitle">
        <meta v-if="pageDescription" name="twitter:description" :content="pageDescription">
        <meta v-if="ogImageUrl" name="twitter:image" :content="ogImageUrl">
    </Head>
    <AppLayout>
        <article class="bg-primary-50/20 py-16 sm:py-24">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <Link
                    href="/blog"
                    class="text-sm font-medium text-primary-600 hover:text-primary-700 hover:underline"
                >
                    ← {{ t.back ?? 'Back to blog' }}
                </Link>
                <header class="mt-6">
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        {{ post.title }}
                    </h1>
                    <time :datetime="post.published_at" class="mt-3 block text-slate-500">
                        {{ new Date(post.published_at).toLocaleDateString(undefined, { dateStyle: 'long' }) }}
                    </time>
                </header>
                <div
                    class="rich-content blog-content mt-8"
                    v-html="post.content"
                />
            </div>
        </article>
    </AppLayout>
</template>

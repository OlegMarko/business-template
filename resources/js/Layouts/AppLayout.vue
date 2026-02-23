<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const navLinks = [
    { href: '/', label: 'Home' },
    { href: '/about', label: 'About' },
    { href: '/services', label: 'Services' },
    { href: '/contact', label: 'Contact' },
];
</script>

<template>
    <div class="min-h-screen flex flex-col bg-primary-50/30 text-slate-900">
        <header class="sticky top-0 z-50 border-b border-primary-200/60 bg-white/95 backdrop-blur-md">
            <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <Link href="/" class="text-xl font-semibold tracking-tight text-primary-700 transition hover:text-primary-600">
                    {{ $page.props.app?.name || 'Business' }}
                </Link>
                <nav class="flex items-center gap-1 sm:gap-2" aria-label="Main navigation">
                    <template v-for="link in navLinks" :key="link.href">
                        <Link
                            :href="link.href"
                            class="rounded-lg px-3 py-2 text-sm font-medium transition-colors"
                            :class="page.url === link.href || (link.href !== '/' && page.url.startsWith(link.href))
                                ? 'bg-primary-100 text-primary-800'
                                : 'text-slate-600 hover:bg-primary-50 hover:text-primary-700'"
                        >
                            {{ link.label }}
                        </Link>
                    </template>
                </nav>
            </div>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer class="border-t border-primary-200/60 bg-white">
            <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                    <p class="text-sm text-slate-500">
                        &copy; {{ new Date().getFullYear() }} {{ $page.props.app?.name || 'Business' }}. All rights reserved.
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-6 text-sm text-slate-500 sm:justify-end">
                        <Link href="/about" class="transition hover:text-primary-600">About</Link>
                        <Link href="/services" class="transition hover:text-primary-600">Services</Link>
                        <Link href="/contact" class="transition hover:text-primary-600">Contact</Link>
                        <Link href="/privacy" class="transition hover:text-primary-600">Privacy Policy</Link>
                    </div>
                </div>
                <p class="mt-4 text-center text-xs text-slate-400">
                    Operating in the European Union. We respect your privacy and comply with applicable data protection regulations.
                </p>
            </div>
        </footer>
    </div>
</template>

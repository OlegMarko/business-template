<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';

defineProps({
    privacyContent: { type: String, default: '' },
});
const page = usePage();
const t = page.props.translations?.privacy || {};
const appName = page.props.app?.name || 'Business';
</script>

<template>
    <AppLayout>
        <section class="bg-primary-50/20 py-16 sm:py-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                        {{ t.title ?? 'Privacy Policy' }}
                    </h1>
                    <div
                        v-if="privacyContent"
                        class="rich-content privacy-content mt-6 space-y-12 text-slate-600"
                        v-html="privacyContent"
                    />
                    <template v-else>
                        <p class="mt-6 text-lg leading-relaxed text-slate-600">
                            {{ t.fallback_intro ?? 'This privacy policy explains how we collect, use, and protect your personal data when you use our website and services. We operate in the European Union and comply with the General Data Protection Regulation (GDPR) and applicable data protection laws.' }}
                        </p>
                        <div class="mt-16 space-y-12">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ t.section1_title ?? '1. Data controller' }}</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ (t.section1_text ?? 'The data controller responsible for your personal data is :name. If you have questions about this policy or your data, you can contact us using the details on our Contact page.').replace(':name', appName) }}
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ t.section2_title ?? '2. What data we collect' }}</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ t.section2_intro ?? 'We may collect and process the following types of data:' }}
                        </p>
                        <ul class="mt-4 list-disc space-y-2 pl-6 text-slate-600">
                            <li><strong class="text-slate-700">{{ t.section2_contact ?? 'Contact and identity data:' }}</strong> {{ t.section2_contact_desc ?? 'name, email address, company name, and any message or enquiry you send us via our contact form.' }}</li>
                            <li><strong class="text-slate-700">{{ t.section2_technical ?? 'Technical data:' }}</strong> {{ t.section2_technical_desc ?? 'IP address, browser type, device information, and similar data when you visit our website (e.g. for security and analytics).' }}</li>
                            <li><strong class="text-slate-700">{{ t.section2_usage ?? 'Usage data:' }}</strong> {{ t.section2_usage_desc ?? 'how you use our website, such as pages visited and time spent, where we use cookies or similar technologies in line with your preferences.' }}</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ t.section3_title ?? '3. How we use your data' }}</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ t.section3_intro ?? 'We use your data only for lawful purposes, including:' }}
                        </p>
                        <ul class="mt-4 list-disc space-y-2 pl-6 text-slate-600">
                            <li>{{ t.section3_1 ?? 'Responding to your enquiries and providing the services you request.' }}</li>
                            <li>{{ t.section3_2 ?? 'Improving our website, services, and user experience.' }}</li>
                            <li>{{ t.section3_3 ?? 'Complying with legal obligations and protecting our rights.' }}</li>
                            <li>{{ t.section3_4 ?? 'Where you have given consent, sending you relevant updates or marketing (you can withdraw consent at any time).' }}</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ t.section4_title ?? '4. Legal basis' }}</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ t.section4_text ?? 'Under GDPR we process your data on the basis of: your consent (e.g. contact form, optional marketing); performance of a contract or pre-contractual steps; our legitimate interests (e.g. improving our services, security); or compliance with legal obligations.' }}
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ t.section5_title ?? '5. Data retention' }}</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ t.section5_text ?? 'We keep your data only for as long as necessary for the purposes described above or as required by law. Enquiry data is typically retained for a limited period after we have responded. You can ask us to delete your data earlier where there is no overriding legal or legitimate need to retain it.' }}
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ t.section6_title ?? '6. Your rights' }}</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ t.section6_intro ?? 'Under GDPR you have the right to:' }}
                        </p>
                        <ul class="mt-4 list-disc space-y-2 pl-6 text-slate-600">
                            <li>{{ t.section6_1 ?? 'Access the personal data we hold about you.' }}</li>
                            <li>{{ t.section6_2 ?? 'Request correction of inaccurate or incomplete data.' }}</li>
                            <li>{{ t.section6_3 ?? 'Request erasure of your data in certain circumstances.' }}</li>
                            <li>{{ t.section6_4 ?? 'Object to or restrict certain processing.' }}</li>
                            <li>{{ t.section6_5 ?? 'Data portability, where applicable.' }}</li>
                            <li>{{ t.section6_6 ?? 'Withdraw consent at any time where processing is based on consent.' }}</li>
                            <li>{{ t.section6_7 ?? 'Lodge a complaint with a supervisory authority in your country.' }}</li>
                        </ul>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ t.section6_outro ?? 'To exercise these rights, please contact us using the details on our Contact page.' }}
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ t.section7_title ?? '7. Sharing and transfers' }}</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ t.section7_text ?? 'We do not sell your personal data. We may share it with trusted service providers (e.g. hosting, email) who act on our instructions and are bound by appropriate safeguards. If we transfer data outside the EU/EEA, we ensure adequate protection (e.g. standard contractual clauses or approved mechanisms).' }}
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ t.section8_title ?? '8. Security' }}</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ t.section8_text ?? 'We take appropriate technical and organisational measures to protect your data against unauthorised access, loss, or misuse. No method of transmission over the internet is completely secure; we encourage you to use secure channels when sending sensitive information.' }}
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ t.section9_title ?? '9. Changes to this policy' }}</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            {{ t.section9_text ?? 'We may update this privacy policy from time to time. The current version will always be available on this page, with the date of the last update. We encourage you to review it periodically.' }}
                        </p>
                    </div>

                    <div class="border-t border-primary-200/60 pt-10">
                        <p class="text-slate-600">
                            <template v-if="t.contact_question">
                                <span v-for="(part, i) in (t.contact_question || '').split(':link')" :key="i">
                                    {{ part }}
                                    <Link v-if="i === 0" href="/contact" class="font-medium text-primary-600 underline hover:text-primary-700">{{ t.contact_link ?? 'contact us' }}</Link>
                                </span>
                            </template>
                            <template v-else>
                                If you have any questions about this privacy policy or your personal data, please 
                                <Link href="/contact" class="font-medium text-primary-600 underline hover:text-primary-700">contact us</Link>.
                            </template>
                        </p>
                    </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

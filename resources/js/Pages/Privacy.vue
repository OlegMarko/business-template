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
                        Privacy Policy
                    </h1>
                    <p class="mt-6 text-lg leading-relaxed text-slate-600">
                        This privacy policy explains how we collect, use, and protect your personal data when you use our website and services. 
                        We operate in the European Union and comply with the General Data Protection Regulation (GDPR) and applicable data protection laws.
                    </p>
                </div>

                <div class="mt-16 space-y-12">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">1. Data controller</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            The data controller responsible for your personal data is {{ $page.props.app?.name || 'Business' }}. 
                            If you have questions about this policy or your data, you can contact us using the details on our Contact page.
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">2. What data we collect</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            We may collect and process the following types of data:
                        </p>
                        <ul class="mt-4 list-disc space-y-2 pl-6 text-slate-600">
                            <li><strong class="text-slate-700">Contact and identity data:</strong> name, email address, company name, and any message or enquiry you send us via our contact form.</li>
                            <li><strong class="text-slate-700">Technical data:</strong> IP address, browser type, device information, and similar data when you visit our website (e.g. for security and analytics).</li>
                            <li><strong class="text-slate-700">Usage data:</strong> how you use our website, such as pages visited and time spent, where we use cookies or similar technologies in line with your preferences.</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">3. How we use your data</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            We use your data only for lawful purposes, including:
                        </p>
                        <ul class="mt-4 list-disc space-y-2 pl-6 text-slate-600">
                            <li>Responding to your enquiries and providing the services you request.</li>
                            <li>Improving our website, services, and user experience.</li>
                            <li>Complying with legal obligations and protecting our rights.</li>
                            <li>Where you have given consent, sending you relevant updates or marketing (you can withdraw consent at any time).</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">4. Legal basis</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            Under GDPR we process your data on the basis of: your consent (e.g. contact form, optional marketing); 
                            performance of a contract or pre-contractual steps; our legitimate interests (e.g. improving our services, security); 
                            or compliance with legal obligations.
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">5. Data retention</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            We keep your data only for as long as necessary for the purposes described above or as required by law. 
                            Enquiry data is typically retained for a limited period after we have responded. 
                            You can ask us to delete your data earlier where there is no overriding legal or legitimate need to retain it.
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">6. Your rights</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            Under GDPR you have the right to:
                        </p>
                        <ul class="mt-4 list-disc space-y-2 pl-6 text-slate-600">
                            <li>Access the personal data we hold about you.</li>
                            <li>Request correction of inaccurate or incomplete data.</li>
                            <li>Request erasure of your data in certain circumstances.</li>
                            <li>Object to or restrict certain processing.</li>
                            <li>Data portability, where applicable.</li>
                            <li>Withdraw consent at any time where processing is based on consent.</li>
                            <li>Lodge a complaint with a supervisory authority in your country.</li>
                        </ul>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            To exercise these rights, please contact us using the details on our Contact page.
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">7. Sharing and transfers</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            We do not sell your personal data. We may share it with trusted service providers (e.g. hosting, email) 
                            who act on our instructions and are bound by appropriate safeguards. If we transfer data outside the EU/EEA, 
                            we ensure adequate protection (e.g. standard contractual clauses or approved mechanisms).
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">8. Security</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            We take appropriate technical and organisational measures to protect your data against unauthorised access, 
                            loss, or misuse. No method of transmission over the internet is completely secure; we encourage you to use 
                            secure channels when sending sensitive information.
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">9. Changes to this policy</h2>
                        <p class="mt-4 text-slate-600 leading-relaxed">
                            We may update this privacy policy from time to time. The current version will always be available on this page, 
                            with the date of the last update. We encourage you to review it periodically.
                        </p>
                    </div>

                    <div class="border-t border-primary-200/60 pt-10">
                        <p class="text-slate-600">
                            If you have any questions about this privacy policy or your personal data, please 
                            <Link href="/contact" class="font-medium text-primary-600 underline hover:text-primary-700">contact us</Link>.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

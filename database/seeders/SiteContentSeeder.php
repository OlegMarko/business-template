<?php

namespace Database\Seeders;

use App\Models\HomeBlock;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => config('app.name', 'Business'),
            'primary_color' => '#0d9488',
            'hero_image' => '',
            'home_hero_title' => 'Professional services for businesses across Europe',
            'home_hero_description' => 'We help companies grow with tailored solutions, local expertise, and a commitment to quality and compliance across the EU.',
            'about_content' => <<<'HTML'
<p class="mt-6 text-lg leading-relaxed text-slate-600">We are a European business services company built on integrity, expertise, and long-term partnerships. Our team works with organisations across the EU to deliver solutions that meet local and regional requirements while maintaining the highest standards of quality and compliance.</p>
<p class="mt-4 text-lg leading-relaxed text-slate-600">Founded with a focus on the single market, we understand the opportunities and obligations of operating across member states. Whether you are expanding into new countries or strengthening your current operations, we are here to support your growth with clear advice and practical execution.</p>
<h2 class="mt-16 border-t border-primary-200/60 pt-16 text-2xl font-semibold text-slate-900">Our values</h2>
<ul class="mt-8 space-y-6 sm:grid sm:grid-cols-2 sm:gap-8 sm:space-y-0">
<li class="flex gap-4"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-100 text-primary-800 font-medium">1</span><div><h3 class="font-semibold text-slate-900">Transparency</h3><p class="mt-1 text-sm text-slate-600">We communicate openly and set clear expectations with every client.</p></div></li>
<li class="flex gap-4"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-100 text-primary-800 font-medium">2</span><div><h3 class="font-semibold text-slate-900">Excellence</h3><p class="mt-1 text-sm text-slate-600">We aim for the highest quality in delivery and client experience.</p></div></li>
<li class="flex gap-4"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-100 text-primary-800 font-medium">3</span><div><h3 class="font-semibold text-slate-900">Integrity</h3><p class="mt-1 text-sm text-slate-600">We act ethically and in line with EU regulations and best practices.</p></div></li>
<li class="flex gap-4"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-100 text-primary-800 font-medium">4</span><div><h3 class="font-semibold text-slate-900">Partnership</h3><p class="mt-1 text-sm text-slate-600">We build lasting relationships and grow together with our clients.</p></div></li>
</ul>
HTML,
            'services_intro' => 'We offer a range of professional services designed for businesses operating in the European Union. Each service is delivered with attention to local requirements and EU-wide standards.',
            'privacy_content' => null, // will use default in view if empty
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, (string) $value);
        }

        $homeBlocks = [
            ['title' => 'EU-wide coverage', 'description' => 'We operate across the European Union with local knowledge and regulatory awareness.', 'sort_order' => 0],
            ['title' => 'Compliant & secure', 'description' => 'Our processes align with GDPR and EU standards so you can focus on your business.', 'sort_order' => 1],
            ['title' => 'Results-driven', 'description' => 'We deliver measurable outcomes and clear communication at every step.', 'sort_order' => 2],
        ];

        foreach ($homeBlocks as $block) {
            HomeBlock::firstOrCreate(
                ['title' => $block['title']],
                ['description' => $block['description'], 'sort_order' => $block['sort_order']]
            );
        }

        $services = [
            ['title' => 'Consulting & strategy', 'description' => 'Strategic advice tailored to your market and goals. We help you navigate regulation, market entry, and growth across the EU with practical, actionable plans.', 'sort_order' => 0],
            ['title' => 'Compliance & governance', 'description' => 'Support with GDPR, sector-specific rules, and corporate governance. We help you stay compliant and reduce risk while operating across multiple jurisdictions.', 'sort_order' => 1],
            ['title' => 'Training & development', 'description' => 'Workshops and training programmes for your team on compliance, processes, and best practices. Delivered in English and adaptable to your organisation\'s needs.', 'sort_order' => 2],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['title' => $service['title']],
                ['description' => $service['description'], 'sort_order' => $service['sort_order']]
            );
        }
    }
}

<?php

namespace App\Support;

use Illuminate\Support\Str;

class TemplateCatalog
{
    public static function all(): array
    {
        return array_map(fn (array $template) => self::hydrate($template), self::raw());
    }

    public static function find(string $slug): ?array
    {
        foreach (self::raw() as $template) {
            if ($template['slug'] === $slug) {
                return self::hydrate($template);
            }
        }

        return null;
    }

    protected static function hydrate(array $template): array
    {
        $template['blocks'] = array_map(
            fn (array $block) => array_merge(['id' => (string) Str::uuid()], $block),
            $template['blocks']
        );

        return $template;
    }

    protected static function block(string $type, array $data = []): array
    {
        return ['type' => $type, 'data' => $data];
    }

    protected static function raw(): array
    {
        return [
            [
                'slug' => 'developer-portfolio',
                'name' => 'Developer Portfolio',
                'category' => 'Personal',
                'description' => 'A clean, code-forward layout for showcasing projects, repos, and a way to get in touch.',
                'previewColor' => '#4f46e5',
                'profileName' => '@dev.codes',
                'profileBio' => 'Full-stack engineer building useful things on the web.',
                'blocks' => [
                    self::block('heading', ['text' => 'Hi, I build software']),
                    self::block('button', ['label' => 'View my GitHub', 'icon' => 'link', 'variant' => 'filled']),
                    self::block('button', ['label' => 'Read my blog', 'icon' => 'link', 'variant' => 'soft']),
                    self::block('social', ['networks' => ['x-twitter', 'youtube', 'mail']]),
                ],
            ],
            [
                'slug' => 'designer-portfolio',
                'name' => 'Designer Portfolio',
                'category' => 'Creative',
                'description' => 'A visual-first page to spotlight case studies and design work.',
                'previewColor' => '#ec4899',
                'profileName' => '@studio.designs',
                'profileBio' => 'Product designer crafting premium digital experiences.',
                'blocks' => [
                    self::block('heading', ['text' => 'Selected Work']),
                    self::block('image', []),
                    self::block('button', ['label' => 'View portfolio', 'icon' => 'link', 'variant' => 'gradient']),
                    self::block('social', ['networks' => ['instagram', 'x-twitter']]),
                ],
            ],
            [
                'slug' => 'photographer',
                'name' => 'Photographer',
                'category' => 'Creative',
                'description' => 'Gallery-friendly layout to lead with imagery and booking links.',
                'previewColor' => '#0f172a',
                'profileName' => '@lens.and.light',
                'profileBio' => 'Documentary & portrait photographer. Available for bookings.',
                'blocks' => [
                    self::block('image', []),
                    self::block('image', []),
                    self::block('button', ['label' => 'Book a session', 'icon' => 'link', 'variant' => 'outline']),
                    self::block('social', ['networks' => ['instagram']]),
                ],
            ],
            [
                'slug' => 'content-creator',
                'name' => 'Content Creator',
                'category' => 'Personal',
                'description' => 'All your channels and latest drops in one scrollable page.',
                'previewColor' => '#f97316',
                'profileName' => '@creates.daily',
                'profileBio' => 'New videos every week ✦ Subscribe so you don\'t miss out.',
                'blocks' => [
                    self::block('button', ['label' => 'Latest video', 'variant' => 'filled', 'icon' => null, 'thumbnail' => true]),
                    self::block('button', ['label' => 'Watch on YouTube', 'icon' => 'youtube', 'variant' => 'soft']),
                    self::block('social', ['networks' => ['instagram', 'tiktok', 'youtube']]),
                ],
            ],
            [
                'slug' => 'gamer',
                'name' => 'Gamer',
                'category' => 'Personal',
                'description' => 'Stream schedule, socials, and highlight reels for streamers.',
                'previewColor' => '#7c3aed',
                'profileName' => '@player.one',
                'profileBio' => 'Streaming daily ✦ Come say hi in chat.',
                'blocks' => [
                    self::block('heading', ['text' => 'Live schedule']),
                    self::block('button', ['label' => 'Watch on Twitch', 'icon' => 'link', 'variant' => 'gradient']),
                    self::block('button', ['label' => 'Join Discord', 'icon' => 'link', 'variant' => 'outline']),
                    self::block('social', ['networks' => ['youtube', 'x-twitter']]),
                ],
            ],
            [
                'slug' => 'business',
                'name' => 'Business',
                'category' => 'Business',
                'description' => 'A professional hub for hours, contact details, and services.',
                'previewColor' => '#0891b2',
                'profileName' => 'Acme & Co.',
                'profileBio' => 'Trusted local service, serving the community since 2012.',
                'blocks' => [
                    self::block('heading', ['text' => 'Welcome to Acme & Co.']),
                    self::block('button', ['label' => 'Book an appointment', 'icon' => 'link', 'variant' => 'filled']),
                    self::block('contact', []),
                    self::block('divider', []),
                    self::block('social', ['networks' => ['instagram', 'mail']]),
                ],
            ],
            [
                'slug' => 'ecommerce',
                'name' => 'Ecommerce',
                'category' => 'Ecommerce',
                'description' => 'Drive traffic straight to your storefront and best sellers.',
                'previewColor' => '#16a34a',
                'profileName' => '@shop.name',
                'profileBio' => 'New drop every Friday ✦ Free shipping over $50.',
                'blocks' => [
                    self::block('image', []),
                    self::block('button', ['label' => 'Shop new arrivals', 'icon' => 'link', 'variant' => 'filled']),
                    self::block('button', ['label' => 'Best sellers', 'icon' => 'link', 'variant' => 'soft']),
                    self::block('social', ['networks' => ['instagram', 'tiktok']]),
                ],
            ],
            [
                'slug' => 'music-artist',
                'name' => 'Music Artist',
                'category' => 'Creative',
                'description' => 'Push listeners to your latest release across every platform.',
                'previewColor' => '#be185d',
                'profileName' => '@artist.name',
                'profileBio' => 'New single out now ✦ Listen everywhere.',
                'blocks' => [
                    self::block('heading', ['text' => 'New single — Out now']),
                    self::block('button', ['label' => 'Listen on Spotify', 'icon' => 'link', 'variant' => 'gradient']),
                    self::block('button', ['label' => 'Watch the video', 'variant' => 'filled', 'icon' => null, 'thumbnail' => true]),
                    self::block('social', ['networks' => ['instagram', 'youtube', 'x-twitter']]),
                ],
            ],
            [
                'slug' => 'fitness-coach',
                'name' => 'Fitness Coach',
                'category' => 'Business',
                'description' => 'Programs, booking, and transformation highlights for coaches.',
                'previewColor' => '#ea580c',
                'profileName' => '@coach.strong',
                'profileBio' => 'Certified trainer ✦ Helping you hit your goals.',
                'blocks' => [
                    self::block('heading', ['text' => 'Train with me']),
                    self::block('button', ['label' => 'Book a free consult', 'icon' => 'link', 'variant' => 'filled']),
                    self::block('button', ['label' => 'View programs', 'icon' => 'link', 'variant' => 'outline']),
                    self::block('social', ['networks' => ['instagram', 'youtube']]),
                ],
            ],
            [
                'slug' => 'student',
                'name' => 'Student',
                'category' => 'Education',
                'description' => 'A simple resume-style page for portfolios, resumes, and clubs.',
                'previewColor' => '#2563eb',
                'profileName' => '@student.name',
                'profileBio' => 'Computer Science student ✦ Open to internships.',
                'blocks' => [
                    self::block('text', ['text' => 'Aspiring engineer, class of 2027.']),
                    self::block('button', ['label' => 'View my resume', 'icon' => 'link', 'variant' => 'soft']),
                    self::block('button', ['label' => 'LinkedIn', 'icon' => 'link', 'variant' => 'outline']),
                ],
            ],
            [
                'slug' => 'beauty-creator',
                'name' => 'Beauty Creator',
                'category' => 'Personal',
                'description' => 'Tutorials, product picks, and shoppable links for beauty creators.',
                'previewColor' => '#db2777',
                'profileName' => '@glow.with.me',
                'profileBio' => 'Skincare & makeup tutorials ✦ Shop my faves below.',
                'blocks' => [
                    self::block('image', []),
                    self::block('button', ['label' => 'Shop my favorites', 'icon' => 'link', 'variant' => 'gradient']),
                    self::block('button', ['label' => 'Latest tutorial', 'variant' => 'filled', 'icon' => null, 'thumbnail' => true]),
                    self::block('social', ['networks' => ['instagram', 'tiktok', 'youtube']]),
                ],
            ],
            [
                'slug' => 'blogger',
                'name' => 'Blogger',
                'category' => 'Personal',
                'description' => 'A tidy list of recent posts, newsletter, and socials.',
                'previewColor' => '#9333ea',
                'profileName' => '@the.blog',
                'profileBio' => 'Writing about life, work, and everything in between.',
                'blocks' => [
                    self::block('heading', ['text' => 'Latest posts']),
                    self::block('button', ['label' => 'Read the latest post', 'icon' => 'link', 'variant' => 'soft']),
                    self::block('button', ['label' => 'Subscribe to newsletter', 'icon' => 'mail', 'variant' => 'outline']),
                    self::block('social', ['networks' => ['x-twitter', 'mail']]),
                ],
            ],
        ];
    }
}

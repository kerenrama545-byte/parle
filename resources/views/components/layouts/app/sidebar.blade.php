<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

    @include('partials.head')

    {{-- Livewire Styles --}}
    @livewireStyles
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    {{-- ================= SIDEBAR ================= --}}
<flux:sidebar
    sticky
    stashable
    class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900"
>

    {{-- Close Button (Mobile) --}}
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    {{-- Logo --}}
    <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
        <x-app-logo />
    </a>

    {{-- Navigation --}}
    <flux:navlist.group :heading="__('Management')" class="grid gap-1">
        <flux:navlist.item
            icon="home"
            :href="route('index.edit')"
            :current="request()->routeIs('index.*')"
            wire:navigate
        >
            {{ __('Homepage / Index') }}
        </flux:navlist.item>

        <flux:navlist.item
            icon="information-circle"
            :href="route('admin.about.edit')"
            :current="request()->routeIs('admin.about.*')"
            wire:navigate
        >
            {{ __('About Page') }}
        </flux:navlist.item>

        <flux:navlist.item
            icon="newspaper"
            :href="route('admin.blog.manager')"
            :current="request()->routeIs('admin.blog.manager')"
            wire:navigate
        >
            {{ __('Blog Management') }}
        </flux:navlist.item>
        <flux:navlist.item
    icon="star"
    :href="route('featured-menu-manager.index')"
    :current="request()->routeIs('featured-menu-manager.*')"
    wire:navigate
>
    {{ __('Featured Menu') }}
</flux:navlist.item>


        <flux:navlist.item
            icon="clipboard-document-list"
            :href="route('menu.index')"
            :current="request()->routeIs('menu.*')"
            wire:navigate
        >
            {{ __('Menu Management') }}
        </flux:navlist.item>

      <flux:navlist.item
        href="{{ route('admin.dining-page') }}"
        :active="request()->routeIs('admin.dining-page')"
        icon="home"
    >
        Dining Page
    </flux:navlist.item>

        <flux:navlist.item
            icon="magnifying-glass"
            :href="route('seo-metadata.edit')"
            :current="request()->routeIs('seo-metadata.*')"
            wire:navigate
        >
            {{ __('SEO Metadata') }}
        </flux:navlist.item>

        <flux:navlist.item
            icon="building-office"
            :href="route('company-information.edit')"
            :current="request()->routeIs('company-information.*')"
            wire:navigate
        >
            {{ __('Company Information') }}
        </flux:navlist.item>
        <flux:navlist.item
    icon="phone"
    :href="route('admin.contact-info')"
    :current="request()->routeIs('admin.contact-info')"
    wire:navigate
>
    {{ __('Contact Info') }}
</flux:navlist.item>


        {{-- Social Links --}}
       <flux:navlist.item
    icon="share"
    :href="route('admin.social-links')"
    :current="request()->routeIs('admin.social-links')"
    wire:navigate
>
    {{ __('Social Links') }}
</flux:navlist.item>

    </flux:navlist.group>

    <flux:spacer />

    {{-- Desktop User Menu --}}
    <flux:dropdown class="hidden lg:block" position="bottom" align="start">
        <flux:profile
            :name="auth()->user()->name"
            :initials="auth()->user()->initials()"
            icon:trailing="chevrons-up-down"
        />
        <flux:menu class="w-[220px]">
            <div class="px-2 py-2 text-sm flex items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                    {{ auth()->user()->initials() }}
                </span>
                <div class="flex-1 leading-tight">
                    <div class="font-semibold truncate">{{ auth()->user()->name }}</div>
                    <div class="text-xs truncate">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <flux:menu.separator />

            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                {{ __('Settings') }}
            </flux:menu.item>

            <flux:menu.separator />

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle">
                    {{ __('Log Out') }}
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:sidebar>



    {{-- ================= MOBILE HEADER ================= --}}
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle icon="bars-2" inset="left" />
        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />
            <flux:menu>
                <div class="px-2 py-2 text-sm flex items-center gap-2">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                        {{ auth()->user()->initials() }}
                    </span>
                    <div class="flex-1 leading-tight">
                        <div class="font-semibold truncate">{{ auth()->user()->name }}</div>
                        <div class="text-xs truncate">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                <flux:menu.separator />

                <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                    {{ __('Settings') }}
                </flux:menu.item>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{-- ================= PAGE CONTENT ================= --}}
    {{ $slot }}

    {{-- Livewire Scripts --}}
    @livewireScripts

    {{-- Flux Scripts --}}
    @fluxScripts
</body>
</html>

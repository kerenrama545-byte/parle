<div class="p-6 space-y-8 relative">

    {{-- FLASH MESSAGE --}}
    @if (session()->has('success'))
        <flux:callout
            variant="success"
            icon="check-circle"
            heading="{{ session('success') }}"
        />
    @endif

    {{-- HEADER --}}
    <div>
        <flux:heading level="1" size="xl">Dining & Bar</flux:heading>
        <p class="text-sm text-zinc-500">Kelola halaman Dining & Bar</p>
    </div>

    {{-- ================= FORM ================= --}}
    <form
        wire:submit.prevent="save"
        class="space-y-6 rounded-xl border bg-white dark:bg-zinc-900 p-6"
    >

        {{-- MOTTO --}}
        <flux:field>
            <flux:label>Motto</flux:label>
            <flux:input type="text" wire:model.defer="motto" />
            @error('motto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </flux:field>

        {{-- TITLE --}}
        <flux:field>
            <flux:label>Title</flux:label>
            <flux:input type="text" wire:model.defer="title" />
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </flux:field>

        {{-- SUBTITLE --}}
        <flux:field>
            <flux:label>Subtitle</flux:label>
            <flux:input type="text" wire:model.defer="subtitle" />
        </flux:field>

        {{-- ================= BACKGROUND IMAGE ================= --}}
        <flux:field>
            <flux:label>Background Image</flux:label>

            @if ($oldBackground)
                <img
                    src="{{ asset($oldBackground) }}"
                    class="w-full h-48 object-cover rounded-lg mb-3"
                >
            @endif

            @if ($background_image)
                <img
                    src="{{ $background_image->temporaryUrl() }}"
                    class="w-full h-48 object-cover rounded-lg mb-3 border"
                >
            @endif

            <flux:input
                type="file"
                wire:model="background_image"
                accept="image/*"
            />
        </flux:field>

{{-- ================= GALLERY IMAGES ================= --}}
<flux:field>
    <flux:label>Gallery Images</flux:label>

    {{-- ===== GALLERY LAMA (DATABASE) ===== --}}
    @if ($gallery && count($gallery))
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
            @foreach ($gallery as $img)
                <div class="relative border rounded-lg p-2">
                    <img
                        src="{{ asset($img->image) }}"
                        class="rounded-md object-cover h-32 w-full mb-2"
                    >

                    <flux:button
                        type="button"
                        size="xs"
                        variant="danger"
                        class="w-full"
                        wire:click="deleteImage({{ $img->id }})"
                        onclick="confirm('Hapus gambar ini?') || event.stopImmediatePropagation()"
                    >
                        Hapus
                    </flux:button>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ===== GALLERY BARU (UPLOAD) ===== --}}
    <div class="space-y-3">
        @foreach ($images as $index => $image)
            <div class="flex items-center gap-3">
                <input
                    type="file"
                    wire:model="images.{{ $index }}"
                    accept="image/*"
                    class="block w-full text-sm"
                >

                <flux:button
                    type="button"
                    size="xs"
                    variant="danger"
                    wire:click="removeImage({{ $index }})"
                >
                    Hapus
                </flux:button>
            </div>

            @if ($image)
                <img
                    src="{{ $image->temporaryUrl() }}"
                    class="w-32 h-24 object-cover rounded border"
                >
            @endif
        @endforeach
    </div>

    {{-- TAMBAH INPUT --}}
    <div class="mt-3">
        <flux:button
            type="button"
            size="sm"
            wire:click="addImage"
        >
            + Tambah Gambar
        </flux:button>
    </div>

    @error('images.*')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</flux:field>


        {{-- ================= SUBMIT ================= --}}
        <div class="flex justify-end">
            <flux:button type="submit">
                Simpan
            </flux:button>
        </div>

    </form>
</div>

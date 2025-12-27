<div class="space-y-6">

    {{-- FLASH MESSAGE --}}
    @if(session()->has('success'))
        <flux:callout
            variant="success"
            icon="check-circle"
            heading="{{ session('success') }}"
        />
    @endif

    <form wire:submit.prevent="save"
          enctype="multipart/form-data"
          class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow space-y-6">

        <flux:heading level="2" size="lg">
            Featured Menu
        </flux:heading>

        {{-- TEXT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <flux:field>
                <flux:label>Quote</flux:label>
                <flux:input type="text" wire:model.defer="quote" />
                <flux:error name="quote" />
            </flux:field>

            <flux:field>
                <flux:label>Title</flux:label>
                <flux:input type="text" wire:model.defer="title" />
                <flux:error name="title" />
            </flux:field>

            <flux:field class="md:col-span-2">
                <flux:label>Description</flux:label>
                <flux:textarea rows="4" wire:model.defer="description" />
            </flux:field>
        </div>

        {{-- IMAGE 1 --}}
        <flux:field>
            <flux:label>Image 1</flux:label>
            <flux:input type="file" wire:model="image_1" accept="image/*" />

            {{-- Preview NEW --}}
            @if($image_1 instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                <img src="{{ $image_1->temporaryUrl() }}"
                     class="h-28 mt-3 rounded object-cover">
            @elseif($oldImage1)
                <img src="{{ asset($oldImage1) }}"
                     class="h-28 mt-3 rounded object-cover">
            @endif
        </flux:field>

        {{-- IMAGE 2 --}}
        <flux:field>
            <flux:label>Image 2</flux:label>
            <flux:input type="file" wire:model="image_2" accept="image/*" />

            {{-- Preview NEW --}}
            @if($image_2 instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                <img src="{{ $image_2->temporaryUrl() }}"
                     class="h-28 mt-3 rounded object-cover">
            @elseif($oldImage2)
                <img src="{{ asset($oldImage2) }}"
                     class="h-28 mt-3 rounded object-cover">
            @endif
        </flux:field>

        {{-- BUTTON --}}
        <div class="flex justify-end">
            <flux:button type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Featured Menu</span>
                <span wire:loading>Saving...</span>
            </flux:button>
        </div>

    </form>
</div>

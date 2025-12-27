<div class="space-y-6">

    {{-- FLASH MESSAGE --}}
    @if(session()->has('success'))
        <flux:callout 
            variant="success" 
            icon="check-circle" 
            heading="{{ session('success') }}" 
        />
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">

        <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">

            <flux:heading level="2" size="lg">
                Homepage / Index
            </flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                {{-- QUOTE --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Quote</flux:label>
                    <flux:input type="text" wire:model.defer="quote" placeholder="Homepage quote" />
                    <flux:error name="quote" />
                </flux:field>

                {{-- DESCRIPTION 1 --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Description 1</flux:label>
                    <flux:textarea wire:model.defer="description_1" rows="3" placeholder="Description section one" />
                </flux:field>

                {{-- DESCRIPTION 2 --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Description 2</flux:label>
                    <flux:textarea wire:model.defer="description_2" rows="3" placeholder="Description section two" />
                </flux:field>

                {{-- BACKGROUND IMAGE --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Background Image</flux:label>
                    <flux:input type="file" wire:model="bg_img" accept="image/*" />
                    <flux:error name="bg_img" />

                    <div class="flex gap-4 mt-3">

                     

                        {{-- New BG --}}
                        @if($bg_img && method_exists($bg_img, 'temporaryUrl'))
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1">New Background</p>
                                <img src="{{ $bg_img->temporaryUrl() }}" class="h-28 w-48 rounded-lg object-cover border">
                            </div>
                        @endif

                    </div>
                </flux:field>

                {{-- IMAGE --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Image</flux:label>
                    <flux:input type="file" wire:model="image" accept="image/*" />
                    <flux:error name="image" />

                    <div class="flex gap-4 mt-3">

                     

                        {{-- New Image --}}
                        @if($image && method_exists($image, 'temporaryUrl'))
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1">New Image</p>
                                <img src="{{ $image->temporaryUrl() }}" class="h-28 w-48 rounded-lg object-cover border">
                            </div>
                        @endif

                    </div>
                </flux:field>

            </div>

            {{-- SAVE BUTTON --}}
            <div class="flex justify-end mt-6">
                <flux:button type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save</span>
                    <span wire:loading>Saving...</span>
                </flux:button>
            </div>

        </div>

    </form>

</div>

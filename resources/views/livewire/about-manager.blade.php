<div class="space-y-6">

    @if(session()->has('success'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('success') }}" />
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">

        <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">

            <flux:heading level="2" size="lg">About Page</flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                {{-- Quote --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Quote</flux:label>
                    <flux:input type="text" wire:model.defer="quote" placeholder="Quote" />
                    <flux:error name="quote" />
                </flux:field>

                {{-- Description --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Description</flux:label>
                    <flux:textarea wire:model.defer="description" rows="3" placeholder="Description" />
                    <flux:error name="description" />
                </flux:field>

                {{-- Opening Hours Description --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Opening Hours Description</flux:label>
                    <flux:textarea wire:model.defer="opening_hours_description" rows="3" placeholder="Opening hours description" />
                    <flux:error name="opening_hours_description" />
                </flux:field>

                {{-- Image 1 --}}
                <flux:field>
                    <flux:label>Image 1</flux:label>
                    <flux:input type="file" wire:model="image_1" accept="image/*" />
                    <flux:error name="image_1" />

                    <div class="flex gap-4 mt-3">
                        @if($oldImage1)
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1">Old Image</p>
                                <img src="{{ asset($oldImage1) }}" class="h-28 w-48 rounded-lg object-cover border">
                            </div>
                        @endif

                        @if($image_1 && method_exists($image_1, 'temporaryUrl'))
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1">New Image</p>
                                <img src="{{ $image_1->temporaryUrl() }}" class="h-28 w-48 rounded-lg object-cover border">
                            </div>
                        @endif
                    </div>
                </flux:field>

                {{-- Image 2 --}}
                <flux:field>
                    <flux:label>Image 2</flux:label>
                    <flux:input type="file" wire:model="image_2" accept="image/*" />
                    <flux:error name="image_2" />

                    <div class="flex gap-4 mt-3">
                        @if($oldImage2)
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1">Old Image</p>
                                <img src="{{ asset($oldImage2) }}" class="h-28 w-48 rounded-lg object-cover border">
                            </div>
                        @endif

                        @if($image_2 && method_exists($image_2, 'temporaryUrl'))
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1">New Image</p>
                                <img src="{{ $image_2->temporaryUrl() }}" class="h-28 w-48 rounded-lg object-cover border">
                            </div>
                        @endif
                    </div>
                </flux:field>

            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end mt-6">
                <flux:button type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save</span>
                    <span wire:loading>Saving...</span>
                </flux:button>
            </div>

        </div>

    </form>

</div>

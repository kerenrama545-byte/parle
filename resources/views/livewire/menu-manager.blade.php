<div class="space-y-6">

    {{-- FLASH MESSAGE --}}
    @if(session()->has('success'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('success') }}" />
    @endif

    {{-- HEADER FORM --}}
    <form wire:submit.prevent="saveHeader" class="space-y-6">
        <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">
            <flux:heading level="2" size="lg">Menu Header</flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <flux:field>
                    <flux:label>Title</flux:label>
                    <flux:input type="text" wire:model.defer="title" placeholder="Header Title" />
                    <flux:error name="title" />
                </flux:field>

                <flux:field>
                    <flux:label>Quote</flux:label>
                    <flux:input type="text" wire:model.defer="quote" placeholder="Header Quote" />
                    <flux:error name="quote" />
                </flux:field>
            </div>

            <div class="flex justify-end mt-4">
                <flux:button type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save Header</span>
                    <span wire:loading>Saving...</span>
                </flux:button>
            </div>
        </div>
    </form>

    {{-- MENU FORM --}}
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-6" enctype="multipart/form-data">
        <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">
            <flux:heading level="2" size="lg">{{ $isEdit ? 'Edit Menu' : 'Add Menu' }}</flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                {{-- Name --}}
                <flux:field>
                    <flux:label>Menu Name</flux:label>
                    <flux:input type="text" wire:model.defer="name" placeholder="Menu Name" />
                    <flux:error name="name" />
                </flux:field>

                {{-- Price --}}
                <flux:field>
                    <flux:label>Price</flux:label>
                    <flux:input type="number" wire:model.defer="price" placeholder="Price" />
                    <flux:error name="price" />
                </flux:field>

                {{-- Description --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Description</flux:label>
                    <flux:textarea wire:model.defer="description" rows="3" placeholder="Description" />
                    <flux:error name="description" />
                </flux:field>

                {{-- Image --}}
                <flux:field class="md:col-span-2">
                    <flux:label>Image</flux:label>
                    <flux:input type="file" wire:model="image" />
                    <flux:error name="image" />

                    {{-- Preview existing image --}}
                    @if($oldImage)
                        <div class="mt-2">
                            <img src="{{ asset('menu/'.$oldImage) }}" alt="Menu Image" class="h-20 w-auto object-contain">
                        </div>
                    @endif

                    {{-- Preview new upload --}}
                    @if ($image)
                        <div class="mt-2">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview Image" class="h-20 w-auto object-contain">
                        </div>
                    @endif
                </flux:field>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-2 mt-4">
                <flux:button type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>{{ $isEdit ? 'Update' : 'Save' }}</span>
                    <span wire:loading>Processing...</span>
                </flux:button>

                @if($isEdit)
                    <flux:button type="button" variant="outline" wire:click="resetForm">
                        Cancel
                    </flux:button>
                @endif
            </div>
        </div>
    </form>

    {{-- MENU TABLE --}}
    <div class="border border-zinc-200 bg-zinc-50 rounded-lg shadow overflow-x-auto">
        <table class="w-full text-sm mt-2">
            <thead class="border-b">
                <tr class="text-left">
                    <th class="px-4 py-3">Image</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3 w-32">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                    <tr class="border-b">
                        {{-- Image --}}
                        <td class="px-4 py-3">
                            @if($menu->image)
                                <img src="{{ asset('menu/'.$menu->image) }}" alt="{{ $menu->name }}" class="h-12 w-auto object-contain">
                            @else
                                <span class="text-zinc-400 text-xs">No image</span>
                            @endif
                        </td>

                        {{-- Name & Price --}}
                        <td class="px-4 py-3">{{ $menu->name }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($menu->price) }}</td>

                        {{-- Actions --}}
                        <td class="px-4 py-3 flex gap-2">
                            <flux:button size="sm" variant="outline" wire:click="edit({{ $menu->id }})">Edit</flux:button>
                            <flux:button size="sm" variant="danger"
                                wire:click="delete({{ $menu->id }})"
                                onclick="confirm('Delete this menu?') || event.stopImmediatePropagation()">
                                Delete
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-zinc-500">
                            No menu available
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<div class="max-w-4xl mx-auto py-6 space-y-6">

    {{-- Success Message --}}
    @if(session()->has('success'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('success') }}" />
    @endif

    <form wire:submit.prevent="save" class="space-y-6">

        @foreach($contacts as $index => $contact)
            <div class="bg-white dark:bg-zinc-700 border border-gray-200 dark:border-zinc-600 rounded-lg p-6 shadow-sm space-y-4">

                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Contact #{{ $index + 1 }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- City --}}
                    <flux:field>
                        <flux:label>City</flux:label>
                        <flux:input type="text" wire:model.lazy="contacts.{{ $index }}.city" placeholder="Enter city" />
                    </flux:field>

                    {{-- Address --}}
                    <flux:field>
                        <flux:label>Address</flux:label>
                        <flux:textarea wire:model.lazy="contacts.{{ $index }}.address" rows="2" placeholder="Enter address" />
                    </flux:field>

                    {{-- Email --}}
                    <flux:field>
                        <flux:label>Email</flux:label>
                        <flux:input type="email" wire:model.lazy="contacts.{{ $index }}.email" placeholder="Enter email" />
                    </flux:field>

                </div>

                {{-- Remove Button --}}
                @if(count($contacts) > 1)
                    <flux:button type="button" wire:click="removeContact({{ $index }})" variant="danger">
                        Remove
                    </flux:button>
                @endif

            </div>
        @endforeach

        {{-- Add Contact --}}
        <flux:button type="button" wire:click="addContact" variant="outline">
            + Add Contact
        </flux:button>

        {{-- Submit --}}
        <div class="flex justify-end">
            <flux:button type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Changes</span>
                <span wire:loading>Saving...</span>
            </flux:button>
        </div>

    </form>
</div>

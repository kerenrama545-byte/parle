<div class="space-y-6">
    @if(session()->has('success'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('success') }}" />
    @endif

    <form wire:submit.prevent="save">
        <div class="space-y-6">

            <!-- Social Media Links Section -->
            <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">
                <flux:heading level="2" size="lg">Social Media Links</flux:heading>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- WhatsApp -->
                    <flux:field>
                        <flux:label>WhatsApp</flux:label>
                        <flux:input
                            type="text"
                            wire:model="whatsapp"
                            placeholder="Enter WhatsApp number or link"
                        />
                        <flux:error name="whatsapp" />
                    </flux:field>

                    <!-- Instagram -->
                    <flux:field>
                        <flux:label>Instagram</flux:label>
                        <flux:input
                            type="text"
                            wire:model="instagram"
                            placeholder="Enter Instagram link"
                        />
                        <flux:error name="instagram" />
                    </flux:field>

                    <!-- Facebook -->
                    <flux:field>
                        <flux:label>Facebook</flux:label>
                        <flux:input
                            type="text"
                            wire:model="facebook"
                            placeholder="Enter Facebook link"
                        />
                        <flux:error name="facebook" />
                    </flux:field>

                    <!-- Twitter -->
                    <flux:field>
                        <flux:label>Twitter</flux:label>
                        <flux:input
                            type="text"
                            wire:model="twitter"
                            placeholder="Enter Twitter link"
                        />
                        <flux:error name="twitter" />
                    </flux:field>

                    <!-- LinkedIn -->
                    <flux:field>
                        <flux:label>LinkedIn</flux:label>
                        <flux:input
                            type="text"
                            wire:model="linkedin"
                            placeholder="Enter LinkedIn link"
                        />
                        <flux:error name="linkedin" />
                    </flux:field>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <flux:button type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save Changes</span>
                    <span wire:loading>Saving...</span>
                </flux:button>
            </div>
        </div>
    </form>
</div>

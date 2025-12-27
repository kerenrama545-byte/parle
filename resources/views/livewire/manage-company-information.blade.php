<div class="space-y-6">
    {{-- FLASH MESSAGE --}}
    @if(session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" />
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Company Name -->
        <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">
            <flux:heading level="2" size="lg">Company Name</flux:heading>
            <flux:field class="mt-4">
                <flux:label>Company Name</flux:label>
                <flux:input type="text" wire:model="company_name" placeholder="Enter company name" />
                <flux:error name="company_name" />
            </flux:field>
        </div>

        <!-- Logo & Icon -->
        <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">
            <flux:heading level="2" size="lg">Logo & Icon</flux:heading>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Logo -->
                <flux:field>
                    <flux:label>Logo</flux:label>
                    <flux:input type="file" wire:model="logoFile" accept="image/*" />
                    <flux:error name="logoFile" />
                    @if($logo)
                        <div class="mt-2">
                            <img src="{{ asset('logoicon/' . $logo) }}" alt="Logo" class="h-20 w-auto object-contain">
                        </div>
                    @endif
                </flux:field>

                <!-- Icon -->
                <flux:field>
                    <flux:label>Icon</flux:label>
                    <flux:input type="file" wire:model="iconFile" accept="image/*" />
                    <flux:error name="iconFile" />
                    @if($icon)
                        <div class="mt-2">
                            <img src="{{ asset('logoicon/' . $icon) }}" alt="Icon" class="h-20 w-auto object-contain">
                        </div>
                    @endif
                </flux:field>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">
            <flux:heading level="2" size="lg">Contact Information</flux:heading>

            {{-- Phones --}}
            <div class="mt-4">
                <div class="flex justify-between items-center mb-2">
                    <flux:label>Phone Numbers</flux:label>
                    <flux:button type="button" wire:click="addPhone" variant="primary" size="sm">Add Phone</flux:button>
                </div>
                <div class="space-y-2">
                    @foreach($phones as $index => $phone)
                        <flux:input.group>
                            <flux:input type="tel" wire:model="phones.{{ $index }}" placeholder="Enter phone number" class="flex-1" />
                            @if(count($phones) > 1)
                                <flux:button type="button" wire:click="removePhone({{ $index }})" variant="danger">Remove</flux:button>
                            @endif
                        </flux:input.group>
                        <flux:error name="phones.{{ $index }}" />
                    @endforeach
                </div>
            </div>

            {{-- Email --}}
            <flux:field class="mt-6">
                <flux:label>Email Address</flux:label>
                <flux:input type="email" wire:model="email" placeholder="Enter email address" />
                <flux:error name="email" />
            </flux:field>

            {{-- Address --}}
            <flux:field class="mt-6">
                <flux:label>Address</flux:label>
                <flux:textarea wire:model="address" rows="3" placeholder="Enter company address"></flux:textarea>
                <flux:error name="address" />
            </flux:field>
        </div>

        <!-- Map & Video -->
        <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">
            <flux:heading level="2" size="lg">Map & Video</flux:heading>
            <div class="mt-4 space-y-4">
                <flux:field>
                    <flux:label>Google Map Link</flux:label>
                    <flux:input type="url" wire:model="google_map_link" placeholder="https://maps.google.com/..." />
                    <flux:error name="google_map_link" />
                </flux:field>

                <flux:field>
                    <flux:label>Video Profile Link</flux:label>
                    <flux:input type="url" wire:model="video_profile_link" placeholder="https://www.youtube.com/watch?v=..." />
                    <flux:error name="video_profile_link" />
                </flux:field>
            </div>
        </div>

        <!-- Opening Hours -->
        <div class="border border-zinc-200 bg-zinc-50 p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <flux:heading level="2" size="lg">Opening Hours</flux:heading>
                <flux:button type="button" wire:click="addOpeningHour" variant="primary" size="sm">Add Opening Hour</flux:button>
            </div>
            <div class="space-y-4">
                @foreach($opening_hours_days as $index => $day)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                        <flux:field>
                            <flux:label>Days</flux:label>
                            <flux:input type="text" wire:model.live="opening_hours_days.{{ $index }}" placeholder="e.g., MONDAY - WEDNESDAY" />
                            <flux:error name="opening_hours_days.{{ $index }}" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Hours</flux:label>
                            <div class="flex gap-2">
                                <flux:input type="text" wire:model.live="opening_hours_times.{{ $index }}" placeholder="e.g., 10:00 - 24:00" class="flex-1" />
                                @if(count($opening_hours_days) > 1)
                                    <flux:button type="button" wire:click="removeOpeningHour({{ $index }})" variant="danger">Remove</flux:button>
                                @endif
                            </div>
                            <flux:error name="opening_hours_times.{{ $index }}" />
                        </flux:field>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <flux:button type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Changes</span>
                <span wire:loading>Saving...</span>
            </flux:button>
        </div>
    </form>
</div>

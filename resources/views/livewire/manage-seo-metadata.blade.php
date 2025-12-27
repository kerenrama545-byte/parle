@php
    use Illuminate\Support\Facades\Storage;
@endphp

<div class="space-y-6">
    @if(session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" />
    @endif

    <!-- Header with Create Button -->
    <div class="flex justify-between items-center">
        <flux:heading level="2" size="xl">Manage SEO Metadata</flux:heading>
        <flux:button icon="plus" variant="primary" wire:click="create">
            Add SEO Metadata
        </flux:button>
    </div>

    <!-- Search -->
    <flux:field>
        <flux:label>Search Pages</flux:label>
        <flux:input
            type="text"
            wire:model.live="search"
            placeholder="Search by page name, title, or description..."
        />
    </flux:field>

    <!-- SEO Metadata Table -->
    <div class="border border-zinc-200 rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-zinc-200">
            <thead class="bg-zinc-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Page</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">OG Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-zinc-200">
                @forelse($seoPages as $seo)
                    <tr class="hover:bg-zinc-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <flux:text class="font-medium">{{ $seo->page_name }}</flux:text>
                        </td>
                        <td class="px-6 py-4">
                            <flux:text class="text-sm">{{ Str::limit($seo->meta_title, 50) }}</flux:text>
                            <flux:text class="text-xs text-zinc-500">{{ strlen($seo->meta_title) }} chars</flux:text>
                        </td>
                        <td class="px-6 py-4">
                            <flux:text class="text-sm">{{ Str::limit($seo->meta_description, 80) }}</flux:text>
                            <flux:text class="text-xs text-zinc-500">{{ strlen($seo->meta_description) }} chars</flux:text>
                        </td>
                        <td class="px-6 py-4">
                            @if($seo->og_image)
                                <div class="flex items-center space-x-2">
                                    <img src="{{ Storage::url($seo->og_image) }}" alt="OG Image" class="h-10 w-10 object-cover rounded">
                                    <flux:text class="text-sm truncate max-w-xs">{{ basename($seo->og_image) }}</flux:text>
                                </div>
                            @else
                                <flux:text class="text-sm text-zinc-500">Default</flux:text>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <flux:button
                                    icon="pencil"
                                    size="sm"
                                    wire:click="edit({{ $seo->id }})"
                                />
                                <flux:button
                                    icon="trash"
                                    size="sm"
                                    variant="danger"
                                    wire:click="delete({{ $seo->id }})"
                                    wire:confirm="Are you sure you want to delete this SEO metadata?"
                                />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">
                            <flux:text class="text-zinc-500">No SEO metadata found.</flux:text>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    {{ $seoPages->links() }}

    <!-- Create/Edit Modal -->
    @if($showModal)
        <flux:modal wire:model="showModal" flyout>
            <div class="mb-6">
                <flux:heading size="lg">{{ $isEditing ? 'Edit SEO Metadata' : 'Create SEO Metadata' }}</flux:heading>
            </div>

            <form wire:submit="save">
                <div class="space-y-6">
                    <!-- Page Name -->
                    <flux:field>
                        <flux:label>Page Name</flux:label>
                        <flux:select wire:model="page_name" required>
                            <option value="">Select a page</option>
                            <option value="home">Home</option>
                            <option value="about">About</option>
                            <option value="dining-and-bar">Dining & Bar</option>
                            <option value="hotel-and-resort">Hotel & Resort</option>
                            <option value="fishery-and-plantation">Fishery & Plantation</option>
                            <option value="property-and-land">Property & Land</option>
                            <option value="contact">Contact</option>
                            <option value="blog">Blog</option>
                            <option value="gallery">Gallery</option>
                        </flux:select>
                        <flux:error name="page_name" />
                        <flux:description>Corresponds to the route name of the page</flux:description>
                    </flux:field>

                    <!-- Meta Title -->
                    <flux:field>
                        <flux:label>Meta Title</flux:label>
                        <flux:input
                            type="text"
                            wire:model="meta_title"
                            required
                            maxlength="60"
                            placeholder="Enter meta title"
                        />
                        <flux:error name="meta_title" />
                        <div class="flex justify-between text-xs mt-1">
                            <flux:text class="{{ $this->getCharCount('meta_title') > 60 ? 'text-red-500' : 'text-zinc-500' }}">
                                {{ $this->getCharCount('meta_title') }}/60 characters
                            </flux:text>
                            <flux:text class="text-zinc-500">Recommended: 30-60 chars</flux:text>
                        </div>
                    </flux:field>

                    <!-- Meta Description -->
                    <flux:field>
                        <flux:label>Meta Description</flux:label>
                        <flux:textarea
                            wire:model="meta_description"
                            required
                            maxlength="160"
                            rows="3"
                            placeholder="Enter meta description"
                        />
                        <flux:error name="meta_description" />
                        <div class="flex justify-between text-xs mt-1">
                            <flux:text class="{{ $this->getCharCount('meta_description') > 160 ? 'text-red-500' : 'text-zinc-500' }}">
                                {{ $this->getCharCount('meta_description') }}/160 characters
                            </flux:text>
                            <flux:text class="text-zinc-500">Recommended: 70-160 chars</flux:text>
                        </div>
                    </flux:field>

                    <!-- OG Image -->
                    <flux:field>
                        <flux:label>OG Image</flux:label>
                        <flux:input
                            type="file"
                            wire:model="og_image_file"
                            accept="image/*"
                        />
                        <flux:error name="og_image_file" />
                        <flux:description>Upload OG image. Recommended size: 1200x630px (JPG, PNG, GIF, max 2MB)</flux:description>
                        @if($og_image)
                            <div class="mt-2">
                                <flux:text class="text-sm text-zinc-600">Current OG Image:</flux:text>
                                <img src="{{ Storage::url($og_image) }}" alt="Current OG Image" class="h-32 w-auto border rounded mt-1">
                            </div>
                        @endif
                        @if($og_image_file)
                            <div class="mt-2">
                                <flux:text class="text-sm text-zinc-600">New OG Image Preview:</flux:text>
                                <img src="{{ $og_image_file->temporaryUrl() }}" alt="OG Image Preview" class="h-32 w-auto border rounded mt-1">
                            </div>
                        @endif
                    </flux:field>

                    <!-- Canonical URL -->
                    <flux:field>
                        <flux:label>Canonical URL</flux:label>
                        <flux:input
                            type="url"
                            wire:model="canonical_url"
                            placeholder="https://parle-group.com/about"
                        />
                        <flux:error name="canonical_url" />
                        <flux:description>Leave empty to use current page URL</flux:description>
                    </flux:field>

                    <!-- Structured Data (JSON-LD) -->
                    <flux:field>
                        <flux:label>Structured Data (JSON-LD)</flux:label>
                        <flux:textarea
                            wire:model="structured_data"
                            rows="6"
                            placeholder='{"@context": "https://schema.org", "@type": "Organization", ...}'
                        />
                        <flux:error name="structured_data" />
                        <flux:description>JSON format for structured data. Optional but recommended for SEO</flux:description>
                    </flux:field>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <flux:button type="button" wire:click="$set('showModal', false)" variant="outline">
                        Cancel
                    </flux:button>
                    <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            {{ $isEditing ? 'Update' : 'Create' }}
                        </span>
                        <span wire:loading>
                            {{ $isEditing ? 'Updating' : 'Creating' }}...
                        </span>
                    </flux:button>
                </div>
            </form>
        </flux:modal>
    @endif
</div>

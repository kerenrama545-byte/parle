<div class="p-6 space-y-8">

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('success') }}" />
    @endif

    {{-- HEADER --}}
    <div>
        <flux:heading level="1" size="xl">Blog Management</flux:heading>
        <p class="text-sm text-zinc-500">Kelola semua artikel blog</p>
    </div>

    {{-- FORM CREATE / EDIT --}}
    <form wire:submit.prevent="save" class="space-y-6 rounded-xl border bg-white p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- TITLE --}}
            <flux:field>
                <flux:label>Title</flux:label>
                <flux:input type="text" wire:model.defer="title" placeholder="Blog Title" />
                <flux:error name="title" />
            </flux:field>

            {{-- PUBLISHED AT --}}
            <flux:field>
                <flux:label>Published At</flux:label>
                <flux:input type="datetime-local" wire:model.defer="published_at" />
                <flux:error name="published_at" />
            </flux:field>

            {{-- EXCERPT --}}
            <flux:field class="md:col-span-2">
                <flux:label>Excerpt</flux:label>
                <flux:textarea wire:model.defer="excerpt" placeholder="Short excerpt" rows="3" />
                <flux:error name="excerpt" />
            </flux:field>

            {{-- CONTENT --}}
            <flux:field class="md:col-span-2">
                <flux:label>Content</flux:label>
                <flux:textarea wire:model.defer="content" placeholder="Full content" rows="5" />
                <flux:error name="content" />
            </flux:field>

            {{-- IMAGE --}}
            <flux:field class="md:col-span-2">
                <flux:label>Image</flux:label>
                <flux:input type="file" wire:model="image" accept="image/*" />
                <flux:error name="image" />

                {{-- Preview OLD IMAGE --}}
                @if($oldImage)
                    <div class="mt-2">
                        <img src="{{ asset($oldImage) }}" alt="Old Image" class="h-32 w-auto object-contain rounded-lg">
                    </div>
                @endif

                {{-- Preview NEW IMAGE --}}
                @if($image && method_exists($image, 'temporaryUrl'))
                    <div class="mt-2">
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview Image" class="h-32 w-auto object-contain rounded-lg">
                    </div>
                @endif
            </flux:field>

        </div>

        {{-- BUTTONS --}}
        <div class="flex justify-end gap-2 mt-4">
            <flux:button type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>{{ $blogId ? 'Update' : 'Save' }}</span>
                <span wire:loading>Processing...</span>
            </flux:button>

            @if($blogId)
                <flux:button type="button" variant="outline" wire:click="resetForm">
                    Cancel
                </flux:button>
            @endif
        </div>
    </form>

    {{-- LIST BLOG --}}
    <div class="border border-zinc-200 bg-zinc-50 rounded-lg shadow overflow-x-auto mt-6">
        <table class="w-full text-sm">
            <thead class="border-b">
                <tr class="text-left">
                    <th class="px-4 py-3">Image</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Published At</th>
                    <th class="px-4 py-3 w-32">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr class="border-b">
                        <td class="px-4 py-3">
                            @if($blog->image)
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="h-20 w-auto object-contain rounded-lg">
                            @else
                                <span class="text-zinc-400 text-xs">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $blog->title }}</td>
                        <td class="px-4 py-3">{{ $blog->published_at?->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <flux:button size="sm" variant="outline" wire:click="edit({{ $blog->id }})">Edit</flux:button>
                            <flux:button size="sm" variant="danger"
                                wire:click="delete({{ $blog->id }})"
                                onclick="confirm('Delete this blog?') || event.stopImmediatePropagation()">
                                Delete
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-zinc-500">No blogs available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

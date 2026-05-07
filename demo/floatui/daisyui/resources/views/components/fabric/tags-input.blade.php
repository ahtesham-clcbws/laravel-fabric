@props([
    'label' => null,
    'placeholder' => 'Add tag...'
])

<div x-data="{
    tags: @entangle($attributes->wire('model')),
    newTag: '',
    addTag() {
        if (this.newTag.trim() !== '' && !this.tags.includes(this.newTag.trim())) {
            this.tags.push(this.newTag.trim());
            this.newTag = '';
        }
    },
    removeTag(index) {
        this.tags.splice(index, 1);
    }
}" class="w-full">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif

    <div class="flex flex-wrap items-center gap-2 p-2 border border-gray-300 rounded-md bg-white focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
        <template x-for="(tag, index) in tags" :key="index">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-600">
                <span x-text="tag"></span>
                <button @click="removeTag(index)" type="button" class="ml-1 text-indigo-400 hover:text-indigo-600">
                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" /></svg>
                </button>
            </span>
        </template>
        
        <input 
            type="text" 
            x-model="newTag" 
            @keydown.enter.prevent="addTag()" 
            @keydown.comma.prevent="addTag()" 
            placeholder="{{ $placeholder }}"
            class="flex-1 border-none focus:ring-0 text-sm p-0"
        >
    </div>
</div>

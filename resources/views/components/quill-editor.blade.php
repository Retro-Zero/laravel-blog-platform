@props([
    'name' => 'content',
    'value' => '',
    'placeholder' => 'Start writing your content...',
    'height' => '300px',
    'required' => false,
    'options' => '{}'
])

<div class="quill-editor-container">
    <div 
        id="quill-{{ $name }}" 
        data-quill 
        data-quill-field="{{ $name }}"
        data-quill-options="{{ $options }}"
        style="height: {{ $height }};"
        class="quill-editor"
    >{!! $value !!}</div>
    
    <input 
        type="hidden" 
        name="{{ $name }}" 
        value="{{ $value }}"
        @if($required) required @endif
    />
    
    @error($name)
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>

<style>
.quill-editor-container {
    margin-bottom: 1rem;
}

.quill-editor {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    background-color: white;
}

.ql-editor {
    min-height: 200px;
    font-size: 14px;
    line-height: 1.5;
}

.ql-toolbar {
    border-top: 1px solid #d1d5db;
    border-left: 1px solid #d1d5db;
    border-right: 1px solid #d1d5db;
    border-bottom: none;
    border-top-left-radius: 0.375rem;
    border-top-right-radius: 0.375rem;
}

.ql-container {
    border-bottom: 1px solid #d1d5db;
    border-left: 1px solid #d1d5db;
    border-right: 1px solid #d1d5db;
    border-top: none;
    border-bottom-left-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
}

.ql-editor:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
</style> 
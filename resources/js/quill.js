// Quill editor configuration for CDN version
document.addEventListener('DOMContentLoaded', function() {
    // Default Quill configuration
    const defaultConfig = {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'align': [] }],
                ['link', 'image', 'blockquote', 'code-block'],
                ['clean']
            ]
        },
        placeholder: 'Start writing your content...'
    };

    // Initialize Quill editor
    window.initQuill = (selector, options = {}) => {
        const config = { ...defaultConfig, ...options };
        const element = document.querySelector(selector);
        
        if (!element) {
            console.error(`Quill element not found: ${selector}`);
            return null;
        }

        const quill = new Quill(element, config);
        
        // Add custom methods
        quill.getHTML = () => {
            return quill.root.innerHTML;
        };
        
        quill.setHTML = (html) => {
            quill.root.innerHTML = html;
        };
        
        return quill;
    };

    // Initialize all Quill editors on page load
    const quillElements = document.querySelectorAll('[data-quill]');
    
    quillElements.forEach(element => {
        const options = element.dataset.quillOptions ? JSON.parse(element.dataset.quillOptions) : {};
        const quill = initQuill(`#${element.id}`, options);
        
        // Store Quill instance on element for easy access
        element.quill = quill;
        
        // Handle form submission
        const form = element.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const quillElement = form.querySelector('[data-quill]');
                if (quillElement && quillElement.quill) {
                    const hiddenInput = form.querySelector(`input[name="${quillElement.dataset.quillField || 'content'}"]`);
                    if (hiddenInput) {
                        hiddenInput.value = quillElement.quill.getHTML();
                    }
                }
            });
        }
    });
}); 
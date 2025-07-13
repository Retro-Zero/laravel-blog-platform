@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showSuccess("{{ session('success') }}");
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showError("{{ session('error') }}");
        });
    </script>
@endif

@if(session('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showWarning("{{ session('warning') }}");
        });
    </script>
@endif

@if(session('info'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showInfo("{{ session('info') }}");
        });
    </script>
@endif

@if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('status') === 'profile-updated')
                showSuccess("Profile updated successfully!");
            @else
                showInfo("{{ session('status') }}");
            @endif
        });
    </script>
@endif

@if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showError("{{ $errors->first() }}");
        });
    </script>
@endif 
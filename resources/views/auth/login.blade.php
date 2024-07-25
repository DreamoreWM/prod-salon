
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('sendLoginLink') }}">
            @csrf
            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer le lien de connexion</button>
        </form>
    </div>

    <script>
        @if (!session('email_verified'))
        setInterval(() => {
            fetch('{{ route('checkEmailVerified') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.email_verified) {
                        window.location.href = '{{ url('/') }}';
                    }
                });
        }, 5000); // Vérifie toutes les 5 secondes
        @endif
    </script>

@if (isset($type))

    @session($type)
        <script>
            Swal.fire({
                icon: '{{ $type }}',
                title: "{{ session($type) }}",
                timer: 2000
            });
        </script>
    @endsession
@endif
@if (isset($error))
    @error($error)
        <script>
            Swal.fire({
                icon: 'error',
                title: "{{ $message }}",
                timer: 2000
            });
        </script>
    @enderror
@endif

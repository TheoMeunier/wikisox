<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn__primary']) }}>
    {{ $slot }}
</button>

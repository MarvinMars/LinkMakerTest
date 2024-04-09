<div class="mb-3">
    <div class="row mb-3">
        <div class="col-12">
            @if($title)
                <h5 class="w-100 text-secondary text-center">{{ $title }}</h5>
            @endif
        </div>
        <div class="col-6 offset-3">
            <div class="input-group mb-3">
                <button class="btn btn-primary" type="button" id="{{ $name }}-button-decrement">-</button>
                <input type="number"
                       class="form-control form-control-lg counter"
                       placeholder=""
                       min="{{ $min }}"
                       id="{{ $name }}"
                       name="{{ $name }}"
                       value="{{ $value }}"
                >
                <button class="btn btn-primary" type="button" id="{{ $name }}-button-increment">+</button>
            </div>
        </div>
    </div>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@prependonce('scripts')
    <script>
        function initializeIncrementDecrement(idPrefix) {
            const incrementButton = document.getElementById(idPrefix + '-button-increment');
            const decrementButton = document.getElementById(idPrefix + '-button-decrement');
            const inputField = document.getElementById(idPrefix);

            incrementButton.addEventListener('click', () => {
                handleButtonClick(true);
            });

            decrementButton.addEventListener('click', () => {
                handleButtonClick(false);
            });

            function handleButtonClick(isIncrement) {
                const step = parseFloat(inputField.getAttribute('step')) || 1;
                let currentValue = parseFloat(inputField.value) || 0;

                if (isIncrement) {
                    inputField.value = currentValue + step;
                } else {
                    inputField.value = currentValue - step;
                }
            }
        }
    </script>
@endprependonce
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initializeIncrementDecrement('{{ $name }}');
        });
    </script>
@endpush
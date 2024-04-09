<div class="mb-3">
    <div class="row mb-3">
        <div class="col-12">
            @if($title)
                <h5 class="w-100 text-secondary text-center">{{ $title }}</h5>
            @endif
            <h4 id="output-{{ $name }}" class="w-100 text-primary text-center"></h4>
        </div>
        <div class="col-12">
            <input type="range"
                   class="form-range"
                   min="{{ $min }}"
                   max="{{ $max }}"
                   id="{{ $name }}"
                   name="{{ $name }}"
                   value="{{ $value }}"
            >
        </div>
    </div>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@prependonce('scripts')
    <script>
        function initializeRangeInput(name) {
            const rangeInput = document.getElementById(name);
            rangeInput.addEventListener('input', updateTime);
            updateTime();

            function updateTime() {
                const rangeValue = parseInt(rangeInput.value);
                const hours = Math.floor(rangeValue / 3600);
                const minutes = Math.floor((rangeValue % 3600) / 60);
                const seconds = rangeValue % 60;
                const formattedTime = pad(hours) + " : " + pad(minutes) + " : " + pad(seconds);
                document.getElementById('output-' + name).innerText = formattedTime;
            }

            function pad(num) {
                return (num < 10) ? "0" + num : num;
            }
        }
    </script>
@endprependonce
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initializeRangeInput('{{ $name }}');
        });
    </script>
@endpush
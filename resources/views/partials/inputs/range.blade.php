<div class="mb-3">
    <div class="row mb-3">
        <div class="col-12">
            @if($title)
                <h5 class="w-100 text-secondary text-center">{{ $title }}</h5>
            @endif
            <div class="input-group">
                <input type="number" id="{{$name}}_hours" aria-label="Hours" class="form-control" value="">
                <span class="input-group-text">:</span>
                <input type="number" id="{{$name}}_minutes" aria-label="Minutes" class="form-control" value="">
                <span class="input-group-text">:</span>
                <input type="number" id="{{$name}}_seconds" aria-label="Seconds" class="form-control" value="">
            </div>
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
            const hoursInput = document.getElementById(name + '_hours');
            const minutesInput = document.getElementById(name + '_minutes');
            const secondsInput = document.getElementById(name + '_seconds');

            rangeInput.addEventListener('input', updateInputs);
            hoursInput.addEventListener('input', updateSlider);
            minutesInput.addEventListener('input', updateSlider);
            secondsInput.addEventListener('input', updateSlider);
            updateInputs();

            function updateInputs() {
                const totalSeconds = parseInt(rangeInput.value);
                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                hoursInput.value = hours;
                minutesInput.value = minutes;
                secondsInput.value = seconds;
            }

            function updateSlider() {
                const hours = parseInt(hoursInput.value);
                const minutes = parseInt(minutesInput.value);
                const seconds = parseInt(secondsInput.value);
                const totalSeconds = hours * 3600 + minutes * 60 + seconds;

                rangeInput.value = totalSeconds;
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
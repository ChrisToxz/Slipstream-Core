<div
    x-data="{ file: '', isUploading: false, isFinished: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false, isFinished = true"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"

>
    <div class="upload-area" style="height:100px; border-style: solid;">
        <input id="file" hidden type="file" wire:model="media" x-ref="file" x-on:change="file = $refs.file.files[0].name">
        <button hidden type="button" onclick="document.querySelector('input[type=\'file\']').click();">Select media</button>
        <div style="text-align:center" id="dropmessage">Drop media here or click to select!</div>
    </div>
    <!-- File Input -->

    @error('media') <span class="error">{{ $message }}</span> @enderror
    <div x-show="file" class="container py-4" x-cloak>
        <input type="text" x-bind:placeholder="file" wire:model="title" id="title"><br>
        <textarea placeholder="Description..." wire:model="description"></textarea>
        <div x-show="isFinished">
            <button wire:click.prevent="upload">Save media!</button>.
            <button x-on:click.prevent="file = '', isFinished = 0" id="reset">Reset</button>
        </div>
    </div>
    <!-- Progress Bar -->
    <div x-show="isUploading" x-cloak>
        <progress max="100" x-bind:value="progress"></progress>
    </div>

    <script>
        $(function() {
            // dragover
            $("html").on("dragover", function(e) {
                e.preventDefault();
                e.stopPropagation();
                $("#dropmessage").text("Drag it to here!");
                console.log('drag to here');
            });
            $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });
            // Drag enter
            $('.upload-area').on('dragenter', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $("#dropmessage").text("Drop it here ;)");
                console.log('drop it here');
            });
            // Drag over
            $('.upload-area').on('dragover', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $("#dropmessage").text("Drop it here ;)");
                console.log('drop it here');
            });
            // Drop
            $('.upload-area').on('drop', function (e) {
                e.stopPropagation();
                e.preventDefault();
                console.log('set file');
                $("#dropmessage").text("");
                $("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);
                file.dispatchEvent(new Event('change'))

                // Upload a file:
            @this.upload('media', document.querySelector('input[type="file"]').files[0], (uploadedFilename) => {
                // Success callback.
            }, () => {
                // Error callback.
            }, (event) => {
                // Progress callback.
                // event.detail.progress contains a number between 1 and 100 as the upload progresses.
            })
            });

            // Open file selector on div click
            $(".upload-area").click(function(){
                document.querySelector('input[type=\'file\']').click();
            });

            window.addEventListener('resetform', event => {

                document.getElementById('reset').click()

            })
        });
    </script>
</div>


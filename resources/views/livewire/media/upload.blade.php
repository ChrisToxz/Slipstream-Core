<div
    x-data="{ file: '', isUploading: false, isFinished: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false, isFinished = true"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"

    class="upload-area text-opacity-100 text-white px-4 py-2 border-dashed border-8"

>
    <div class="flex h-screen h-72">
        <div class="m-auto">


    <div class="">
        <input id="file" hidden type="file" wire:model="media" x-ref="file" x-on:change="file = $refs.file.files[0].name">
        <button hidden type="button" onclick="document.querySelector('input[type=\'file\']').click();">Select media</button>
        <p class="text-center align-middle" id="dropmessage" x-show="!file">Drop media here or click to select!</p>
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
        </div>
    </div>

    <script>
{{--        TODO : REWRITE!!! --}}
        $(function() {
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
                console.log(e.originalEvent.dataTransfer.files.length);
                if(e.originalEvent.dataTransfer.files.length) {
                    $("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);
                    file.dispatchEvent(new Event('change'))
                    console.log('file have been set');
                }else{
                    $("input[type='file']").val('');
                    console.log('not a file');
                    $("#dropmessage").text("Please try again or click here to select media");

                }
            });

            // Open file selector on div click
            $(".upload-area").click(function(){
                if(document.querySelector('input[type=\'file\']').files.length == 0 ) {
                    document.querySelector('input[type=\'file\']').click();
                }
            });

            window.addEventListener('resetform', event => {
                document.getElementById('reset').click()
            })
        });
    </script>
</div>


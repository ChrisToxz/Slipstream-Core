<script setup>

</script>

<template>
  <div class="ml-[60px] mt-10 flex flex-col text-gray-200">
    <label class="" for="description">Description</label>
    <textarea id="description" />
    <label class="" for="access-policy">Access Policy</label>
    <select id="access-policy" />
    <label for="retention-policy">Retention Policy</label>
    <select id="retention-policy" />
    <div class="flex">
      <div class="flex flex-col">
        <label for="resolution">Resolution</label>
        <input id="resolution" type="text" />
        <label for="codec">Codec</label>
        <input id="codec" type="text" />
        <label for="codec2">Codec</label>
        <input id="codec2" type="text" />
        <label for="hash">Hash</label>
        <input id="hash" type="text" />
      </div>
      <div class="flex flex-col">
        <label for="raw">Raw Video Info</label>
        <textarea id="raw" cols="30" rows="10" />
      </div>
    </div>
  </div>
</template>

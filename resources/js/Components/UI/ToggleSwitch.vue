<script setup>
import {ref} from 'vue'

const toggle = ref(true)
const emit = defineEmits(['toggle'])

const handleToggle = () => {
  toggle.value = !toggle.value
  emit('toggle', toggle.value)
}

</script>

<template>
  <label class="switch">
    <input v-model="toggle" type="checkbox" @click="handleToggle" />
    <div class="slider round" />
  </label>
</template>

<style scoped>
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    display: none;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #101010;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: #883535;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

.switch input:checked + .slider:before {
    background-color: #245030;
}

.switch input:focus + .slider {
    box-shadow: 0 0 1px #101010;
}

.switch input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>

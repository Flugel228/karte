<script setup lang="ts">
import {IProps} from "../../types/components/inputs/check-box";

const props = defineProps<IProps>();

</script>

<template>
    <div class="checkk ">
        <div class="form-check p-0 m-0">
            <input
                type="checkbox"
                :id="props.name"
                :name="props.name"
            >
            <label class="p-0" for="remember">{{ props.label }}</label>
        </div>
    </div>
</template>

<style scoped>

</style>

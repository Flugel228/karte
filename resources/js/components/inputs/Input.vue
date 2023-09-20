<script setup lang="ts">
import {IEmit, IProps} from "../../types/components/inputs/input";

const props = withDefaults(defineProps<IProps>(), {
    value: '',
    type: 'text',
    width: '100%'
});

const emit = defineEmits<IEmit>();

const updateValue = e => {
    emit('update:value', e.target.value)
}
</script>

<template>
    <div class="form-group" :style="{width: width}">
        <input
            class="form-control"
            :type="type"
            :placeholder="placeholder"
            :name="name"
            :value="value"
            @input="updateValue"
        />
        <div
            class="mb-3 error-content"
            v-for="error in errors"
            :key="error.$uid"
        >
            <p>{{ error.$message }}</p>
        </div>
    </div>
</template>

<style scoped>

</style>

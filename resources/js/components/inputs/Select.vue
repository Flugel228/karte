<script setup lang="ts">
import {IEmit, IProps} from "../../types/components/inputs/select";

const props = withDefaults(defineProps<IProps>(), {
    errors: [],
    options: [],
    name: '',
    width: '100%',
    height: '60px'
});

const emit = defineEmits<IEmit>();

const updateValue = e => {
    emit('update:value', e.target.value);
}

const getOptionId = (value: string) => {
    return props.options.indexOf(value);
}
</script>

<template>
    <div class="form-group">
        <select
            class="form-control"
            name="gender"
            @change="updateValue"
            :style="{
                width: width,
                height: height
            }"
        >
            <option
                v-for="(option, id) in options"
                :key="id"
                :value="getOptionId(id)"
            >
                {{ option }}
            </option>
        </select>
    </div>
</template>

<style scoped>

</style>

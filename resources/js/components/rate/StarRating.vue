<script setup lang="ts">
import {IProps} from "../../types/components/rate/star-rating";

const props = withDefaults(defineProps<IProps>(), {
    showCount: false
});
</script>

<template>
    <div class="ratting">
        <i
            v-for="(item, id) in length"
            :key="id"
            @click="changeRate(id + 1)"
            :class="['flaticon-star-1', {'selected': rate >= id + 1}]"
        ></i>
        <p v-if="showCount">{{ rate }}</p>
    </div>
</template>

<style scoped lang="sass">
.ratting i.selected
    color: var(--thm-base)

</style>

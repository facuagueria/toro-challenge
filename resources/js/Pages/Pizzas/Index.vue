<script setup lang="ts">
import {Pizza} from "@/types/Pizza";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import EmptyCatalog from "@/Components/Pizza/EmptyCatalog.vue";
import TableList from "@/Components/Pizza/TableList.vue";

interface Props {
    pizzas: Pizza[];
}

defineProps<Props>()
</script>

<template>
    <BaseLayout>
        <template v-slot:title>Pizzas</template>
        <EmptyCatalog v-if="!pizzas.length"/>
        <TableList v-else :pizzas="pizzas" />
    </BaseLayout>
</template>

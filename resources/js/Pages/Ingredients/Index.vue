<script setup lang="ts">
import {Ingredient} from "@/types/Ingredient";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import EmptyCatalog from "@/Components/Ingredient/EmptyCatalog.vue";
import TableList from "@/Components/Ingredient/TableList.vue";

interface Props {
    ingredients: Ingredient[];
}

defineProps<Props>()
</script>

<template>
    <BaseLayout>
        <template v-slot:title>Ingredients</template>
        <EmptyCatalog v-if="!ingredients.length"/>
        <TableList v-else :ingredients="ingredients" />
    </BaseLayout>
</template>

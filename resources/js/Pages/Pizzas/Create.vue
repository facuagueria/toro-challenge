<script setup lang="ts">
import {Ingredient} from "@/types/Ingredient";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import CreateForm from "@/Components/Pizza/CreateForm.vue";

interface Props {
    ingredients: Ingredient[];
}

defineProps<Props>()
</script>

<template>
    <BaseLayout>
        <template v-slot:title>Create your own Pizza</template>
        <CreateForm :ingredients="ingredients"/>
    </BaseLayout>
</template>

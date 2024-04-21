<script setup lang="ts">
import {Ingredient} from "@/types/Ingredient";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import EditForm from "@/Components/Ingredient/EditForm.vue";

defineProps<{
    ingredient: Ingredient
    errors?: Record<string, string>
}>()
</script>

<template>
    <BaseLayout>
        <template v-slot:title>Edit {{ ingredient.name }}</template>
        <EditForm :ingredient="ingredient" :errors="errors"/>
    </BaseLayout>
</template>

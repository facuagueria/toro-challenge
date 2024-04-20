<script setup lang="ts">
import {Ingredient} from "@/types/Ingredient";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import EditForm from "@/Components/Pizza/EditForm.vue";
import {Pizza} from "@/types/Pizza";

defineProps<{
    pizza: Pizza
    ingredients: Ingredient[]
}>()
</script>

<template>
    <BaseLayout>
        <template v-slot:title>Edit {{ pizza.name }}</template>
        <EditForm :pizza="pizza" :ingredients="ingredients"/>
    </BaseLayout>
</template>

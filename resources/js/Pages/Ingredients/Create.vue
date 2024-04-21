<script setup lang="ts">
import BaseLayout from "@/Layouts/BaseLayout.vue";
import CreateForm from "@/Components/Ingredient/CreateForm.vue";

defineProps<{
    errors?: Record<string, string>
}>()
</script>

<template>
    <BaseLayout>
        <template v-slot:title>Create your favourite Ingredient</template>
        <CreateForm :errors="errors"/>
    </BaseLayout>
</template>

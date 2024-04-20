<script setup lang="ts">
import BaseLayout from "@/Layouts/BaseLayout.vue";
import CreateForm from "@/Components/Ingredient/CreateForm.vue";
</script>

<template>
    <BaseLayout>
        <template v-slot:title>Create your favourite Ingredient</template>
        <CreateForm />
    </BaseLayout>
</template>

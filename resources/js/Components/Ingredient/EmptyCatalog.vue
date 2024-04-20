<script setup lang="ts">

import {Button} from "@/Components/ui/button";
</script>

<template>
    <div class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm">
        <div class="flex flex-col items-center gap-1 text-center">
            <h3 class="text-2xl font-bold tracking-tight">
                You have no Ingredients
            </h3>
            <Button class="mt-4">
                Add Ingredients
            </Button>
        </div>
    </div>
</template>

<style scoped>

</style>

<script setup lang="ts">
import {useForm} from 'vee-validate'
import {toTypedSchema} from '@vee-validate/zod'
import * as z from 'zod'
import {router, Link} from '@inertiajs/vue3'

import {
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage
} from '@/Components/ui/form'
import {Input} from "@/Components/ui/input";
import {Button} from "@/Components/ui/button";
import {watch} from "vue";
import {useToast} from '@/Components/ui/toast/use-toast'

const {toast} = useToast()

const props = defineProps<{
    errors?: Record<string, string>
}>()

const formSchema = toTypedSchema(z.object({
    name: z.string().min(2).max(50),
    cost_price: z.string()
}))

const form = useForm({
    validationSchema: formSchema,
})

const onSubmit = form.handleSubmit((values) => {
    router.post('/ingredients', values)
})

watch(() => props.errors, (errors) => {
    if (errors) {
        Object.keys(errors).forEach((key) => {
            toast({
                title: key,
                description: errors[key],
                variant: 'destructive'
            })
        })
    }
})
</script>

<template>
    <form @submit="onSubmit" class="flex flex-col space-y-5">
        <FormField v-slot="{ componentField }" name="name">
            <FormItem class="flex flex-col">
                <FormLabel>Name</FormLabel>
                <FormControl>
                    <Input v-bind="componentField" type="text"/>
                </FormControl>
                <FormMessage/>
            </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="cost_price">
            <FormItem class="flex flex-col">
                <FormLabel>Cost Price</FormLabel>
                <FormControl>
                    <Input v-bind="componentField" type="text"/>
                </FormControl>
                <FormMessage/>
            </FormItem>
        </FormField>

        <div class="flex flex-row gap-3 max-w-[300px] pt-10">
            <Link :href="route('ingredients.index')">
                <Button type="button" variant="outline">Cancel</Button>
            </Link>
            <Button class="max-w-[300px]" type="submit">Create Ingredient</Button>
        </div>
    </form>
</template>

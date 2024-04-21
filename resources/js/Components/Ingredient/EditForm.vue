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
import {Ingredient} from "@/types/Ingredient";
import {watch} from "vue";
import {useToast} from '@/Components/ui/toast/use-toast'

const {toast} = useToast()

const props = defineProps<{
    ingredient: Ingredient
    errors?: Record<string, string>
}>()

const formSchema = toTypedSchema(z.object({
    name: z.string().min(2).max(50),
    cost_price: z.any()
}))

const form = useForm({
    validationSchema: formSchema,
    initialValues: {
        name: props.ingredient.name,
        cost_price: props.ingredient.cost_price
    }
})

const onSubmit = form.handleSubmit((values) => {
    const fields = {
        id: props.ingredient.id,
        name: values.name,
        cost_price: values.cost_price
    }

    router.put(`/ingredients/${props.ingredient.id}`, fields)
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
            <Button class="max-w-[300px]" type="submit">Edit Ingredient</Button>
        </div>
    </form>
</template>

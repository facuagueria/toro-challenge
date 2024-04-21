<script setup lang="ts">
import {useForm} from 'vee-validate'
import {toTypedSchema} from '@vee-validate/zod'
import * as z from 'zod'
import {router, Link} from '@inertiajs/vue3'
import {useToast} from '@/Components/ui/toast/use-toast'

const {toast} = useToast()

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
import {Pizza} from "@/types/Pizza";
import {Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue} from "@/Components/ui/select";
import {Table, TableBody, TableCell, TableHead, TableHeader, TableRow} from "@/Components/ui/table";
import {Trash2} from "lucide-vue-next";
import {ref, watch} from "vue";

const props = defineProps<{
    pizza: Pizza & { ingredients: Ingredient[] },
    ingredients: Ingredient[]
    errors?: Record<string, string>
}>()

const formSchema = toTypedSchema(z.object({
    name: z.string().min(2).max(50),
    cost_price: z.any(),
    ingredient: z.any()
}))

const form = useForm({
    validationSchema: formSchema,
    initialValues: {
        name: props.pizza.name,
    },
})

const onSubmit = form.handleSubmit((values) => {
    const fields = {
        id: props.pizza.id,
        name: values.name,
        selling_price: totalIngredients.value,
        ingredients: pizzaIngredients.value.map((i) => i.id)
    }

    router.put(`/pizzas/${props.pizza.id}`, fields)
})

const totalIngredients = ref<number>(0)
const pizzaIngredients = ref<Ingredient[]>(props.pizza.ingredients)
const addIngredient = (ingredient: string) => {
    if (!ingredient) {
        form.setFieldError('ingredient', 'Ingredient is required')
        return
    }


    if (pizzaIngredients.value.find((i) => i.name === ingredient)) {
        toast({
            variant: 'destructive',
            title: 'Ingredient already added',
        });

        return
    }


    props.ingredients.find((i) => {
        if (i.name === ingredient) {
            pizzaIngredients.value.push(i)
        }
    })
}

const removeFromPizzaIngredients = (id: number) => {
    const index = pizzaIngredients.value.findIndex((i) => i.id === id)
    pizzaIngredients.value.splice(index, 1)
}

watch(pizzaIngredients.value, () => {
    totalIngredients.value = pizzaIngredients.value.reduce((acc, ingredient) => {
        return acc + ingredient.cost_price
    }, 0)

    totalIngredients.value = totalIngredients.value + (totalIngredients.value * 0.5)
}, {immediate: true})

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

        <FormField v-slot="{ componentField }" name="ingredient">
            <FormItem class="flex flex-col">
                <FormLabel>Ingredient</FormLabel>

                <Select v-bind="componentField">
                    <FormControl>
                        <SelectTrigger>
                            <SelectValue placeholder="Select an ingredient"/>
                        </SelectTrigger>
                    </FormControl>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem v-bind="componentField" v-for="ingredient in ingredients" :key="ingredient.id"
                                        :value="ingredient.name">
                                {{ ingredient.name }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <FormMessage/>
            </FormItem>
            <Button class="max-w-[300px]" type="button" @click="addIngredient(componentField.modelValue)">
                Add ingredient
            </Button>
        </FormField>

        <Table class="w-full xl:w-1/2 mt-5">
            <TableHeader>
                <TableRow>
                    <TableHead class="w-[200px]">
                        Name
                    </TableHead>
                    <TableHead class="w-[200px]">Cost Price</TableHead>
                    <TableHead class="w-[200px]"></TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="ingredient in pizzaIngredients" :key="ingredient.id">
                    <TableCell class="font-medium">
                        {{ ingredient.name }}
                    </TableCell>
                    <TableCell>{{ ingredient.cost_price }}</TableCell>
                    <TableCell>
                        <Button variant="ghost">
                            <Trash2 class="h-5" @click="removeFromPizzaIngredients(ingredient.id)"/>
                        </Button>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>

        <span v-if="pizzaIngredients.length">Total: <b>{{ totalIngredients.toFixed(2) }} eur</b></span>

        <div v-if="pizzaIngredients.length" class="flex flex-row gap-3 max-w-[300px] pt-10">
            <Link :href="route('pizzas.index')">
                <Button type="button" variant="outline">Cancel</Button>
            </Link>
            <Button class="max-w-[300px]" type="submit">Edit Pizza</Button>
        </div>
    </form>
</template>

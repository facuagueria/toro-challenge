<script setup lang="ts">
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import { Button } from '@/Components/ui/button'
import { EllipsisVertical } from 'lucide-vue-next'
import {Ingredient} from "@/types/Ingredient";
import {Link, router} from "@inertiajs/vue3";

interface Props {
    ingredients: Ingredient[];
}

const props = defineProps<Props>()

const editIngredient = (id: number) => {
    router.get(`/ingredients/${id}/edit`)
}

const deleteIngredient = (id: number) => {
    router.delete(`/ingredients/${id}`)
}
</script>

<template>
    <Link
        :href="route('ingredients.create')"
    >
        <Button>Create</Button>
    </Link>
    <Table class="w-1/2">
        <TableHeader>
            <TableRow>
                <TableHead>Name</TableHead>
                <TableHead>Selling Price</TableHead>
                <TableHead>
                    Actions
                </TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="ingredient in ingredients" :key="ingredient.id">
                <TableCell class="font-medium">
                    {{ ingredient.name }}
                </TableCell>
                <TableCell>{{ ingredient.cost_price }} eur</TableCell>
                <TableCell>
                    <DropdownMenu>
                        <DropdownMenuTrigger>
                            <EllipsisVertical />
                        </DropdownMenuTrigger>
                        <DropdownMenuContent>
                            <DropdownMenuItem @click="editIngredient(ingredient.id)">Edit</DropdownMenuItem>
                            <DropdownMenuItem @click="deleteIngredient(ingredient.id)">Delete</DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>

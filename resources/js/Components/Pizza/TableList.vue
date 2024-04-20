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
import {Pizza} from "@/types/Pizza";
import {Link, router} from "@inertiajs/vue3";

interface Props {
    pizzas: Pizza[];
}

const props = defineProps<Props>()

const editPizza = (id: number) => {
    router.get(`/pizzas/${id}/edit`)
}

const deletePizza = (id: number) => {
    router.delete(`/pizzas/${id}`)
}
</script>

<template>
    <Link
        :href="route('pizzas.create')"
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
            <TableRow v-for="pizza in pizzas" :key="pizza.id">
                <TableCell class="font-medium">
                    {{ pizza.name }}
                </TableCell>
                <TableCell>{{ pizza.selling_price }} eur</TableCell>
                <TableCell>
                    <DropdownMenu>
                        <DropdownMenuTrigger>
                            <EllipsisVertical />
                        </DropdownMenuTrigger>
                        <DropdownMenuContent>
                            <DropdownMenuItem @click="editPizza(pizza.id)">Edit</DropdownMenuItem>
                            <DropdownMenuItem @click="deletePizza(pizza.id)">Delete</DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>

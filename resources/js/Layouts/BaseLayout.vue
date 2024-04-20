<script setup lang="ts">
import {Menu} from 'lucide-vue-next'
import {Button} from '@/Components/ui/button'
import {Sheet, SheetContent, SheetTrigger} from '@/Components/ui/sheet'
import {Link} from '@inertiajs/vue3';
import Toaster from '@/Components/ui/toast/Toaster.vue'
</script>

<template>
    <Toaster/>
    <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
        <div class="hidden border-r bg-muted/40 md:block">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
                    <a href="/" class="flex items-center gap-2 font-semibold">
                        <span class="text-xl">Pizza Lovers</span>
                    </a>
                </div>
                <div class="flex-1">
                    <nav class="grid items-start px-2 text-sm font-medium lg:px-4">
                        <Link
                            :href="route('pizzas.index')"
                            class="flex items-center gap-3 rounded-lg bg-muted px-3 py-2 text-primary transition-all hover:text-primary"
                        >
                            Pizzas
                        </Link>
                        <Link
                            :href="route('ingredients.index')"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
                        >
                            Ingredients
                        </Link>

                    </nav>
                </div>

            </div>
        </div>
        <div class="flex flex-col">
            <header class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6">
                <Sheet>
                    <SheetTrigger as-child>
                        <Button
                            variant="outline"
                            size="icon"
                            class="shrink-0 md:hidden"
                        >
                            <Menu class="h-5 w-5"/>
                            <span class="sr-only">Toggle navigation menu</span>
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left" class="flex flex-col">
                        <nav class="grid gap-2 text-lg font-medium">
                            <a
                                href="#"
                                class="flex items-center gap-2 text-lg font-semibold"
                            >
                                <span class="">Pizza Lovers</span>
                            </a>
                            <Link
                                :href="route('pizzas.index')"
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                            >
                                Pizzas
                            </Link>
                            <Link
                                :href="route('ingredients.index')"
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                            >
                                Ingredients
                            </Link>

                        </nav>

                    </SheetContent>
                </Sheet>
                <div class="flex items-center">
                    <h1 class="text-lg font-semibold md:text-2xl">
                        <slot name="title"></slot>
                    </h1>
                </div>
            </header>
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
                <slot name="default"></slot>
            </main>
        </div>
    </div>
</template>

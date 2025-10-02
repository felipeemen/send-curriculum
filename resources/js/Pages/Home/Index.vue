<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Card } from '@/components/ui/card';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { vMaska } from "maska/vue"
import { useForm } from "@inertiajs/vue3"
import { ref } from 'vue';
import 'vue-sonner/style.css'
import { toast, Toaster } from 'vue-sonner'
import Navbar from '@/components/Navbar.vue';

defineProps<{
    educations: Array<{ name: string; value: string }>
}>()

const form = useForm({
    name: "",
    email: "",
    phone: "",
    position: "",
    education: "",
    observations: "",
    file: null as File | null
});
const errors = ref<Record<string, string>>({})

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if(target.files) {
        form.file = target.files[0];
    }
}

const submit = () => {
    form.post("/submit-curriculum", {
        forceFormData: true,
        onError: (error: any) => {
            errors.value = error
            const messages = Object.values(error).flat()
            toast.error(messages.join("\n"))
        },
        onSuccess: () => {
            form.reset();
            errors.value = {}
            const inputFile = document.getElementById('file') as HTMLInputElement;
            if(inputFile) {
                inputFile.value = '';
            }
            toast.success('Curriculo enviado com sucesso!');
        }
    });
}

</script>

<template>
    <title>Candidate-se agora</title>
    <Toaster />
    <Navbar />
    <div class="grid auto-rows-min gap-4 md:grid-cols-2">
        <div class="flex flex-col items-center justify-center md:h-screen h-32 mb-3">
            <h1 class="text-4xl font-bold text-blue-600">Faça Parte do Time</h1>
            <p class="text-center p-3 text-medium text-blue-400">Aprenda com a gente e faca parte do nosso time de desenvolvedores</p>
        </div>
        <div class="flex items-center justify-center h-screen flex-col gap-4 p-3">
            <Card class="p-4 w-full">
                <h1 class="text-2xl font-bold">Envie seu Curriculo</h1>
                <p>Preencha os dados abaixo corretamente.</p>
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="grid gap-2">
                            <Label for="name">Nome</Label>
                            <Input id="name" v-model="form.name" type="text" placeholder="Nome" aria-required="true" />
                            <span v-if="errors.name" class="text-red-500">{{ errors.name }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">E-mail</Label>
                            <Input id="email" v-model="form.email" type="email" placeholder="E-mail" />
                            <span v-if="errors.email" class="text-red-500">{{ errors.email }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="phone">Telefone</Label>
                            <Input id="phone" v-model="form.phone" v-maska="'(##) #####-####'" type="phone" placeholder="DDD + Telefone" />
                            <span v-if="errors.phone" class="text-red-500">{{ errors.phone }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="position">Cargo Desejado</Label>
                            <Input id="position" v-model="form.position" type="position" placeholder="Ex. Dev Full Stack" />
                            <span v-if="errors.position" class="text-red-500">{{ errors.position }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="education">Escolaridade</Label>
                            <Select class="w-full" v-model="form.education">
                                <SelectTrigger class="w-full">
                                    <SelectValue placeholder="Escolaridade" />
                                </SelectTrigger>
                                <SelectContent class="w-full">
                                    <SelectGroup class="w-full">
                                        <SelectLabel>Escolaridade</SelectLabel>
                                        <SelectItem v-for="option in educations" :key="option.name" :value="option.value">
                                            {{ option.value }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <span v-if="errors.education" class="text-red-500">{{ errors.education }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="file">Curriculo</Label>
                            <Input id="file" @change="handleFileChange" type="file" />
                            <span v-if="errors.file" class="text-red-500">{{ errors.file }}</span>
                        </div>
                        <div class="w-full col-span-1 md:col-span-2 grid gap-2">
                            <Label for="observations">Observações</Label>
                            <Textarea id="observations" v-model="form.observations" placeholder="Quer nos contar algo incrivel sobre voce?" />
                            <span v-if="errors.observations" class="text-red-500">{{ errors.observations }}</span>
                        </div>
                        <div class="w-full col-span-1 md:col-span-2 grid gap-2">
                            <Button class="mt-4">Enviar Curriculo</Button>
                        </div>
                    </div>
                </form>
            </Card>
        </div>
    </div>
</template>

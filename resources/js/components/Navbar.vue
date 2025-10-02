<script lang="ts">
import { SquareTerminal } from 'lucide-vue-next';
export default {
    components: {
        SquareTerminal
    }
}
</script>

<template>
    <div>
        <nav class="bg-gray-800 p-4 text-white">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-lg font-bold"><SquareTerminal /></div>
                <div>
                    <a href="#" class="px-3 py-2 hover:bg-gray-700 rounded">(11) 99999-9999</a>
                </div>
            </div>
        </nav>
    </div>
</template>
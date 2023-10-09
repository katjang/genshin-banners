<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const name = ref('Mona');
const rarity = ref(4);
const weapon_type = ref(0);

function storeCharacter() {
    router.post('/characters', {
        name: name.value, 
        rarity: rarity.value, 
        weapon_type: weapon_type.value
    });
}

</script>

<template dark>
    <Head title="Create Character" />
    <v-container fluid>
       <v-form @submit.prevent="storeCharacter">
            <v-text-field v-model="name" label="name"></v-text-field>
            <v-select v-model="rarity" label="rarity" :items="[3,4,5]"></v-select>
            <v-select v-model="weapon_type" label="Weapon Type" :items="[0,1,2,3,4,5,6]"></v-select>
            <v-btn type="submit">Add</v-btn>
       </v-form>
    </v-container>
</template>

<style>

</style>

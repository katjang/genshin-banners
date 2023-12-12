<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Character } from '@/models';

import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps<{
    character?: Character;
}>();

const id = props.character? props.character.id : undefined;
const name = ref(props.character? props.character.name : '');
const rarity = ref(props.character? props.character.rarity : 4);
const weapon_type = ref(props.character? props.character.weapon_type : 0);

function storeCharacter() {
    if(id) {
        router.put('/admin/character/'+id, {
            name: name.value, 
            rarity: rarity.value, 
            weapon_type: weapon_type.value
        })
    } else {
        router.post('/admin/characters', {
            name: name.value, 
            rarity: rarity.value, 
            weapon_type: weapon_type.value
        });
    }
}

</script>

<template dark>
    <Head title="Create Character" />
    <AdminLayout>
        <v-container fluid>
        <v-form @submit.prevent="storeCharacter">
                <v-text-field v-model="name" label="name"></v-text-field>
                <v-select v-model="rarity" label="rarity" :items="[3,4,5]"></v-select>
                <v-select v-model="weapon_type" label="Weapon Type" :items="[0,1,2,3,4,5,6]"></v-select>
                <v-btn type="submit">Confirm</v-btn>
        </v-form>
        </v-container>
    </AdminLayout>
</template>

<style>

</style>

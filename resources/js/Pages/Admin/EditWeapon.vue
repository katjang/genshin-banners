<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Weapon, weaponSelectOptions } from '@/models';

import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps<{
    weapon?: Weapon;
}>();

const id = props.weapon? props.weapon.id : undefined;
const name = ref(props.weapon? props.weapon.name : '');
const rarity = ref(props.weapon? props.weapon.rarity : 4);
const weapon_type = ref(props.weapon? props.weapon.weapon_type : 0);

function getWeaponTypeText() {
    return 'yes'
}


function storeWeapon() {
    let object = {
        name: name.value, 
        rarity: rarity.value, 
        weapon_type: weapon_type.value,
    } 
    if(id) {
        router.put(route('weapon.update', id), object)
    } else {
        router.post(route('weapon.store'), object);
    }
}

</script>

<template dark>
    <Head title="Create Character" />
    <AdminLayout>
        <v-container fluid>
        <v-form @submit.prevent="storeWeapon">
                <v-text-field v-model="name" label="name"></v-text-field>
                <v-select v-model="rarity" label="rarity" :items="[3,4,5]"></v-select>
                <v-select v-model="weapon_type" label="Weapon Type" :items="weaponSelectOptions"></v-select>
                <v-btn type="submit">Confirm</v-btn>
        </v-form>
        </v-container>
    </AdminLayout>
</template>

<style>

</style>

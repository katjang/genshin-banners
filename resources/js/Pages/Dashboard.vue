<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Banner, Character } from '@/models';
import { WeaponType } from '@/models';

defineProps<{
    banners: Banner[],
    characters: Character[],
}>();

</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <v-container>
            <h3 class="text-h3">Characters</h3>
            <v-table density="compact">
                <thead>
                    <tr>
                        <td>
                            Name
                        </td>
                        <td>
                            Weapon Type
                        </td>
                        <td>
                            Rarity
                        </td>
                        <td>
                            Actions
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="character in characters" :key="character.id">
                        <td>
                            {{ character.name }}
                        </td>
                        <td>
                            {{ WeaponType[character.weapon_type] }}
                        </td>
                        <td>
                            {{ character.rarity }}
                        </td>
                        <td>
                            <v-btn density="compact" :href="route('character.edit', character.id)" class="mx-2">Edit</v-btn>
                            <!-- <v-btn density="compact" :href="route('character.delete', character.id)" class="mx-2">Delete</v-btn> -->
                        </td>
                    </tr>
                </tbody>
            </v-table>
            <h3 class="text-h3 mt-6">Banners</h3>
            <v-table density="compact">
                <thead>
                    <tr>
                        <td>
                            Name
                        </td>
                        <td>
                            Featured
                        </td>
                        <td>
                            Patch
                        </td>
                        <td>
                            Actions
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="banner in banners" :key="banner.id">
                        <td>
                            {{ banner.name }}
                        </td>
                        <td>
                            <v-chip density="compact" v-for="feature in banner.featured" :key="feature.id">{{ feature.name }}</v-chip>
                        </td>
                        <td>
                            {{ banner.patch }}
                        </td>
                        <td>
                            <v-btn density="compact" :href="route('banner.edit', banner.id)" class="mx-2">Edit</v-btn>
                            <v-btn density="compact" :href="route('banner.edit', banner.id)" class="mx-2">Delete</v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-container>

    </AdminLayout>
</template>

<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { Banner, Character, Weapon } from '@/models';
import { WeaponType, Element } from '@/models';
import { getBannerName } from '@/helpers';
import { ref } from 'vue';

defineProps<{
    banners: Banner[],
    characters: Character[],
    weapons: Weapon[],
}>();

const tab = ref('characters');

function deleteBanner(banner: Banner) {
    router.delete(route('banners.destroy', banner.id));
}

function deleteCharacter(character: Character) {
    console.log(character);
    router.delete(route('characters.destroy', character.id));
}

function deleteWeapon(weapon: Weapon) {
    router.delete(route('weapons.destroy', weapon.id));
}

</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template v-slot:append>
            <v-tabs
                v-model="tab"
                align-tabs="title"
                grow
            >
                <v-tab value="characters">Characters</v-tab>
                <v-tab value="weapons">Weapons</v-tab>
                <v-tab value="character_banners">Banners</v-tab>
            </v-tabs>
        </template>
        <v-window v-model="tab">
            <v-window-item transition="none" reverse-transition="none" value="characters">
                <v-container>
                    <h3 class="text-h3 mt-6">Characters</h3>
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
                                    Element
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
                                    {{ Element[character.element] }}
                                </td>
                                <td>
                                    {{ character.rarity }}
                                </td>
                                <td>
                                    <v-btn density="compact" :href="route('characters.edit', character.id)" class="mr-2">Edit</v-btn>
                                    <v-btn color="red" density="compact" @click.ctrl="deleteCharacter(character)" class="ml-2">Delete</v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
                </v-container>
            </v-window-item>
            <v-window-item transition="none" reverse-transition="none" value="weapons">
                <v-container>
                    <h3 class="text-h3 mt-6">Weapons</h3>
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
                            <tr v-for="weapon in weapons" :key="weapon.id">
                                <td>
                                    {{ weapon.name }}
                                </td>
                                <td>
                                    {{ WeaponType[weapon.weapon_type] }}
                                </td>
                                <td>
                                    {{ weapon.rarity }}
                                </td>
                                <td>
                                    <v-btn density="compact" :href="route('weapons.edit', weapon.id)" class="mr-2">Edit</v-btn>
                                    <v-btn color="red" density="compact" @click.ctrl="deleteWeapon(weapon)" class="ml-2">Delete</v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
                </v-container>
            </v-window-item>
            <v-window-item transition="none" reverse-transition="none" value="character_banners">
                <v-container>
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
                                    start_date
                                </td>
                                <td>
                                    end_date
                                </td>
                                <td>
                                    Actions
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="banner in banners" :key="banner.id">
                                <td>
                                    {{ getBannerName(banner) }}
                                </td>
                                <td>
                                    <v-chip density="compact" v-for="feature in banner.characters" :key="feature.id">{{ feature.name }}</v-chip>
                                    <v-chip density="compact" v-for="feature in banner.weapons" :key="feature.id">{{ feature.name }}</v-chip>
                                </td>
                                <td>
                                    {{ banner.patch }}
                                </td>
                                <td>
                                    {{ banner.start_date }}
                                </td>
                                <td>
                                    {{ banner.end_date }}
                                </td>
                                <td>
                                    <v-btn density="compact" :href="route('banners.edit', banner.id)" class="mr-2">Edit</v-btn>
                                    <v-btn color="red" density="compact" @click.ctrl="deleteBanner(banner)" class="ml-2">Delete</v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
                </v-container>
            </v-window-item>
        </v-window>
    </AdminLayout>
</template>

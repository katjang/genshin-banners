<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import CharacterVue from '@/Components/Character.vue';
import CharacterListItem from '@/Components/CharacterListItem.vue';
import WeaponListItem from '@/Components/WeaponListItem.vue';
import { Character, Weapon } from '@/models';
import { ref } from 'vue';

const props = defineProps<{
    characters: Character[];
    weapons: Weapon[];
}>();

const characterDialog = ref(false);
const weaponDialog = ref(false);

const selectedCharacter = ref();
const selectedWeapon = ref();

const elementFilter = ref();
const weaponFilter = ref();
const rarityFilter = ref();
const filteredCharacters = ref();
const filteredWeapons = ref();
const tab = ref("characters");

filteredCharacters.value = props.characters;
filteredWeapons.value = props.weapons;
elementFilter.value = [];
weaponFilter.value = [];
rarityFilter.value = [];

async function characterDetails(id: number) {
    weaponDialog.value = false;
    characterDialog.value = false;
    selectedWeapon.value = undefined;
    selectedCharacter.value = undefined;

    const response = await fetch('/characters/'+id, {
        method: 'GET',
        headers: {
            Accept: 'application/json',
        },
    });

    if (!response.ok) {
      throw new Error(`Error! status: ${response.status}`);
    }

    const result = (await response.json()) as Character;
    characterDialog.value = true;
    selectedCharacter.value = result;
}

async function weaponDetails(id: number) {
    weaponDialog.value = false;
    characterDialog.value = false;
    selectedWeapon.value = undefined;
    selectedCharacter.value = undefined;

    const response = await fetch('/weapons/'+id, {
        method: 'GET',
        headers: {
            Accept: 'application/json',
        },
    });

    if (!response.ok) {
      throw new Error(`Error! status: ${response.status}`);
    }

    const result = (await response.json()) as Weapon;
    weaponDialog.value = true;
    selectedWeapon.value = result;
}

function filter() {
    let tmpCharFilter = props.characters;
    let tmpWeapFilter = props.weapons;
    if(elementFilter.value.length) {
        tmpCharFilter = props.characters.filter(c => elementFilter.value.indexOf(c.element) > -1);
    }

    if(weaponFilter.value.length) {
        tmpCharFilter = tmpCharFilter.filter(c => weaponFilter.value.indexOf(c.weapon_type) > -1);
        tmpWeapFilter = props.weapons.filter(w => weaponFilter.value.indexOf(w.weapon_type) > -1)
    }

    if(rarityFilter.value.length) {
        tmpCharFilter = tmpCharFilter.filter(c => rarityFilter.value.indexOf(c.rarity) > -1);
        tmpWeapFilter = tmpWeapFilter.filter(w => rarityFilter.value.indexOf(w.rarity) > -1);
    }

    filteredWeapons.value = tmpWeapFilter;
    filteredCharacters.value = tmpCharFilter;
}

</script>

<template dark>
    <Head title="Overview" />
    <v-dialog v-model="characterDialog" close-on-back>
        <template v-slot:default v-if="selectedCharacter">
            <v-btn icon="mdi-close" class="position-absolute right-0 mr-n3 mt-n3 z-10"  @click="characterDialog = false"></v-btn>
            <v-sheet dark>
                <v-container fluid>
                    <CharacterVue :character="selectedCharacter" @click-character="characterDetails($event)"/>
                </v-container>
            </v-sheet>
        </template>
    </v-dialog>
    <v-toolbar :height="$vuetify.display.smAndDown? 140 : 100">
        <v-container>
            <v-row dense>
                <v-col class="justify-center justify-md-start d-flex">
                    <v-btn-toggle 
                        v-model="elementFilter" 
                        multiple
                        @update:modelValue="filter"
                        density="compact"
                    >
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/elements/0.svg`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/elements/1.svg`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/elements/2.svg`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/elements/3.svg`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/elements/4.svg`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/elements/5.svg`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/elements/6.svg`"></v-img>
                            </v-icon>
                        </v-btn>
                    </v-btn-toggle>
                </v-col>
                <!-- <v-col>
                    <v-text-field density="compact" hide-details variant="solo" label="Search..." clearable></v-text-field>
                </v-col> -->
            </v-row>
            <v-row dense class="flex-column flex-md-row">
                <v-col class="justify-center justify-md-start d-flex">
                    <v-btn-toggle 
                        v-model="weaponFilter" 
                        multiple
                        @update:modelValue="filter"
                        density="compact"
                    >
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/weapon_types/0.png`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/weapon_types/1.png`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/weapon_types/2.png`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/weapon_types/3.png`"></v-img>
                            </v-icon>
                        </v-btn>
                        <v-btn>
                            <v-icon size="28">
                                <v-img :src="`/images/icons/weapon_types/4.png`"></v-img>
                            </v-icon>
                        </v-btn>
                    </v-btn-toggle>
                </v-col>
                <v-col class="justify-center justify-md-start d-flex">
                    <v-btn-toggle 
                        v-model="rarityFilter" 
                        multiple
                        @update:modelValue="filter"
                        density="compact"
                    >
                        <v-btn :value="3">
                            <v-icon size="28">
                                <img :src="`/images/icons/rarity/3.png`">
                            </v-icon>
                        </v-btn>
                        <v-btn :value="4">
                            <v-icon size="28">
                                <img :src="`/images/icons/rarity/4.png`">
                            </v-icon>
                        </v-btn>
                        <v-btn :value="5">
                            <v-icon size="28">
                                <img :src="`/images/icons/rarity/5.png`">
                            </v-icon>
                        </v-btn>
                    </v-btn-toggle>
                </v-col>
            </v-row>
        </v-container>
        <template v-slot:extension>
            <v-tabs
                v-model="tab"
                align-tabs="title"
                grow
            >
                <v-tab value="characters">Characters</v-tab>
                <v-tab value="weapons">Weapons</v-tab>
            </v-tabs>
        </template>
    </v-toolbar>
    <v-window v-model="tab">
        <v-window-item transition="fade-transition" reverse-transition="fade-transition" value="characters">
            <v-container fluid>
                <v-row>
                    <v-col cols="6" sm="4" md="3" lg="2" v-for="character in filteredCharacters" :key="character.id">
                        <CharacterListItem :character="character" @click-character="characterDetails(character.id)"/>
                    </v-col>
                </v-row>
            </v-container>
        </v-window-item>
        <v-window-item transition="fade-transition" reverse-transition="fade-transition" value="weapons">
            <v-container fluid>
                <v-row>
                    <v-col cols="6" sm="4" md="3" lg="2" v-for="weapon in filteredWeapons" :key="weapon.id">
                        <WeaponListItem :weapon="weapon" @click-weapon="weaponDetails(weapon.id)"/>
                    </v-col>
                </v-row>
            </v-container>
        </v-window-item>
    </v-window>
    
</template>

<style>
.zoomed {
    transform: scale(1.1);
    transform-origin: center center;
}
.zoomable {
    transition: transform 0.2s;
}
</style>

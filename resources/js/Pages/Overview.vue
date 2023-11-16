<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import Counter from '@/Components/Counter.vue';
import CharacterVue from '@/Components/Character.vue';
import { Character } from '@/models';
import { ref } from 'vue';

const props = defineProps<{
    characters: Character[];
}>();

const dialog = ref(false);
const selectedCharacter = ref();
const elementFilter = ref();
const weaponFilter = ref();
const rarityFilter = ref();
const filteredCharacters = ref();

filteredCharacters.value = props.characters;
elementFilter.value = [];
weaponFilter.value = [];
rarityFilter.value = [];

async function characterDetails(id: number) {
    dialog.value = false;
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
    dialog.value = true;
    selectedCharacter.value = result;
}

function filter() {
    let tmpFilter = props.characters;
    if(elementFilter.value.length) {
        tmpFilter = props.characters.filter(c => elementFilter.value.indexOf(c.element) > -1);
    }

    if(weaponFilter.value.length) {
        tmpFilter = tmpFilter.filter(c => weaponFilter.value.indexOf(c.weapon_type) > -1);
    }

    if(rarityFilter.value.length) {
        tmpFilter = tmpFilter.filter(c => rarityFilter.value.indexOf(c.rarity) > -1);
    }

    filteredCharacters.value = tmpFilter;
}

</script>

<template dark>
    <Head title="Overview" />
    <v-dialog v-model="dialog" close-on-back>
        <template v-slot:default v-if="selectedCharacter">
            <v-btn icon="mdi-close" class="position-absolute right-0 mr-n3 mt-n3 z-10"  @click="dialog = false"></v-btn>
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
    </v-toolbar>
    <v-container fluid>
        <v-row>
            <v-col cols="6" sm="4" md="3" lg="2" v-for="character in filteredCharacters" :key="character.id">
                <v-hover>
                    <template v-slot:default="{ isHovering, props }">
                        <v-card theme="dark" height="250" v-bind="props" @click="characterDetails(character.id)">
                            <div class="d-flex flex-column justify-space-between h-100">
                                <!-- <div class="absolute left-0 right-0 top-0 bottom-0 -z-10">
                                    <v-img
                                        :src="`/images/icons/elements/` + character.element + `.svg`"
                                        cover
                                        eager
                                        height="100%"
                                    ></v-img>
                                </div> -->
                                <div class="absolute left-0 right-0 top-0 bottom-0 -z-10">
                                    <v-img
                                        :src="`/images/portraits/` + character.name.replace(' ', '_') + `_Icon.png`"
                                        cover
                                        eager
                                        height="100%"
                                        :class="isHovering? 'zoomed' : ''"
                                        class="zoomable"
                                    ></v-img>
                                </div>
                                <v-card-item class="z-1">
                                    <v-card-title>
                                        <v-row no-gutters>
                                            <v-icon size="25">
                                                <v-img
                                                    :src="`/images/icons/elements/` + character.element + `.svg`"
                                                    cover
                                                    eager
                                                ></v-img>
                                            </v-icon>
                                            {{character.name}}
                                        </v-row>
                                    
                                    </v-card-title>
                                    <v-card-subtitle>
                                        <img :src="`/images/icons/rarity/` + character.rarity + `.png`">
                                        <div class="absolute top-2 right-2">
                                            <v-img 
                                                :src="`/images/icons/weapon_types/` + character.weapon_type + `.png`" 
                                                width="40">
                                            </v-img>
                                        </div>
                                    </v-card-subtitle>
                                </v-card-item>
                                <v-card-text class="z-1 flex-grow-0">
                                    <v-sheet dark rounded v-if="character.last_banner">
                                        <Counter 
                                            :start_date="new Date(character.last_banner.end_date)"
                                        />
                                    </v-sheet>
                                </v-card-text>
                                <!-- <v-img :src="`/images/portraits/` + character.name.replace(' ', '_') + `_Icon.png`" eager></v-img> -->
                            </div>
                        </v-card>
                    </template>
                </v-hover>
            </v-col>
        </v-row>
    </v-container>
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

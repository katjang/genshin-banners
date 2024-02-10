<script setup lang="ts">
import { Character } from '@/models';
import Counter from '@/Components/Counter.vue';

const props = defineProps<{
    character: Character,
}>();

defineEmits(['click-character']);

</script>

<template dark>
    <v-hover>
        <template v-slot:default="{ isHovering, props }">
            <v-card theme="dark" height="250" v-bind="props" @click="$emit('click-character')">
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
</template>